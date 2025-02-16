<?php
function getWeather($category)
{
    switch ($category) {
        case 'snowy':
            return 'برفی';
        case 'rainy':
            return 'بارانی';
        default:
            return 'مساعد';
    }
}


function getServiceStatus($status)
{
    switch ($status) {
        case 'Called':
            return 'استعلام';
        case 'Reserved':
            return 'رزرو';
        case 'Confirm':
            return 'پذیرش توسط راننده';
        case 'Notifed':
            return 'اعلام به راننده';
        case 'Requested':
            return 'اعلام آمادگی راننده';
        case 'Cancled':
            return 'کنسل شده';
        case 'Done':
            return 'به پایان رسیده';
        default:
            return 'نامشخص';
    }
    
}


?>

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


            <div class="container">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        اطلاعات سفر
                    </div>
                    <div class="card-body">

                        <?php if ($Trip['isGuest'] > 0): ?>
                            <h5 style="margin: 0;" class="card-title text-center">مسافر: <?= $Trip['passenger_name'] ?></h5>
                        <?php else: ?>
                            <h5 style="margin: 0;" class="card-title text-center">مسافر: <?= $Trip['guest_name'] ?></h5>
                        <?php endif; ?>


                        <?php if (!empty($Trip['company_name'])): ?>
                            <p style="margin: 0;" class="text-muted text-center">شرکت: <?= $Trip['company_name'] ?></p>
                        <?php endif; ?>

                        <p style="margin: 0;" class="text-muted text-center">شناسه: <?= 1000 + $Trip['id'] ?></p>

                        <div class="row my-3">
                            <div class="col-md-6">
                                <strong>مبدا:</strong> <span><?= $Trip['startAdd'] ?></span>
                            </div>
                            <div class="col-md-6">
                                <strong>مقصد:</strong> <span><?= $Trip['endAdd'] ?></span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <strong>تاریخ سفر:</strong> <span><?= $Trip['trip_date'] ?></span>
                            </div>
                            <div class="col-md-6">
                                <strong>زمان سفر:</strong> <span><?= $Trip['trip_time'] ?></span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <strong>وضعیت هوا:</strong> <span><?= getWeather($Trip['weather']) ?></span>
                            </div>
                            <div class="col-md-6">
                                <strong>زمان تقریبی سفر:</strong> <?= $Trip['travelTime'] ?>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <strong>مسافت:</strong> <span><?= $Trip['distance'] ?> کیلومتر</span>
                            </div>
                            <div class="col-md-6">
                                <strong>کرایه نهایی:</strong> <span><?= number_format($Trip['userCustomFare']) ?> تومان</span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <strong>تعداد مسافران:</strong> <span><?= $Trip['total_passenger'] ?> نفر</span>
                            </div>
                            <div class="col-md-6">
                                <strong>وضعیت سفر:</strong> <span><?= getServiceStatus($Trip['status']) ?></span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <?php if ($Trip['isGuest'] > 0): ?>
                                    <strong>شماره تماس مسافر:</strong> <span><?= $Trip['passenger_tel'] ?></span>
                                <?php else: ?>
                                    <strong>شماره تماس مسافر:</strong> <span><?= $Trip['guest_tel'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <strong>بسته:</strong> <span><?= $Trip['package'] ?></span>
                            </div>
                        </div>
                        <hr>
                        <div style="height: 300px;" id="map"></div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        تاریخ ایجاد: <?= $Trip['created_at'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
     gregorianDate = "<?= $Trip['created_at'] ?>";
     jalaliDateTime = convertToJalali(gregorianDate);

    $(".card-footer").html('تاریخ ایجاد:' + jalaliDateTime);


    startPoint = [<?= explode(',', $Trip['startPoint'])[0] ?>, <?= explode(',', $Trip['startPoint'])[1] ?>];
    endPoint = [<?= explode(',', $Trip['endPoint'])[0] ?>, <?= explode(',', $Trip['endPoint'])[1] ?>];

    // ایجاد نقشه و تنظیمات اولیه
    map = new L.Map('map', {
        key: 'web.840318dd773d4122a1d07e932344af55', // اینجا API Key خود را قرار دهید
        center: startPoint,
        zoom: 8,
        maptype: 'neshan'
    });

    startIcon = L.icon({
        iconUrl: '../assets/images/start.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });


    endIcon = L.icon({
        iconUrl: '../assets/images/end.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });



    // تابع برای رسم مسیر
    async function drawRoute(startLat, startLng, endLat, endLng) {
        // پاک کردن نشانگرهای قبلی
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                map.removeLayer(layer);
            }
        });


        // افزودن نشان برای مبدا
        startMarker = L.marker(startPoint, {
            icon: startIcon
        }).addTo(map);

        // افزودن نشان برای مقصد
        endMarker = L.marker(endPoint, {
            icon: endIcon
        }).addTo(map);

        response = await fetch(`https://api.neshan.org/v4/direction?type=car&origin=${startLat},${startLng}&destination=${endLat},${endLng}`, {
            headers: {
                'Api-Key': 'service.89629a97053c4dd3bd06adb146db6886'
            }
        });

        if (!response.ok) {
            console.error('خطا در دریافت مسیر:', response.statusText);
            return;
        }

        data = await response.json();

        polylinePoints = data.routes[0].overview_polyline.points;
        routeCoordinates = polyline.decode(polylinePoints).map(coord => [coord[0], coord[1]]);


        L.polyline(routeCoordinates, {
            color: 'blue',
            weight: 5
        }).addTo(map);

        map.fitBounds(routeCoordinates);
    }

    drawRoute(startPoint[0], startPoint[1], endPoint[0], endPoint[1]);








    //==========================================================

    function convertToJalali(gregorianDate) {
        var [date, time] = gregorianDate.split(" ");
        var [year, month, day] = date.split("-").map(Number);
        var [hour, minute, second] = time.split(":").map(Number);
        var jalaliDate = jalaali.toJalaali(year, month, day);

        return ` ${jalaliDate.jy}/${jalaliDate.jm}/${jalaliDate.jd} ساعت : ${hour}:${minute}:${second}`;
    }

    //==========================================================
</script>