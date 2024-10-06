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
                data = JSON.parse(data)
                $.each(data, function (index, car) {
                    carsHtml += '<option value="' + car.cid + '">' + car.car_brand + ' | ایران ' + car.iran + car.harf + car.pelak + car.pelak_last + '</option>';
                });

                console.log(data.length);

                if (data.length == 1) {

                    no = no + 1;
                    $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2"> خودرو</td><td class="unit">' + data[0].car_brand + ' | ایران ' + data[0].iran + data[0].harf + data[0].pelak + data[0].pelak_last + ' </td></tr>');


                }
                $('#Cars').html(carsHtml);
                $('#Cars').trigger('chosen:updated');
            }
        });
    });


    mapboxgl.accessToken = 'pk.eyJ1IjoicmVkaGF0NSIsImEiOiJjazV1cDdramoweDQwM2hsbzdqeGg2eXJwIn0.rE2Vf8qf_hAr3ZN2uAlQuw';

    // فعال کردن پلاگین RTL
    mapboxgl.setRTLTextPlugin(
        "https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js",
        null,
        true
    );

    // ایجاد نقشه
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11', // استفاده از استایل نقشه فارسی
        center: [51.3890, 35.6892], // مختصات تهران
        zoom: 12
    });

    // افزودن کنترل جستجو
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        placeholder: "منطقه را جستجو کنید",
        mapboxgl: mapboxgl
    });
    map.addControl(geocoder, 'top-left');


    let startPoint = null;
    let endPoint = null;
    let returnPoint = null; // نقطه برگشت
    let startMarker = null;
    let endMarker = null;
    let returnMarker = null; // مارکر نقطه برگشت

    // افزودن مارکر قابل جابجایی
    function addDraggableMarker(lngLat, color, isStartPoint, isReturnPoint = false) {
        const marker = new mapboxgl.Marker({
            color: color,
            draggable: true
        })
            .setLngLat(lngLat)
            .addTo(map);

        marker.on('dragend', () => {
            const newLngLat = marker.getLngLat();
            if (isStartPoint) {
                startPoint = [newLngLat.lng, newLngLat.lat];
            } else if (isReturnPoint) {
                returnPoint = [newLngLat.lng, newLngLat.lat];
            } else {
                endPoint = [newLngLat.lng, newLngLat.lat];
            }
            checkRoute();
        });

        return marker;
    }



    // انتخاب نقطه با کلیک روی نقشه
    map.on('click', (e) => {
        const coordinates = [e.lngLat.lng, e.lngLat.lat];
        if (!startPoint) {
            // نقطه شروع
            if (startMarker) startMarker.remove();
            startPoint = coordinates;
            startMarker = addDraggableMarker(startPoint, 'green', true);


            no = no + 1;
            getAddress(startPoint, "نقطه شروع", no);


        } else if (!endPoint) {
            // نقطه پایان
            if (endMarker) endMarker.remove();
            endPoint = coordinates;
            endMarker = addDraggableMarker(endPoint, 'red', false);

            no = no + 1;
            getAddress(endPoint, "نقطه پایان", no);


        } else if (!returnPoint) {
            // نقطه برگشت
            const distanceToStart = turf.distance(turf.point(startPoint), turf.point(coordinates));
            if (distanceToStart < 0.1) { // اگر نزدیک به نقطه شروع باشد
                returnPoint = startPoint; // برگشت به نقطه اول
                if (returnMarker) returnMarker.remove();
                returnMarker = addDraggableMarker(returnPoint, 'blue', true, true); // مارکر نقطه برگشت
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
    // تابع برای دریافت آدرس متنی از مختصات به زبان فارسی و حذف کشور
    // تابع برای دریافت آدرس متنی دقیق از مختصات به زبان فارسی
    // تابع برای دریافت آدرس متنی دقیق از مختصات به زبان فارسی و ترکیب بخش‌های مختلف آدرس
    function getAddress(lngLat, pointType, no) {
        const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${lngLat[0]},${lngLat[1]}.json?language=fa&access_token=${mapboxgl.accessToken}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let addressParts = [];
                let clickedLocationName = ''; // برای ذخیره نام دقیق نقطه کلیک شده

                //console.log(data.features);

                if (data.features && data.features.length > 0) {
                    // بررسی دقیق‌ترین نقطه (مثلاً کوچه یا محل خاص)
                    const preciseLocation = data.features.find(feature => feature.place_type.includes('address') || feature.place_type.includes('poi'));
                    if (preciseLocation) {
                        clickedLocationName = preciseLocation.text; // نام کوچه یا محل خاص
                    }

                    // بررسی بخش‌های مختلف آدرس
                    data.features.forEach(feature => {
                        if (feature.place_type.includes('place')) {
                            addressParts.push(feature.text); // اضافه کردن شهر
                        } else if (feature.place_type.includes('locality')) {
                            addressParts.push(feature.text); // اضافه کردن منطقه
                        } else if (feature.place_type.includes('neighborhood')) {
                            addressParts.push(feature.text); // اضافه کردن محله
                        }
                    });


                    // اضافه کردن نام دقیق نقطه کلیک شده (کوچه یا خیابان) به انتهای آدرس
                    if (clickedLocationName) {
                        addressParts.push(clickedLocationName); // اضافه کردن به انتهای آدرس
                    }

                    // ساخت آدرس نهایی با ترکیب بخش‌های مختلف (از بزرگ به کوچک)
                    let fullAddress = addressParts.join(', ');

                    // حذف نام کشور از آدرس (حذف "ایران" در انتهای آدرس)
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
                : `${startPoint[0]},${startPoint[1]};${endPoint[0]},${endPoint[1]}`; // نقطه برگشت را اضافه می‌کنیم

            const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${waypoints}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const route = data.routes[0].geometry;
                    const distance = data.routes[0].distance / 1000; // به کیلومتر
                    let duration = data.routes[0].duration / 60; // به دقیقه

                    // console.log(`مسافت: ${distance.toFixed(2)} کیلومتر`);
                    // console.log(`زمان تقریبی: ${formatDuration(duration)}`);

                    no = no + 1;
                    Alldistance = '<tr><td class="no">0' + (no) + '</td><td class="text-left" colspan="2">مسافت</td><td class="unit">' + distance.toFixed(2) + ' کیلومتر</td></tr>';
                    no = no + 1;
                    TotalTime = '<tr><td class="no">0' + (no) + '</td><td class="text-left" colspan="2">زمان تقریبی</td><td class="unit">' + formatDuration(duration) + ' </td></tr>';

                    $(".factor").append(Alldistance);
                    $(".factor").append(TotalTime);


                    if (map.getSource('route')) {
                        map.removeLayer('route');
                        map.removeSource('route');
                    }

                    map.addSource('route', {
                        type: 'geojson',
                        data: {
                            type: 'Feature',
                            geometry: route
                        }
                    });
                    map.addLayer({
                        id: 'route',
                        type: 'line',
                        source: 'route',
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': '#3887be',
                            'line-width': 5,
                            'line-opacity': 0.75
                        }
                    });

                    const bounds = turf.bbox(route);
                    map.fitBounds(bounds, {
                        padding: 20
                    });

                    console.log(returnPoint);

                    // محاسبه کرایه با توجه به نقاط
                    const fare = calculateFare(startPoint, endPoint, returnPoint, distance, duration, false, false);
                    console.log(`مبلغ کرایه: ${fare} تومان`);


                    $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">راننده سرویس</td><td class="unit">' + driver_name + ' </td></tr>');

                });
        }
    }









    // فرمت زمان براساس دقیقه، ساعت و روز
    function formatDuration(duration) {
        if (duration < 60) {
            return `${duration.toFixed(0)} دقیقه`;
        } else if (duration < 1440) {
            const hours = Math.floor(duration / 60);
            const minutes = duration % 60;
            return `${hours} ساعت و ${minutes.toFixed(0)} دقیقه`;
        } else {
            const days = Math.floor(duration / 1440);
            const hours = Math.floor((duration % 1440) / 60);
            const minutes = duration % 60;
            return `${days} روز و ${hours} ساعت و ${minutes.toFixed(0)} دقیقه`;
        }
    }

    // تابع ریست کردن نقاط و مسیر
    function resetMarkers() {
        if (startMarker) startMarker.remove();
        if (endMarker) endMarker.remove();
        if (returnMarker) returnMarker.remove(); // ریست مارکر برگشت
        if (map.getSource('route')) {
            map.removeLayer('route');
            map.removeSource('route');
        }
        startPoint = null;
        endPoint = null;
        returnPoint = null; // ریست نقطه برگشت

        $(".factor").empty();
        $("tfoot").empty();
        no = 0;
    }


    // افزودن event listener به دکمه ریست
    document.getElementById('reset-btn').addEventListener('click', resetMarkers);












    let itemCount = 1;
    let subtotal = 0;

    $('#addItem').on('click', function () {
        const description = $('#description').val();
        const hourPrice = parseFloat($('#hourPrice').val());

        if (description && !isNaN(hourPrice)) {
            const newRow = `
                <tr>
                    <td class="no">${itemCount}</td>
                    <td class="text-left" colspan="2">${description}</td>
                    <td class="unit">$${hourPrice.toFixed(2)}</td>
                </tr>
            `;

            $('#invoice tbody').append(newRow);
            itemCount++;

            subtotal += hourPrice;
            updateSubtotal(subtotal);
        } else {
            alert('Please enter a valid description and hour price.');
        }
    });

    function updateSubtotal(subtotal) {
        const tax = subtotal * 0.25;
        const grandTotal = subtotal + tax;

        $('#invoice tfoot').html(`
            <tr>
                <td colspan="2"></td>
                <td colspan="1">SUBTOTAL</td>
                <td>$${subtotal.toFixed(2)}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="1">TAX 25%</td>
                <td>$${tax.toFixed(2)}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="1">GRAND TOTAL</td>
                <td>$${grandTotal.toFixed(2)}</td>
            </tr>
        `);
    }

    // تابع محاسبه کرایه
    function calculateFare(startPoint, endPoint, returnPoint, distance, duration, isCancelled, isHourly) {
        const kmRateDay = 8500; // کرایه هر کیلومتر از ساعت 6 صبح الی 22 شب
        const kmRateNight = 9500; // کرایه هر کیلومتر از ساعت 22 شب الی 6 صبح
        const kmRateOutsideDayOneWay = 24000; // کرایه هر کیلومتر خارج از شهر (یکطرفه)
        const kmRateOutsideDayRoundTrip = 20000; // کرایه هر کیلومتر خارج از شهر (رفت و برگشت)
        const cancellationFee = 55000; // هزینه کنسلی
        const hourlyRate = 350000; // کارکرد ساعتی
        const urbanAreaLimit = 50; // محدوده شهری به کیلومتر
        const returnDistanceThreshold = 5; // 500 متر معادل 0.5 کیلومتر

        let totalFare = 0;

        // زمان کنونی
        const now = new Date();
        const currentHours = now.getHours();

        // محاسبه کرایه بر اساس زمان (تشخیص روز یا شب)
        const isDayTime = currentHours >= 6 && currentHours < 22;

        // پاک کردن مقادیر قبلی در tfoot
        $("tfoot").empty();

        // در صورتی که سفر کنسل شده باشد
        if (isCancelled) {
            totalFare += cancellationFee;
            $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">کنسلی</td><td>' + formatFare(cancellationFee) + ' ریال</td></tr>');
            return totalFare; // فقط هزینه کنسلی برگردانده می‌شود
        }

        // در صورتی که کارکرد بصورت ساعتی باشد
        if (isHourly) {
            totalFare += hourlyRate; // هزینه کارکرد ساعتی
            $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">کارکرد ساعتی</td><td>' + formatFare(hourlyRate) + ' ریال</td></tr>');
            return totalFare; // فقط هزینه کارکرد ساعتی برگردانده می‌شود
        }

        // محاسبه کرایه براساس کیلومتر
        const kmRate = isDayTime ? kmRateDay : kmRateNight;

        // بررسی فاصله بین نقطه سوم و نقطه اول
        let isReturnTrip = false;
        if (returnPoint) {
            const returnDistance = calculateDistance(startPoint, returnPoint); // محاسبه فاصله بین نقطه اول و سوم
            isReturnTrip = returnDistance <= returnDistanceThreshold; // اگر فاصله کمتر از 500 متر باشد
        }

        // بررسی فاصله برای نقاط دوم و سوم
        const isEndPointOutsideUrban = distance > urbanAreaLimit; // بررسی نقطه دوم

        // محاسبه کرایه بر اساس نقاط
        let distanceFare = 0;
        if (isReturnTrip) {
            // مسیر برگشت (راننده به نقطه شروع برمی‌گردد)
            if (isEndPointOutsideUrban) {
                distanceFare = 2 * distance * kmRateOutsideDayRoundTrip; // رفت و برگشت خارج از شهر
                $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">کرایه رفت و برگشت خارج از شهر</td><td>' + formatFare(distanceFare) + ' ریال</td></tr>');
            } else {
                distanceFare = 2 * distance * kmRate; // رفت و برگشت داخل شهر
                $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">کرایه رفت و برگشت داخل شهر</td><td>' + formatFare(distanceFare) + ' ریال</td></tr>');
            }
        } else {
            // مسیر یک‌طرفه
            if (isEndPointOutsideUrban) {
                distanceFare = distance * kmRateOutsideDayOneWay; // یک‌طرفه خارج از شهر
                $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">کرایه یک طرفه خارج از شهر</td><td>' + formatFare(distanceFare) + ' ریال</td></tr>');
            } else {
                distanceFare = distance * kmRate; // یک‌طرفه داخل شهر
                $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">کرایه یک طرفه داخل شهر</td><td>' + formatFare(distanceFare) + ' ریال</td></tr>');
            }
        }

        totalFare += distanceFare;

        // بازگشت کل کرایه
        $("tfoot").append('<tr><td colspan="2"></td><td colspan="1">مجموع کرایه</td><td>' + formatFare(totalFare) + ' ریال</td></tr>');

        return totalFare;
    }

    // تابع محاسبه فاصله بین دو نقطه بر حسب کیلومتر
    function calculateDistance(point1, point2) {
        const R = 6371; // شعاع زمین به کیلومتر
        const dLat = toRadians(point2[1] - point1[1]);
        const dLng = toRadians(point2[0] - point1[0]);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRadians(point1[1])) * Math.cos(toRadians(point2[1])) *
            Math.sin(dLng / 2) * Math.sin(dLng / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // فاصله به کیلومتر
    }

    // تبدیل درجه به رادیان
    function toRadians(degree) {
        return degree * (Math.PI / 180);
    }





    // تابع محاسبه فاصله بین دو نقطه
    function calculateDistance(pointA, pointB) {
        const lat1 = pointA[1];
        const lon1 = pointA[0];
        const lat2 = pointB[1];
        const lon2 = pointB[0];

        const R = 6371; // شعاع زمین به کیلومتر
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;

        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c; // فاصله بر حسب کیلومتر
    }


    function formatFare(amount) {
        precision = 1000;
        amount = Math.ceil(amount / precision) * precision;
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }



});