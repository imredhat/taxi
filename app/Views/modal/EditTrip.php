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


                                <div class="col-md-6">
                                    <label for="weather"><strong>وضعیت هوا:</strong></label>
                                    <select id="weather" name="weather" class="form-control">
                                        <option value="sunny" <?= $Trip['weather'] == 'sunny' ? 'selected' : '' ?>>آفتابی</option>
                                        <option value="rainy" <?= $Trip['weather'] == 'rainy' ? 'selected' : '' ?>>بارانی</option>
                                        <option value="snowy" <?= $Trip['weather'] == 'snowy' ? 'selected' : '' ?>>برفی</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="travelTime"><strong>زمان تقریبی سفر:</strong></label>
                                    <input type="text" id="travelTime" name="travelTime" class="form-control" value="<?= $Trip['travelTime'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="distance"><strong>مسافت:</strong></label>
                                    <input type="text" id="distance" name="distance" class="form-control" value="<?= $Trip['distance'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="finalFare"><strong>کرایه نهایی:</strong></label>
                                    <input type="text" id="finalFare" name="finalFare" class="form-control" value="<?= $Trip['finalFare'] ?>">
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
                                <div class="col-lg-12">
                                    <label class="label">نوع سفر</label>
                                    <select name="trip_type" class="form-control" required>
                                        <option value="" <?= empty($Trip['trip_type']) ? 'selected' : '' ?>>انتخاب نوع سفر</option>
                                        <option value="one_way" <?= $Trip['trip_type'] == 'one_way' ? 'selected' : '' ?>>یک طرفه رفت</option>
                                        <option value="round_trip_with_stop" <?= $Trip['trip_type'] == 'round_trip_with_stop' ? 'selected' : '' ?>>رفت ، توقف ، برگشت</option>
                                        <option value="round_trip_with_service" <?= $Trip['trip_type'] == 'round_trip_with_service' ? 'selected' : '' ?>>رفت ، در اختیار ، برگشت</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <label class="label">راننده</label>
                                    <select data-placeholder="انتخاب راننده" id="driver" name="driverID" class="form-control" required>
                                    

                                        <?php foreach ($driver as $driver): ?>
                                            <option value="<?= $driver['did'] ?>" <?= $Trip['driverID'] == $driver['did'] ? 'selected' : '' ?>>
                                                <?= $driver['code'] . ' -  ' .$driver['name'] . ' ' . $driver['lname']  ?>
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



                            


                            <hr style="margin: 40px;" />





















                            <div class="row my-2">

                                <!-- Passenger ID -->
                                <div class="form-group col-md-3">
                                    <label class="label">کد اشتراک مسافر</label>
                                    <input type="text" name="passenger_id" class="form-control" placeholder="کد مسافر" value="<?= $Trip['passenger_id'] != 0 ? $Trip['passenger_id']  : '' ?>" required>
                                </div>

                                <div class="form-group col-md-3" style="margin: 30px 0;">
                                    <button type="button" id="checkID" class="btn btn-outline-danger fw-semibold py-2 px-4 mt-2 me-2 hover-white">
                                        بررسی
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    </button>

                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="label">مسافر کسی دیگر است ؟؟</label>
                                    <select name="isGuest" class="form-control" required>
                                        
                                        <option value="0" <?= $Trip['isGuest'] == '0' ? 'selected' : '' ?>>خیر</option>
                                        <option value="1" >بله</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row my-2">


                                <!-- Passenger Name -->
                                <div class="form-group mb-4 col-lg-6">
                                    <label class="label">نام مسافر</label>
                                    <input type="text" name="passenger_name" class="form-control" placeholder="نام مسافر" value="<?= $Trip['isGuest'] == '0' ? $Trip['passenger_name'] : $Trip['guest_name'] ?>" required>
                                </div>

                                <!-- Passenger Phone -->
                                <div class="form-group mb-4 col-lg-6">
                                    <label class="label">شماره تماس مسافر</label>
                                    <input type="text" id="passenger_tel" name="passenger_tel" class="form-control" value="<?= $Trip['isGuest'] == '0' ? $Trip['passenger_tel'] : $Trip['guest_tel'] ?>">
                                </div>
                            </div>

                            <!-- Is Guest -->


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
                                        <option value="Notifed" <?= $Trip['status'] == 'Notifed' ? 'selected' : '' ?>>اطلاع رسانی شده</option>
                                        <option value="Requested" <?= $Trip['status'] == 'Requested' ? 'selected' : '' ?>>درخواست شده</option>
                                        <option value="Confirm" <?= $Trip['status'] == 'Confirm' ? 'selected' : '' ?>>تایید شده</option>
                                        <option value="Cancled" <?= $Trip['status'] == 'Cancled' ? 'selected' : '' ?>>کنسل شده</option>
                                        <option value="Done" <?= $Trip['status'] == 'Done' ? 'selected' : '' ?>>به پایان رسیده</option>
                                    </select>
                                </div>                           


                                <div class="col-md-6">
                                    <label for="Packgae"><strong>بسته:</strong></label>
                                    <select class="form-control" id="packageSelect" name="package_edit">
                                        <?php foreach ($Packages as $item): ?>
                                            <option value="<?= htmlspecialchars($item['name']) ?>" <?= $Trip['Packgae'] == $item['name'] ? 'selected' : '' ?>><?= htmlspecialchars($item['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input name="id" value=" <?= $Trip['id']?>"  type="hidden" />
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









<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />

<script>  var base = "<?=base_url()?>";</script>
<script src="<?= base_url() ?>assets/js/custom/edit.js"></script>
<script>
    gregorianDate = "<?= $Trip['created_at'] ?>";
    jalaliDateTime = convertToJalali(gregorianDate);

    $(".card-footer").html('تاریخ ایجاد:' + jalaliDateTime);
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