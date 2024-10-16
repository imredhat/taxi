// آرایه گلوبال برای ذخیره اطلاعات مهم
let tripData = {
    startPoint: null,
    endPoint: null,
    returnPoint: null,
    isReturnTrip: null,
    fareDetails: {
        distance: null,
        duration: null,
        fare: null,
    },
    passenger: null,
    driver: null,
    car: null
};

$(document).ready(function () {
    let no = 0;
    $(".chosen").chosen();

    $("#passenger").on('change', function () {
        var passengerName = $(this).find('option:selected').data('name');
        no = no + 1;
        $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">مسافر سرویس</td><td class="unit">' + passengerName + ' </td></tr>');
    });

    $("#driver").on('change', function () {
        var driver_name = $(this).find('option:selected').data('name');
        no = no + 1;
        $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">راننده سرویس</td><td class="unit">' + driver_name + ' </td></tr>');
    });

    $("#Cars").on('change', function () {
        var car = $(this).find('option:selected').data('name');
        no = no + 1;
        $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">خودرو سرویس</td><td class="unit">' + car + ' </td></tr>');
    });

    $("#driver").on('change', function () {
        var driverId = $(this).val();
        $.ajax({
            type: "POST",
            url: base + "Service/GetDriverCarList",
            data: {
                driver_id: driverId
            },
            success: function (data) {
                var carsHtml = '';
                data = JSON.parse(data);
                carsHtml += '<option value=""></option>';
                $.each(data, function (index, car) {
                    carsHtml += '<option data-name="' + car.car_brand + ' | ایران ' + car.iran + car.harf + car.pelak + car.pelak_last + '" value="' + car.cid + '"> ' + car.car_brand + ' | ایران ' + car.iran + car.harf + car.pelak + car.pelak_last + '</option>';
                });

                $('#Cars').html(carsHtml);
                $('#Cars').trigger('chosen:updated');
            }
        });
    });

    mapboxgl.accessToken = 'pk.eyJ1IjoicmVkaGF0NSIsImEiOiJjazV1cDdramoweDQwM2hsbzdqeGg2eXJwIn0.rE2Vf8qf_hAr3ZN2uAlQuw';


    // ایجاد نقشه
    const map = L.map('map').setView([35.6892, 51.3890], 12); // مختصات تهران

    // افزودن لایه نقشه از OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    let startPoint = null;
    let endPoint = null;
    let returnPoint = null; // نقطه برگشت
    let startMarker = null;
    let endMarker = null;
    let returnMarker = null; // مارکر نقطه برگشت

    // افزودن مارکر قابل جابجایی
    function addDraggableMarker(latLng, color, isStartPoint, isReturnPoint = false) {
        const marker = L.marker(latLng, {
            icon: L.divIcon({
                className: 'custom-marker',
                html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%;"></div>`
            }),
            draggable: true
        }).addTo(map);

        marker.on('dragend', () => {
            const newLatLng = marker.getLatLng();
            if (isStartPoint) {
                startPoint = [newLatLng.lng, newLatLng.lat];
            } else if (isReturnPoint) {
                returnPoint = [newLatLng.lng, newLatLng.lat];
            } else {
                endPoint = [newLatLng.lng, newLatLng.lat];
            }
            checkRoute();
        });

        return marker;
    }

    // انتخاب نقطه با کلیک روی نقشه
    map.on('click', (e) => {
        const coordinates = [e.latlng.lng, e.latlng.lat];
        if (!startPoint) {
            // نقطه شروع
            if (startMarker) startMarker.remove();
            startPoint = coordinates;
            startMarker = addDraggableMarker(startPoint, 'green', true);
            tripData.startPoint = coordinates; // ذخیره در آرایه گلوبال
            no = no + 1;
            getAddress(startPoint, "نقطه شروع", no);
        } else if (!endPoint) {
            // نقطه پایان
            if (endMarker) endMarker.remove();
            endPoint = coordinates;
            endMarker = addDraggableMarker(endPoint, 'red', false);
            tripData.endPoint = coordinates; // ذخیره در آرایه گلوبال
            no = no + 1;
            getAddress(endPoint, "نقطه پایان", no);
        } else if (!returnPoint) {
            // نقطه برگشت
            const distanceToStart = turf.distance(turf.point(startPoint), turf.point(coordinates));
            if (distanceToStart < 0.1) { // اگر نزدیک به نقطه شروع باشد
                returnPoint = startPoint; // برگشت به نقطه اول
                if (returnMarker) returnMarker.remove();
                returnMarker = addDraggableMarker(returnPoint, 'blue', true, true); // مارکر نقطه برگشت
                tripData.returnPoint = coordinates; // ذخیره در آرایه گلوبال
                console.log(`نقطه برگشت انتخاب شد: ${returnPoint} (به نقطه شروع برگشت)`);
                no = no + 1;
                $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">مسیر برگشتی</td><td class="unit"> بله </td></tr>');
            } else {
                if (returnMarker) returnMarker.remove();
                returnPoint = coordinates;
                returnMarker = addDraggableMarker(returnPoint, 'blue', false, true); // مارکر نقطه برگشت
                console.log(`نقطه برگشت انتخاب شد: ${returnPoint}`);
            }
            checkRoute(); // بعد از انتخاب، مسیر نمایش داده شود
        } else {
            console.log("هر سه نقطه قبلاً انتخاب شده‌اند. ابتدا یکی را جابجا کنید.");
        }
    });

    // تابع برای دریافت آدرس متنی از مختصات
    function getAddress(lngLat, pointType, no) {
        const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${lngLat[0]},${lngLat[1]}.json?language=fa&access_token=${mapboxgl.accessToken}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let addressParts = [];
                let clickedLocationName = ''; // برای ذخیره نام دقیق نقطه کلیک شده

                if (data.features && data.features.length > 0) {
                    const preciseLocation = data.features.find(feature => feature.place_type.includes('address') || feature.place_type.includes('poi'));
                    if (preciseLocation) {
                        clickedLocationName = preciseLocation.text; // نام کوچه یا محل خاص
                    }

                    data.features.forEach(feature => {
                        if (feature.place_type.includes('place')) {
                            addressParts.push(feature.text); // اضافه کردن شهر
                        } else if (feature.place_type.includes('locality')) {
                            addressParts.push(feature.text); // اضافه کردن منطقه
                        } else if (feature.place_type.includes('neighborhood')) {
                            addressParts.push(feature.text); // اضافه کردن محله
                        }
                    });

                    if (clickedLocationName) {
                        addressParts.push(clickedLocationName); // اضافه کردن به انتهای آدرس
                    }

                    let fullAddress = addressParts.join(', ');
                    const countryName = "ایران";
                    if (fullAddress.endsWith(countryName)) {
                        fullAddress = fullAddress.substring(0, fullAddress.length - countryName.length).trim();
                    }

                    console.log(`${pointType} آدرس: ${fullAddress}`);
                    address = '<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">' + pointType + '</td><td class="unit">' + fullAddress + ' </td></tr>';
                    $(".factor").append(address);
                } else {
                    console.log("آدرس پیدا نشد");
                }
            })
            .catch(error => console.error('خطا در دریافت آدرس:', error));
    }

    function checkRoute() {
        if (startPoint && endPoint) {
            const waypoints = returnPoint && returnPoint !== startPoint
                ? `${startPoint[0]},${startPoint[1]};${endPoint[0]},${endPoint[1]};${returnPoint[0]},${returnPoint[1]}`
                : `${startPoint[0]},${startPoint[1]};${endPoint[0]},${endPoint[1]}`;

            // درخواست محاسبه مسیر
            const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${waypoints}?geometries=geojson&access_token=${mapboxgl.accessToken}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.routes && data.routes.length > 0) {
                        const route = data.routes[0];
                        const geojsonRoute = route.geometry;
                        tripData.fareDetails.distance = route.distance; // کیلومتر
                        tripData.fareDetails.duration = route.duration; // ثانیه

                        const fare = calculateFare(tripData.fareDetails.distance);
                        tripData.fareDetails.fare = fare; // محاسبه کرایه

                        console.log(`مسافت: ${route.distance / 1000} کیلومتر`);
                        console.log(`مدت زمان: ${route.duration / 60} دقیقه`);
                        console.log(`کرایه: ${fare} تومان`);

                        L.geoJSON(geojsonRoute, {
                            style: { color: '#0000FF', weight: 5 }
                        }).addTo(map);
                    } else {
                        console.log("مسیر پیدا نشد");
                    }
                })
                .catch(error => console.error('خطا در دریافت مسیر:', error));
        }
    }

    function calculateFare(distance) {
        // محاسبه کرایه بر اساس فاصله (مثال)
        const baseFare = 5000; // قیمت پایه
        const farePerKm = 2000; // قیمت به ازای هر کیلومتر
        return baseFare + (distance / 1000) * farePerKm;
    }



    
    $("#addService").on('click', function () {

        var btn = $(this);

        tripData.passenger = $("#passenger").val();
        tripData.driver = $("#driver").val();
        tripData.car = $("#Cars").val();
        tripData.callDate = $('input[name="call_date"]').val();
        tripData.tripDate = $('input[name="trip_date"]').val();
        tripData.desc = $('textarea[name="desc"]').val();
        tripData.isFactor = $('input[name="isFactor"]:checked').val() ? true : false;
        tripData.isPaid = $('input[name="isPaid"]:checked').val() ? true : false;
        tripData.isTax = $('input[name="isTax"]:checked').val() ? true : false;


        // console.log(tripData);

        $(".spinner-border").fadeIn();
        // $(this).attr("disabled" , "disabled");


        $.ajax({
            type: "POST",
            url: base + "Service/createOrder",
            data: tripData,
            success: function (data) {
                // console.log(data)

                if (data.status == "success") {
                    window.location.replace(base + 'Service/');
                    return false;

                } else {
                    btn.attr("disabled", "");
                }
            }
        });


    });



    
});
