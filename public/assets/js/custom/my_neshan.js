
// آرایه گلوبال برای ذخیره اطلاعات مهم
// let tripData = {
//     startPoint: null,
//     endPoint: null,
//     returnPoint: null,
//     isReturnTrip: null,
//     fareDetails: {
//         distance: null,
//         duration: null,
//         fare: null,
//     },
//     passenger: null,
//     driver: null,
//     car: null
// };


let tripData = {
    startPoint: null,
    endPoint: null,
    distance: null,
    travelTime: null,
    toll: null
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
        $(".factor").append('<tr><td class="no">0' + no + '</td><td class="text-left" colspan="2">راننده سرویس</td><td class="unit">' + car + ' </td></tr>');

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








    // API Key نشان که از پنل خود دریافت کرده‌اید
    const API_KEY = 'web.840318dd773d4122a1d07e932344af55';

    // ساخت نقشه نشان
    let map = new L.Map('map', {
        key: API_KEY,
        maptype: 'neshan',
        center: [35.6892, 51.3890], // مختصات تهران
        zoom: 8
    });

    //     // ایجاد نقشه
    // const map = new mapboxgl.Map({
    //     container: 'map',
    //     style: 'mapbox://styles/mapbox/streets-v11', // استفاده از استایل نقشه فارسی
    //     center: [51.3890, 35.6892], // مختصات تهران
    //     zoom: 12
    // });



    let startMarker, endMarker;


    map.on('click', function (e) {
        if (!tripData.startPoint) {
            // انتخاب نقطه شروع
            tripData.startPoint = [e.latlng.lat, e.latlng.lng];
            startMarker = L.marker(tripData.startPoint).addTo(map);
            console.log(`نقطه شروع انتخاب شد: ${tripData.startPoint}`);
        } else if (!tripData.endPoint) {
            // انتخاب نقطه پایان
            tripData.endPoint = [e.latlng.lat, e.latlng.lng];
            endMarker = L.marker(tripData.endPoint).addTo(map);
            console.log(`نقطه پایان انتخاب شد: ${tripData.endPoint}`);



            // رسم مسیر بین دو نقطه با استفاده از API نشان
            drawRouteWithAPI();
        } else {
            console.log("نمی‌توانید نقطه دیگری اضافه کنید.");
        }
    });






    // تابع دریافت آدرس متنی از مختصات
    function getAddressFromCoordinates(coordinates, label) {
        const [lat, lng] = coordinates;

        const url = `https://api.neshan.org/v1/reverse?lat=${lat}&lng=${lng}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Api-Key': `service.89629a97053c4dd3bd06adb146db6886` // کلید API خود را اینجا قرار دهید
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log(`${label} آدرس: ${data.address}`);
            })
            .catch(error => console.error('Error:', error));
    }




    // تابع رسم خط مسیر
    function drawRouteWithAPI() {
        const [startLat, startLng] = tripData.startPoint;
        const [endLat, endLng] = tripData.endPoint;

        // ساخت URL برای درخواست مسیر با اطلاعات جدید


        const url = `https://api.neshan.org/v4/direction?type=car&origin=${startLat},${startLng}&destination=${endLat},${endLng}&avoidTrafficZone=false&avoidOddEvenZone=false&alternative=false&bearing=`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Api-Key': `service.89629a97053c4dd3bd06adb146db6886` // کلید API شما
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.routes[0].legs[0].distance); // برای بررسی ساختار پاسخ
                console.log(data.routes[0].legs[0].duration); // برای بررسی ساختار پاسخ

                tripData.distance = data.routes[0].legs[0].distance.value/1000;
                tripData.travelTime = data.routes[0].legs[0].duration.text;

                // محاسبه مسافت و زمان رسیدن
                $(".fare").append(`مسافت: ${data.routes[0].legs[0].distance.value/1000} <br/>`);
                $(".fare").append(`زمان تقریبی رسیدن: ${tripData.travelTime}  <br/>`);


                // بررسی وجود routes و دسترسی به آن
                if (data.routes && data.routes.length > 0) {
                    const polylinePoints = data.routes[0].overview_polyline.points;
                    const coordinates = polyline.decode(polylinePoints).map(coord => [coord[0], coord[1]]);

                    // رسم خط مسیر
                    routeLine = L.polyline(coordinates, { color: 'blue' }).addTo(map);
                    map.fitBounds(routeLine.getBounds()); // زوم و مرکز کردن نقشه به خط مسیر

                    // دریافت آدرس متنی با استفاده از API نشان
                    getAddressFromCoordinates(tripData.startPoint, "نقطه شروع");
                    getAddressFromCoordinates(tripData.endPoint, "نقطه پایان");
                } else {
                    console.error('مسیر یافت نشد یا داده‌ها معتبر نیستند:', data);
                }
            })
            .catch(error => console.error('Error:', error));
    }



    // تابع محاسبه کرایه
    function calculateFare() {
        const distance = tripData.distance;
        const toll = getRandomToll(); // دریافت مبلغ عوارض
        const isHoliday = checkIfHoliday(); // چک کردن تعطیلی
        const weather = document.getElementById('weather').value;
        const roadCondition = document.getElementById('roadCondition').value;
        const carType = document.getElementById('carType').value;

        let baseRate = 20000; // قیمت پایه هر کیلومتر

        console.log(distance);

        baseRate = baseRate * weather * roadCondition * carType;

        // تغییر نرخ براساس وضعیت جوی
        // switch (weather) {
        //     case 'rainy':
        //         baseRate *= 1.1; // 10% افزایش در بارانی
        //         break;
        //     case 'snowy':
        //         baseRate *= 1.25; // 25% افزایش در برفی
        //         break;
        // }

        // // تغییر نرخ براساس وضعیت جاده
        // switch (roadCondition) {
        //     case 'bad_highway':
        //         baseRate *= 1.2; // 20% افزایش در اتوبان با جاده بد
        //         break;
        //     case 'normal':
        //         baseRate *= 1.1; // 10% افزایش در جاده عادی
        //         break;
        //     case 'bad_dirt':
        //         baseRate *= 1.3; // 30% افزایش در جاده خاکی بد
        //         break;
        // }

        // // تغییر نرخ براساس نوع خودرو
        // switch (carType) {
        //     case 'eco+':
        //         baseRate *= 1.1; // 10% افزایش
        //         break;
        //     case 'vip':
        //         baseRate *= 1.2; // 20% افزایش
        //         break;
        //     case 'vip+':
        //         baseRate *= 1.3; // 30% افزایش
        //         break;
        //     case 'vip suv':
        //         baseRate *= 1.5; // 50% افزایش
        //         break;
        // }

        // // تغییر نرخ برای روزهای تعطیل
        if (isHoliday) {
            baseRate *= 1.2; // 20% افزایش در روزهای تعطیل
        }

        console.log(baseRate);

        // محاسبه کرایه نهایی
        const fare = (distance * baseRate) + toll;

        $(".total").html(`<b>کرایه نهایی: ${formatFare(fare.toFixed(0))} تومان </b>`)
    }

    // تابع تولید عوارض جاده
    function getRandomToll() {
        const toll = Math.floor(Math.random() * (100000 - 10000 + 1)) + 10000;
        tripData.toll = toll;
        return toll;
    }

    // تابع بررسی تعطیلی
    function checkIfHoliday() {
        const today = new Date();
        const day = today.getDay();
        // در ایران روز جمعه (day=5) تعطیل است
        return day === 5;
    }

    // دکمه ریست کردن نقاط و مسیر
    document.getElementById('reset').addEventListener('click', function () {
        if (startMarker) startMarker.remove();
        if (endMarker) endMarker.remove();
        if (routeLine) map.removeLayer(routeLine); // حذف خط مسیر
        tripData.startPoint = null;
        tripData.endPoint = null;
        $(".fare").empty();
        $(".total").empty();
        console.log("نقاط و مسیر ریست شد.");
    });

    // دکمه محاسبه کرایه
    document.getElementById('calculate-btn').addEventListener('click', calculateFare);











    function formatFare(amount) {
        precision = 1000;
        amount = Math.ceil(amount / precision) * precision;
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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