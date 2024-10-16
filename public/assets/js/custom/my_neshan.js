
// آرایه گلوبال برای ذخیره اطلاعات مهم
let startMarker, endMarker, routeLine;
let tripData = {
    startPoint: null,
    endPoint: null,
    distance: null,
    travelTime: null,
    toll: null,
    passenger: null,
    driver: null,
    car: null,
    startAdd: null,
    endAdd: null
};



$(document).ready(function () {

    $("body").attr("sidebar-data-theme", "sidebar-hide");

    let no = 0;
    height = self.innerHeight - 170
    $("#map").css("height", height);

    // API Key نشان که از پنل خود دریافت کرده‌اید
    const API_KEY = 'web.840318dd773d4122a1d07e932344af55';
    const Service_KEY = 'service.89629a97053c4dd3bd06adb146db6886';

    // ساخت نقشه نشان
    let map = new L.Map('map', {
        key: API_KEY,
        maptype: 'neshan',
        center: [35.6892, 51.3890], // مختصات تهران
        zoom: 8
    });

    // جستجو روی نقشه
    $("#searchInput").on('input', function () {
        let query = $(this).val();

        // پاک کردن نتایج قبلی در صورت خالی بودن ورودی
        if (query === '') {
            $("#searchResults").html('');
            return;
        }

        // درخواست به API نشان برای جستجو
        fetch(`https://api.neshan.org/v1/search?term=${query}&lat=35.6892&lng=51.3890`, {
            headers: {
                'Api-Key': Service_KEY
            }
        })
            .then(response => response.json())
            .then(data => {
                let results = data.items;
                let searchResults = $("#searchResults");
                searchResults.fadeIn();
                searchResults.html('');

                // نمایش نتایج جستجو
                results.forEach(result => {
                    searchResults.append(`<li class="list-group-item bg-white" data-lat="${result.location.y}" data-lng="${result.location.x}">${result.title}</li>`);
                });

                // انتخاب نتیجه جستجو
                $("#searchResults li").on('click', function () {
                    let lat = $(this).data('lat');
                    let lng = $(this).data('lng');
                    let point = [lat, lng];


                    map.setView(point, 8); // بزرگ‌نمایی روی نقطه جستجو


                    if (!tripData.startPoint) {
                        tripData.startPoint = point;
                        startMarker = L.marker(tripData.startPoint).addTo(map);
                        console.log(`نقطه شروع انتخاب شد: ${tripData.startPoint}`);


                    } else if (!tripData.endPoint) {
                        tripData.endPoint = point;
                        endMarker = L.marker(tripData.endPoint).addTo(map);
                        console.log(`نقطه پایان انتخاب شد: ${tripData.endPoint}`);
                        drawRouteWithAPI(); // رسم مسیر پس از انتخاب مبدا و مقصد
                    }

                    // پاک کردن فیلد جستجو و نتایج
                    $("#searchInput").val('');
                    $("#searchResults").html('');
                    searchResults.hide();
                });
            });
    });


    let startMarker, endMarker;



    map.on('click', function (e) {
        let point = [e.latlng.lat, e.latlng.lng];

        if (!tripData.startPoint) {
            tripData.startPoint = point;
            startMarker = L.marker(tripData.startPoint).addTo(map);
            // console.log(`نقطه شروع انتخاب شد: ${tripData.startPoint}`);

            getAddressFromCoordinates(point, 'start');
        } else if (!tripData.endPoint) {
            tripData.endPoint = point;
            endMarker = L.marker(tripData.endPoint).addTo(map);
            console.log(`نقطه پایان انتخاب شد: ${tripData.endPoint}`);
            getAddressFromCoordinates(point, 'end');
            drawRouteWithAPI(); // رسم مسیر پس از انتخاب نقاط
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

                if (label == "start") {
                    tripData.startAdd = data.state + '-' + data.city + '-' + data.address;
                } else {
                    tripData.endAdd = data.state + '-' + data.city + '-' + data.address;
                }


            })
            .catch(error => console.error('Error:', error));
    }




    // تابع رسم مسیر با API نشان
    function drawRouteWithAPI() {
        const [startLat, startLng] = tripData.startPoint;
        const [endLat, endLng] = tripData.endPoint;

        const url = `https://api.neshan.org/v4/direction?type=car&origin=${startLat},${startLng}&destination=${endLat},${endLng}&avoidTrafficZone=false&avoidOddEvenZone=false&alternative=false&bearing=`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Api-Key': Service_KEY
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.routes && data.routes.length > 0) {
                    const polylinePoints = data.routes[0].overview_polyline.points;
                    const coordinates = polyline.decode(polylinePoints).map(coord => [coord[0], coord[1]]);

                    tripData.distance = data.routes[0].legs[0].distance.value / 1000;
                    tripData.travelTime = data.routes[0].legs[0].duration.text;


                    // console.log(data.routes[0].legs[0].distance); // برای بررسی ساختار پاسخ
                    // console.log(data.routes[0].legs[0].duration); // برای بررسی ساختار پاسخ


                    // رسم مسیر
                    routeLine = L.polyline(coordinates, { color: 'blue' }).addTo(map);
                    map.fitBounds(routeLine.getBounds());

                } else {
                    console.error("مسیر یافت نشد.");
                }
            });
    }








    // تابع محاسبه کرایه
    function calculateFare() {
        const distance = tripData.distance;
        const toll = getRandomToll(); // دریافت مبلغ عوارض
        const isHoliday = checkIfHoliday(); // چک کردن تعطیلی
        const weather = document.getElementById('weather').value;
        const roadCondition = document.getElementById('roadCondition').value;
        const carType = document.getElementById('carType').value;


        console.log(distance);



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

        // محاسبه کرایه نهایی
        const fare = (distance * baseRate * weather * roadCondition * carType) + toll;

        $(".total").html(`<b>کرایه نهایی: ${formatFare(fare.toFixed(0))} تومان </b>`);

        $("#submit").fadeIn();

        CreateFactor();
    }

    function formatFare(amount) {
        precision = 1000;
        amount = Math.ceil(amount / precision) * precision;
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        $("#submit").fadeOut();
        $(".factor").empty();
        no = 0;
        console.log("نقاط و مسیر ریست شد.");
    });

    // دکمه محاسبه کرایه
    document.getElementById('calculate-btn').addEventListener('click', calculateFare);


    function CreateFactor() {
        ap = '<tr><td class="no">0' + no + 1 + '</td><td class="text-left" colspan="2">مسافت</td><td class="unit">' + data.routes[0].legs[0].distance.value / 1000 + ' کیلومتر</td></tr>';
        $(".factor").append(ap);

        ap = '<tr><td class="no">0' + no + 1 + '</td><td class="text-left" colspan="2">زمان تقریبی رسیدن</td><td class="unit">' + tripData.travelTime + '</td></tr>';
        $(".factor").append(ap);
     
        start = '<tr><td class="no">0' + no+1 + '</td><td class="text-left" colspan="2">' + label + '</td><td class="unit">' + tripData.startAdd + '</td></tr>';
        $(".factor").append(start);

        end = '<tr><td class="no">0' + no+1 + '</td><td class="text-left" colspan="2">' + label + '</td><td class="unit">' + tripData.endAdd + '</td></tr>';
        $(".factor").append(end);
    }

});