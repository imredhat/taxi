<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <h4 class="fs-18 mb-4">جستجوی سرویس ها</h4>

                <div class="tab-content" id="myTab3Content">
                    <div class="tab-pane fade active show" id="preview4-tab-pane" role="tabpanel" aria-labelledby="preview4-tab" tabindex="0">
                        <form class="src-form" action="<?= base_url() ?>Search/Trips/Result" method="GET">



                            <div class="form-group mb-4 position-relative">
                                <label for="user_select" class="form-label">انتخاب مشتری</label>
                                <select name="user" class="form-control bg-body-bg border-0 text-dark rounded-pill chosen">
                                    <option disabled selected value="">انتخاب مشتری...</option>
                                    <?php foreach ($User as $U): ?>
                                        <option value="<?= $U['id']; ?>"><?= 1000 + $U['id'] . ' - ' . $U['name'] . ' ' . $U['lname']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="form-group mb-4 position-relative">

                                <label for="driver_select" class="form-label">انتخاب راننده</label>
                                <select name="driver" class="form-control bg-body-bg border-0 text-dark rounded-pill chosen">
                                    <option disabled selected value="">انتخاب راننده...</option>
                                    <?php foreach ($Drivers as $Driver): ?>
                                        <option value="<?= $Driver['did']; ?>"><?= 1000 + $Driver['did'] . ' - ' . $Driver['name'] . ' ' . $Driver['lname']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <label for="origin_input" class="form-label">قسمتی از مبدا یا مقصد خاص</label>

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input name="loc_start" type="text" class="form-control bg-body-bg border-0 text-dark rounded-pill" placeholder="قسمتی از مبدا ...">
                                </div>

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input name="loc_end" type="text" class="form-control bg-body-bg border-0 text-dark rounded-pill" placeholder="قسمتی از مقصد ...">
                                </div>
                            </div>

                            <div class="row">
                                <label for="contact_start_date" class="form-label">بر اساس تاریخ تماس </label>

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input type="text" id="contact_start_date" name="contact_start_date" class="form-control bg-body-bg border-0 text-dark rounded-pill date" placeholder="تاریخ تماس از ...">
                                </div>
                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input type="text" id="contact_end_date" name="contact_end_date" class="form-control bg-body-bg border-0 text-dark rounded-pill date" placeholder="تاریخ تماس تا ...">
                                </div>
                            </div>

                            <div class="row">
                                <label for="contact_start_date" class="form-label">بر اساس تاریخ سفر </label>

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input type="text" id="trip_start_date" name="trip_start_date" class="form-control bg-body-bg border-0 text-dark rounded-pill date" placeholder="تاریخ سفر از ...">
                                </div>
                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input type="text" id="trip_end_date" name="trip_end_date" class="form-control bg-body-bg border-0 text-dark rounded-pill date" placeholder="تاریخ سفر تا ...">
                                </div>
                            </div>


                            <div class="row">
                                <label for="contact_start_date" class="form-label">بر اساس اطلاعات مسافر </label>

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input type="text" id="guest_name" name="guest_name" class="form-control bg-body-bg border-0 text-dark rounded-pill " placeholder="نام مسافر ...">
                                </div>
                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <input type="text" id="guest_tel" name="guest_tel" class="form-control bg-body-bg border-0 text-dark rounded-pill " placeholder="شماره مسافر ...">
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <label for="trip_status" class="form-label">وضعیت سفر</label>
                                    <select name="status" class="form-control bg-body-bg border-0 text-dark rounded-pill ">
                                        <option disabled selected value="">انتخاب وضعیت سفر...</option>

                                        <option value="Called">استعلام</option>
                                        <option value="Reserved">رزرو</option>
                                        <option value="Notifed">اعلام به راننده</option>
                                        <option value="Requested">اعلام آمادگی راننده</option>
                                        <option value="Confirm">پذیرش توسط راننده</option>
                                        <option value="Service">سرویس درحال انجام</option>
                                        <option value="Cancled">کنسل شده</option>
                                        <option value="Done">به پایان رسیده</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 form-group mb-4 position-relative">
                                    <label for="payment_status" class="form-label">وضعیت پرداخت</label>
                                    <select name="payment_status" class="form-control bg-body-bg border-0 text-dark rounded-pill">
                                        <option disabled selected value="">انتخاب وضعیت پرداخت...</option>
                                        <option value="notPaid">اصلا پرداخت نشده</option>
                                        <option value="halfPaid">نیمه تسویه شده</option>
                                        <option value="Paid">تسویه شده</option>
                                    </select>
                                </div>
                            </div>



                            <button type="submit" class="bg-primary p-0 border-0 text-center text-white rounded-pill px-3 py-2 me-2 fw-semibold"> جستجو </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>

<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />
<link rel="stylesheet" href="https://behzadi.github.io/persianDatepicker/css/persianDatepicker-default.css" />
<script src="https://behzadi.github.io/persianDatepicker/js/persianDatepicker.js"></script>
<script>
    $(".date").persianDatepicker({
        formatDate: "YYYY/0M/0D"
    });
</script>
<script>
    $(".chosen").chosen();
</script>


<style>
    .chosen-container.chosen-container-single {
        width: 100% !important;
    }



    a.chosen-single {
        padding: 15px !important;
        height: 50px !important;
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