<div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
    <form action="/updateTrip" method="post">
        <input type="hidden" name="trip_id" value="<?= $Trip['id'] ?>">
        <div class="modal-content" style="width: 800px !important">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            ویرایش استعلام
                        </div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-md-12">
                                    <label for="startAdd"><strong>مبدا:</strong></label>
                                    <input type="text" id="startAdd" name="startAdd" class="form-control" value="<?= $Trip['startAdd'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="endAdd"><strong>مقصد:</strong></label>
                                    <input type="text" id="endAdd" name="endAdd" class="form-control" value="<?= $Trip['endAdd'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="trip_date"><strong>تاریخ سفر:</strong></label>
                                    <input type="text" id="trip_date" name="trip_date" class="form-control" placeholder="روز/ماه/سال" data-jdp="" value="<?= $Trip['trip_date'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="trip_time"><strong>زمان سفر:</strong></label>
                                    <input type="text" id="trip_time" name="trip_time" class="form-control" data-jdp="" data-jdp-only-time="" value="<?= $Trip['trip_time'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">

                                <!-- Trip Date -->

                                <div class="col-md-6">
                                    <label for="trip_date"><strong>تاریخ تماس:</strong></label>
                                    <input type="text" id="call_date" name="call_date" class="form-control" placeholder="روز/ماه/سال" data-jdp="" value="<?= $Trip['call_date'] ?>">
                                </div>


                                <!-- <div class="col-md-6">
                                    <label for="weather"><strong>وضعیت هوا:</strong></label>
                                    <select id="weather" name="weather" class="form-control">
                                        <option value="sunny" <?= $Trip['weather'] == 'sunny' ? 'selected' : '' ?>>مساعد</option>
                                        <option value="rainy" <?= $Trip['weather'] == 'rainy' ? 'selected' : '' ?>>بارانی</option>
                                        <option value="snowy" <?= $Trip['weather'] == 'snowy' ? 'selected' : '' ?>>برفی</option>
                                    </select>
                                </div> -->

                                <div class="col-md-6">
                                    <label for="trip_time"><strong>زمان سفر:</strong></label>
                                    <input type="text" id="call_time" name="call_time" class="form-control" data-jdp="" data-jdp-only-time="" value="<?= $Trip['call_time'] ?>">
                                </div>



                            </div>



                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="passengerFare"><strong>کرایه اعلامی به مسافر:</strong></label>
                                    <input type="text" id="passengerFare" name="passengerFare" class="form-control" value="<?= number_format($Trip['userCustomFare']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="driverFare"><strong>کرایه اعلامی به راننده:</strong></label>
                                    <input type="text" id="driverFare" name="driverFare" class="form-control" value="<?= number_format($Trip['driverCustomFare']) ?>">
                                </div>
                            </div>







                            <div class="row my-2">



                                <div class="col-lg-6">
                                    <label class="label">وضعیت پرداخت</label>
                                    <select name="payment_status" class="form-control" required>
                                        <option value="" <?= empty($Trip['payment_status']) ? 'selected' : '' ?>>انتخاب وضعیت پرداخت</option>

                                        <option value="Paid" <?= $Trip['payment_status'] == 'Paid' ? 'selected' : '' ?>>تسویه شده</option>
                                        <option value="halfPaid" <?= $Trip['payment_status'] == 'halfPaid' ? 'selected' : '' ?>>نیمه پرداخت شده</option>
                                        <option value="notPaid" <?= $Trip['payment_status'] == 'notPaid' ? 'selected' : '' ?>>اصلا پرداخت نشده</option>
                                    </select>
                                </div>




                                <div class="col-lg-6">
                                    <label class="label">نوع سفر</label>
                                    <select name="trip_type" class="form-control" required>
                                        <option value="" <?= empty($Trip['trip_type']) ? 'selected' : '' ?>>انتخاب نوع سفر</option>
                                        <option value="one_way" <?= $Trip['trip_type'] == 'one_way' ? 'selected' : '' ?>>یک طرفه رفت</option>
                                        <option value="round_trip" <?= $Trip['trip_type'] == 'round_trip' ? 'selected' : '' ?>>رفت و برگشت</option>
                                        <option value="round_trip_with_stop" <?= $Trip['trip_type'] == 'round_trip_with_stop' ? 'selected' : '' ?>>رفت ، توقف ، برگشت</option>
                                        <option value="round_trip_with_service" <?= $Trip['trip_type'] == 'round_trip_with_service' ? 'selected' : '' ?>>رفت ، در اختیار ، برگشت</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <label class="label">راننده</label>
                                    <select data-placeholder="انتخاب راننده" id="driver" name="driverID" class="form-control" required>
                                        <option value="0">بدون راننده</option>

                                        <?php foreach ($driver as $driver): ?>
                                            <option value="<?= $driver['did'] ?>" <?= $Trip['driverID'] == $driver['did'] ? 'selected' : '' ?>>
                                                <?= $driver['code'] . ' -  ' . $driver['name'] . ' ' . $driver['lname']  ?>
                                            </option>
                                        <?php endforeach; ?>

                                        <option value="" <?= empty($Trip['driverID']) ? 'selected' : 'انتخاب راننده' ?>></option>
                                    </select>
                                </div>
                            </div>



                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <label class="label">خودرو</label>
                                    <select data-placeholder="انتخاب خودرو" id="car" name="carID" class="form-control" required>




                                    </select>
                                </div>
                            </div>
                            


                            
                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <label class="label">انتخاب بانک</label>
                                    <select data-placeholder="انتخاب بانک" name="bank" class="form-control" required>

                                        <option value="" <?= empty($Trip['bank']) ? 'selected' : '' ?>>انتخاب بانک</option>
                                        <?php foreach ($banks as $bank): ?>
                                            <option value="<?= $bank['id'] ?>" <?= $Trip['bank'] == $bank['id'] ? 'selected' : '' ?>>
                                                <?= $bank['title'] ?> <?= $bank['bank_name'] ?> <?= $bank['card_number'] ?>
                                            </option>
                                        <?php endforeach; ?>


                                    </select>
                                </div>
                            </div>






                            <hr style="margin: 40px;" />





















                            <div class="row my-2">

                                <!-- Passenger ID -->
                                <div class="form-group col-md-3">
                                    <label class="label">شماره موبایل مشتری</label>
                                    <input type="text" name="Tel" class="form-control" placeholder="شماره موبایل" value="<?= $Trip['passenger_tel'] != 0 ? $Trip['passenger_tel']  : '' ?>" required>
                                </div>

                                <div class="form-group col-md-3" style="margin: 30px 0;">
                                    <button type="button" id="checkID" class="btn btn-outline-danger fw-semibold py-2 px-4 mt-2 me-2 hover-white">
                                        بررسی
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    </button>

                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="label">مسافر کسی دیگر است ؟؟</label>
                                    <select id="isGuest" name="isGuest" class="form-control" required>

                                        <option value="0" <?= $Trip['isGuest'] == '0' ? 'selected' : '' ?>>خیر</option>
                                        <option value="1" <?= $Trip['isGuest'] == '1' ? 'selected' : '' ?>>بله</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row my-2">


                                <!-- Passenger Name -->
                                <div class="form-group mb-4 col-lg-4">
                                    <label class="label">نام مشتری</label>
                                    <input type="text" name="passenger_name" class="form-control" placeholder="نام مشتری" value="<?= $Trip['passenger_name'] ?>" required>
                                </div>

                                <!-- Passenger Phone -->
                                <div class="form-group mb-4 col-lg-4">
                                    <label class="label">شماره تماس مشتری</label>
                                    <input type="text" id="passenger_tel" name="passenger_tel" placeholder="شماره تماس مشتری" class="form-control" value="<?= $Trip['passenger_tel'] ?>">
                                </div>

                                <div class="form-group mb-4 col-lg-4">
                                    <label class="label">نام شرکت</label>
                                    <input type="text" id="company_name" name="company_name" placeholder="نام شرکت" class="form-control" value="<?= $Trip['company_name'] ?>">
                                </div>
                            </div>

                            <!-- Is Guest -->



                            <div class="passengerBox row">
                                <!-- Passenger Name -->
                                <div class="form-group mb-4 col-lg-6" style="float:right">
                                    <label class="label">نام مسافر</label>
                                    <input type="text" name="guest_name" class="form-control" placeholder="نام مسافر" value="<?= $Trip['guest_name'] ?>">
                                </div>

                                <!-- Passenger Phone -->
                                <div class="form-group mb-4 col-lg-6" style="float:right">
                                    <label class="label">شماره تماس مسافر</label>
                                    <input type="tel" name="guest_tel" class="form-control" placeholder="شماره تماس مسافر" value="<?= $Trip['guest_tel'] ?>">
                                </div>

                            </div>


                            <style>
                                .passengerBox {
                                    display: <?= $Trip['isGuest'] == '1' ? 'block' : 'none' ?>;
                                }
                            </style>



                            <div class="row my-2">


                                <div class="col-lg-6"> <label class="label d-block">تعداد مسافر</label>
                                    <div class="product-quantity">
                                        <div class="add-to-cart-counter gap-3 justify-content-between">
                                            <button type="button" class="minusBtn bg-success text-white"></button>
                                            <input type="text" id="total_passenger" name="total_passenger" size="25" class="count border-success" value="<?= $Trip['total_passenger'] ?>">

                                            <button type="button" class="plusBtn pss bg-success text-white"></button>
                                        </div>
                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <label class="label d-block">تعداد ساعت تاخیر</label>
                                    <div class="product-quantity">
                                        <div class="add-to-cart-counter gap-3 justify-content-between">
                                            <button type="button" class="minusBtn bg-success text-white" <?= $Trip['isWait'] == '0' ? '' : '' ?>></button>
                                            <input name="wait_hours" type="text" size="25" value="<?= $Trip['Waithours'] ?>" class="count border-success" <?= $Trip['isWait'] == '0' ? '' : '' ?>>
                                            <button type="button" class="plusBtn bg-success text-white" <?= $Trip['isWait'] == '0' ? '' : '' ?>></button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row my-2">

                                <div class="col-md-6">
                                    <label for="status"><strong>وضعیت سفر:</strong></label>
                                    <select name="status_edit" class="form-select form-control ">
                                        <option value="Called" <?= $Trip['status'] == 'Called' ? 'selected' : '' ?>>استعلام</option>
                                        <option value="Reserved" <?= $Trip['status'] == 'Reserved' ? 'selected' : '' ?>>رزرو</option>
                                        <option value="Notifed" <?= $Trip['status'] == 'Notifed' ? 'selected' : '' ?>>اعلام به راننده</option>
                                        <option value="Requested" <?= $Trip['status'] == 'Requested' ? 'selected' : '' ?>>اعلام آمادگی راننده</option>
                                        <option value="Confirm" <?= $Trip['status'] == 'Confirm' ? 'selected' : '' ?>>پذیرش توسط راننده</option>
                                        <option value="Service" <?= $Trip['status'] == 'Service' ? 'selected' : '' ?>>سرویس درحال انجام</option>
                                        <option value="Cancled" <?= $Trip['status'] == 'Cancled' ? 'selected' : '' ?>>کنسل شده</option>
                                        <option value="Done" <?= $Trip['status'] == 'Done' ? 'selected' : '' ?>>به پایان رسیده</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="package"><strong>بسته:</strong></label>
                                    <select class="form-control" id="packageSelect" name="package_edit">
                                        <?php foreach ($Packages as $item): ?>
                                            <option value="<?= htmlspecialchars($item['name']) ?>" <?= $Trip['package'] == $item['name'] ? 'selected' : '' ?>><?= htmlspecialchars($item['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>




                            <div class="row my-2">

                                <div class="col-md-12">
                                    <label for="status"><strong>توضیحات:</strong></label>
                                    <textarea class="form-control " name="dsc"><?= $Trip['dsc'] ?></textarea>
                                </div>


                                <div class="col-md-12">
                                    <label for="note"><strong>یادداشت:</strong></label>
                                    <textarea class="form-control" name="note"><?= $Trip['note'] ?></textarea>
                                </div>


                                <div class="col-md-12">
                                    <hr>
                                    <div class="map map-container mt-4 bg-secondary text-white text-center" id="edit_map" style="width: 100%;height: 300px;">

                                    </div>


                                </div>



                                <input name="id" value=" <?= $Trip['id'] ?>" type="hidden" />
                                <input type="hidden" name="passenger_id" value="<?= $Trip['passenger_id'] ?>" />
                                <input type="hidden" name="startPoint" value="<?= $Trip['startPoint'] ?>" />
                                <input type="hidden" name="endPoint" value="<?= $Trip['endPoint'] ?>" />
                                <input type="hidden" name="car" value="<?= $Trip['carID'] ?>" />
                                <hr>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary updateTrip">ذخیره تغییرات</button>
                            </div>


                            <div class="card-footer text-muted text-center">
                                تاریخ ایجاد: <?= $Trip['created_at'] ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </form>
</div>









<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />
<script src="<?= base_url() ?>assets/js/custom/edit.js"></script>


<script>
    // const API_KEY = 'web.840318dd773d4122a1d07e932344af55';
    // const Service_KEY = 'service.89629a97053c4dd3bd06adb146db6886';

    startPoint = [<?php echo isset($Trip['startPoint']) ? explode(',', $Trip['startPoint'])[0] : '0' ?>, <?php echo isset($Trip['startPoint']) ? explode(',', $Trip['startPoint'])[1] : '0' ?>];
    endPoint = [<?php echo isset($Trip['endPoint']) ? explode(',', $Trip['endPoint'])[0] : '0' ?>, <?php echo isset($Trip['endPoint']) ? explode(',', $Trip['endPoint'])[1] : '0' ?>];

    // console.log(startPoint);

 


    initMap('EditItem', 'edit_map', startPoint, endPoint, 'service.89629a97053c4dd3bd06adb146db6886', 'web.840318dd773d4122a1d07e932344af55');

    var startPointInput = $("input[name='startPoint']");
    var endPointInput = $("input[name='endPoint']");


    function initMap(modalId, mapId, startCoords, endCoords, Service_KEY, API_KEY) {
        setTimeout(() => {
                // let modalMap = L.map(mapId).setView(startCoords, 12);


                let modalMap = new L.Map(mapId, {
                    key: API_KEY,
                    maptype: 'neshan',
                    center: [35.6892, 51.3890], // مختصات تهران
                    zoom: 8
                });

                L.tileLayer('https://api.neshan.org/v4/BaseMap/{z}/{x}/{y}', {
                    attribution: '© Neshan',
                    maxZoom: 18
                }).addTo(modalMap);


                async function drawRoute(startLat, startLng, endLat, endLng) {
                    modalMap.eachLayer(function(layer) {
                        if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                            modalMap.removeLayer(layer);
                        }
                    });

                    startIcon = L.icon({
                        iconUrl: '../assets/images/start.png',
                        iconSize: [50, 50],
                        iconAnchor: [20, 40],
                        popupAnchor: [0, -60],
                        draggable: true
                    });

                    endIcon = L.icon({
                        iconUrl: '../assets/images/end.png',
                        iconSize: [50, 50],
                        iconAnchor: [20, 40],
                        popupAnchor: [0, -60],
                        draggable: true
                    });


                    let startPoint = L.marker(startCoords, {
                        icon: startIcon,
                        draggable: true
                    }).addTo(modalMap);
                    let endPoint = L.marker(endCoords, {
                        icon: endIcon,
                        draggable: true
                    }).addTo(modalMap);

                    try {
                        let response = await fetch(`https://api.neshan.org/v4/direction?type=car&origin=${startLat},${startLng}&destination=${endLat},${endLng}`, {
                            headers: {
                                'Api-Key': Service_KEY
                            }
                        });

                        if (!response.ok) {
                            console.error('Error fetching route:', response.statusText);
                            return;
                        }

                        let data = await response.json();
                        let polylinePoints = data.routes[0].overview_polyline.points;
                        let routeCoordinates = polyline.decode(polylinePoints).map(coord => [coord[0], coord[1]]);

                        L.polyline(routeCoordinates, {
                            color: 'blue',
                            weight: 5
                        }).addTo(modalMap);

                        modalMap.fitBounds(routeCoordinates);

                        startPoint.on('dragend', function(event) {
                            let newCoords = event.target.getLatLng();
                            startCoords = [newCoords.lat, newCoords.lng]; // Update startCoords
                            drawRoute(newCoords.lat, newCoords.lng, endCoords[0], endCoords[1]);
                            startPointInput.val("" + newCoords.lat + "," + newCoords.lng + "");

                        });

                        endPoint.on('dragend', function(event) {
                            let newCoords = event.target.getLatLng();
                            endCoords = [newCoords.lat, newCoords.lng]; // Update endCoords
                            drawRoute(startCoords[0], startCoords[1], newCoords.lat, newCoords.lng);
                            endPointInput.val("" + newCoords.lat + "," + newCoords.lng + "");
                        });


                        



                        }
                        catch (error) {
                            console.error('Error fetching route:', error);
                        }
                    }

                    drawRoute(startCoords[0], startCoords[1], endCoords[0], endCoords[1]);





                }, 500);


        }
</script>

<style>
    .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        height: 40px;
    }

    .chosen-container.chosen-container-single {
        width: 100% !important;
    }



    a.chosen-single {
        padding: 20px !important;
        height: 60px !important;
        font-size: 15px;
    }

    li.active-result {
        font-size: 16px;
        padding: 10px !important;
    }

    b {
        margin-top: 20px;
        margin-right: -1px;
    }
</style>