<?php

    function getServiceStatus($status)
    {
        switch ($status) {
            case 'Called':
                return 'استعلام';
            case 'Reserved':
                return 'رزرو';
            case 'Notifed':
                return 'اعلام به راننده';
            case 'Requested':
                return 'اعلام آمادگی راننده';
            case 'Confirm':
                return 'پذیرش توسط راننده';
            case 'Cancled':
                return 'کنسل شده';
            case 'Done':
                return 'به پایان رسیده';
            case 'Service':
                return 'سرویس درحال انجام';
            default:
                return 'نامشخص';
        }
    }

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

    function getTripType($type)
    {
        switch ($type) {
            case 'round_trip':
                return 'رفت و برگشت';
            case 'one_way':
                return 'یک طرفه رفت';
            case 'round_trip_with_stop':
                return 'رفت ، توقف ، برگشت';
            case 'round_trip_with_service':
                return 'رفت ، در اختیار ، برگشت';
            default:
                return 'نامشخص';
        }
    }
    require_once APPPATH . 'Libraries/jdf.php';

?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات سفر و فاکتور</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-section {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin-top: 20px;
        }

        .section-header {
            background-color: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            font-weight: bold;
        }

        .map-container {
            height: 300px;
            width: 100%;
        }

        .invoice-table {
            width: 100%;
        }

        .invoice-summary {
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container my-4">
        <!-- Driver and Trip Details Section -->
        <div class="card card-section p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>سفر به مقصد: <strong><?php echo isset($trip['endAdd']) ? htmlspecialchars($trip['endAdd']) : 'نامشخص'?></strong></span>
                <span class="badge bg-primary">وضعیت: <?php echo isset($trip['status']) ? htmlspecialchars(getServiceStatus($trip['status'])) : 'نامشخص'?></span>
                <span>تاریخ ایجاد: <strong>

                <?php
                    $datetime           = explode(' ', $trip['created_at']);
                    $gregorian_date     = explode('-', $datetime[0]);
                    $persian_date_array = gregorian_to_jalali($gregorian_date[0], $gregorian_date[1], $gregorian_date[2]);
                    $persian_date       = implode('/', $persian_date_array);

                    echo $persian_date . ' ' . $datetime[1];

                ?>

                </strong></span>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <strong>راننده:</strong> <?php echo isset($trip['driver_name'], $trip['driver_lname']) ? htmlspecialchars($trip['driver_name'] . ' ' . $trip['driver_lname']) : 'نامشخص'?>

                    <?php if (isset($trip['driver_name'])): ?>
                    | <a style="background:blue;color:white;padding:3px;font-size:12px" href="<?php echo base_url()?>Driver/Info/<?php echo isset($trip['driverID']) ? htmlspecialchars($trip['driverID']) : '0'?>"  id="Info">مشاهده </a>
                        <?php endif; ?>


                    <br>
                    <strong>شماره تماس:</strong> <?php echo isset($trip['driver_mobile']) ? htmlspecialchars($trip['driver_mobile']) : 'نامشخص'?><br>
                </div>
                <div class="col-md-4">

                    <?php if ($trip['isGuest'] > 0): ?>
                        <strong>نام مسافر:</strong> <?php echo isset($trip['passenger_name']) ? htmlspecialchars($trip['passenger_name']) : 'نامشخص'?><br>
                        <strong>شماره تماس مسافر:</strong> <?php echo isset($trip['passenger_tel']) ? htmlspecialchars($trip['passenger_tel']) : 'نامشخص'?><br>

                    <?php else: ?>
                        <strong>نام مسافر:</strong> <?php echo isset($trip['guest_name']) ? htmlspecialchars($trip['guest_name']) : 'نامشخص'?><br>
                        <strong>شماره تماس مسافر:</strong> <?php echo isset($trip['guest_tel']) ? htmlspecialchars($trip['guest_tel']) : 'نامشخص'?><br>

                    <?php endif; ?>

                </div>
                <div class="col-md-4">
                    <strong> ماشین:</strong> <?php echo isset($trip['brand_name']) ? htmlspecialchars($trip['brand_name']) . ' ' . htmlspecialchars($trip['type_name']) : 'نامشخص'?><br>
                    <strong>شماره پلاک:</strong> <?php echo isset($trip['cars_pelak'], $trip['cars_harf'], $trip['cars_pelak_last']) ? htmlspecialchars('ایران' . $trip['cars_iran'] . '-' . $trip['cars_pelak'] . ' ' . $trip['cars_harf'] . ' ' . $trip['cars_pelak_last']) : 'نامشخص'?><br>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <strong>مبدا:</strong> <?php echo isset($trip['startAdd']) ? htmlspecialchars($trip['startAdd']) : 'نامشخص'?><br>
                    <strong>مقصد:</strong> <?php echo isset($trip['endAdd']) ? htmlspecialchars($trip['endAdd']) : 'نامشخص'?><br>
                </div>
                <div class="col-md-6">
                    <strong>تاریخ سفر:</strong> <?php echo isset($trip['trip_date']) ? htmlspecialchars($trip['trip_date']) : 'نامشخص'?><br>
                    <strong>زمان سفر:</strong> <?php echo isset($trip['trip_time']) ? htmlspecialchars($trip['trip_time']) : 'نامشخص'?><br>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-6">
                    <strong>نوع سفر:</strong> <?php echo isset($trip['trip_type']) ? htmlspecialchars(getTripType($trip['trip_type'])) : 'نامشخص'?><br>
                </div>
            </div>

            <!-- Map Placeholder -->
            <div class="map map-container mt-4 bg-secondary text-white text-center" id="map">
            </div>
        </div>

        <!-- Invoice Section -->
        <div class="card card-section p-3 mt-4">
            <div class="section-header">فاکتور هزینه سفر</div>

            <!-- Main Invoice Table -->
            <table class="table table-bordered mt-3 invoice-table">
                <thead class="table-light">
                    <tr>
                        <th>توضیحات</th>
                        <th>مقدار</th>
                        <th>ضریب</th>
                        <th>مبلغ</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Base Fare -->
                    <tr>
                        <td>مبلغ پایه</td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo number_format(! empty($trip['fare']) ? $trip['fare'] : 0)?> تومان</td>
                    </tr>
                    <tr>
                        <td>پکیج</td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo htmlspecialchars(! empty($trip['package']) && ($trip['package'] > 1) ? $trip['package'] : 0)?></td>
                    </tr>

                    <!-- Influencing Factors -->
                    <tr>
                        <td>وضعیت آب‌وهوا</td>
                        <td><?php echo htmlspecialchars(getWeather(! empty($trip['weather']) ? $trip['weather'] : ''))?></td>
                        <td><?php echo htmlspecialchars(! empty($trip['weatherRate']) ? $trip['weatherRate'] : 0)?></td>
                        <td><?php echo number_format((! empty($trip['fare']) ? $trip['fare'] : 0) * ((! empty($trip['weatherRate']) ? $trip['weatherRate'] : 0) - 1))?> تومان</td>
                    </tr>
                    <tr>
                        <td>روز تعطیل</td>
                        <td>-</td>
                        <td><?php echo htmlspecialchars(! empty($trip['holiDayRate']) && ($trip['holiDayRate'] > 1) ? $trip['holiDayRate'] : 0)?></td>
                        <td><?php echo number_format((! empty($trip['fare']) ? $trip['fare'] : 0) * ((! empty($trip['holiDayRate']) ? $trip['holiDayRate'] : 0) - 1))?> تومان</td>
                    </tr>
                    <tr>
                        <td>مسافر اضافه</td>
                        <td>
                            <?php
                                $extraPassengers = ! empty($trip['total_passenger']) && $trip['total_passenger'] > 3 ? $trip['total_passenger'] - 3 : 0;
                                echo htmlspecialchars($extraPassengers);
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars(! empty($trip['extraPassenger']) ? $trip['extraPassenger'] : 0)?></td>
                        <td><?php echo number_format((! empty($trip['fare']) ? $trip['fare'] : 0) * $extraPassengers * (! empty($trip['extraPassenger']) ? $trip['extraPassenger'] : 0))?> تومان</td>
                    </tr>
                    <tr>
                        <td>جاده ناهموار</td>
                        <td><?php echo htmlspecialchars(! empty($trip['badRoadKM']) ? $trip['badRoadKM'] : 0)?> کیلومتر</td>
                        <td><?php echo htmlspecialchars(number_format(! empty($trip['badRoadRate']) ? $trip['badRoadRate'] : 0))?> تومان</td>
                        <td><?php echo number_format((! empty($trip['badRoadKM']) ? $trip['badRoadKM'] : 0) * (! empty($trip['badRoadRate']) ? $trip['badRoadRate'] : 0))?> تومان</td>
                    </tr>
                    <tr>
                        <td>انتظار</td>
                        <td><?php echo htmlspecialchars(! empty($trip['Waithours']) ? $trip['Waithours'] : 0)?> ساعت</td>
                        <td><?php echo htmlspecialchars(number_format(! empty($trip['waitRate']) ? $trip['waitRate'] : 0))?> تومان</td>
                        <td><?php echo number_format((! empty($trip['Waithours']) ? $trip['Waithours'] : 0) * (! empty($trip['waitRate']) ? $trip['waitRate'] : 0))?> تومان</td>
                    </tr>

                    <!-- Tax Row -->
                    <tr>
                        <td>مالیات</td>
                        <td>-</td>
                        <td>-</td>
                        <td>0 تومان</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="table-active invoice-summary">
                        <td colspan="3">مجموع نهایی</td>
                        <td><?php echo number_format(! empty($trip['finalFare']) ? $trip['finalFare'] : 0)?> تومان</td>
                    </tr>

                    <tr>
                        <td>هزینه اعلامی به راننده</td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo number_format(! empty($trip['driverCustomFare']) ? $trip['driverCustomFare'] : 0)?> تومان</td>
                    </tr>
                    <tr>
                        <td>هزینه اعلامی به مسافر</td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo number_format(! empty($trip['userCustomFare']) ? $trip['userCustomFare'] : 0)?> تومان</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>


            startPoint = [<?php echo isset($trip['startPoint']) ? explode(',', $trip['startPoint'])[0] : '0'?>, <?php echo isset($trip['startPoint']) ? explode(',', $trip['startPoint'])[1] : '0'?>];
            endPoint = [<?php echo isset($trip['endPoint']) ? explode(',', $trip['endPoint'])[0] : '0'?>, <?php echo isset($trip['endPoint']) ? explode(',', $trip['endPoint'])[1] : '0'?>];

            map = new L.Map('map', {
                key: 'web.840318dd773d4122a1d07e932344af55',
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



                function drawRoute() {
                    setTimeout(() => {
                        routeLayer.clearLayers();

                        let startLatLng = startPoint.getLatLng();
                        let endLatLng = endPoint.getLatLng();

                        console.log(`Fetching route: ${startLatLng.lat},${startLatLng.lng} → ${endLatLng.lat},${endLatLng.lng}`);

                        fetch(`https://api.neshan.org/v4/direction?type=car&origin=${startLatLng.lat},${startLatLng.lng}&destination=${endLatLng.lat},${endLatLng.lng}`, {
                            headers: { 'Api-Key': 'service.89629a97053c4dd3bd06adb146db6886' }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.routes && data.routes.length > 0) {
                                let routeCoords = data.routes[0].legs[0].steps.flatMap(step =>
                                    step.polyline.map(coord => [coord[0], coord[1]])
                                );

                                let routeLine = L.polyline(routeCoords, { color: 'blue', weight: 5 }).addTo(routeLayer);
                                map.fitBounds(L.latLngBounds([startLatLng, endLatLng]));
                            }
                        })
                        .catch(error => console.error('Error fetching route:', error));
                    }, 2000); // تاخیر 500 میلی‌ثانیه‌ای برای حل مشکل
                }

                drawRoute();

                [startPoint, endPoint].forEach(marker => {
                    marker.on('dragend', drawRoute);
                });

            function convertToJalali(gregorianDate) {
                var [date, time] = gregorianDate.split(" ");
                var [year, month, day] = date.split("-").map(Number);
                var [hour, minute, second] = time.split(":").map(Number);
                var jalaliDate = jalaali.toJalaali(year, month, day);

                return ` ${jalaliDate.jy}/${jalaliDate.jm}/${jalaliDate.jd} ساعت : ${hour}:${minute}:${second}`;
            }


            window.onload = function () {
                setTimeout(drawRoute, 1000);
            };
        </script>

</body>

</html>