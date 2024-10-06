<style>

    
#map {
        width: 100%;
        height: 800px;
        margin: 0 auto;
    }

    .mapboxgl-ctrl-geocoder {
        margin: 10px;
    }

    #reset-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    #reset-btn:hover {
        background-color: #ff1a1a;
    }
    
    .driver_holder {
        display: none;
    }

    .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        height: 40px;
    }

    .chosen-container.chosen-container-single {
        width: 100% !important;
    }



    a.chosen-single {
        padding: 10px !important;
        height: 40px !important;
        font-size: 15px;
    }

    li.active-result {
        font-size: 16px;
        padding: 10px !important;
    }

    b {
        margin-top: 10px;
        margin-right: 5px;
    }
    #invoice {
        padding: 0px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px;
        overflow: hidden !important;
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #0d6efd
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: right
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #0d6efd
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #0d6efd;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #0d6efd
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #0d6efd;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .invoice table tfoot tr:last-child td {
        color: #0d6efd;
        font-size: 1.4em;
        border-top: 1px solid #0d6efd
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }
</style>




<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">

</div>




<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">

        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">افزودن سرویس </h4>
        </div>


        <div class="tab-content" id="myTab2Content">
            <div class="tab-pane fade show active" id="preview2-tab-pane" role="tabpanel" aria-labelledby="preview2-tab" tabindex="0">

                <div class="tab-content" id="myTabstep2Content">
                    <div class="tab-pane fade show active" id="step1-tab-pane" role="tabpanel" aria-labelledby="step1-tab" tabindex="0">
                        <form action="<?= base_url() ?>OneStep" method="post" enctype="multipart/form-data">


                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card bg-white border-0 rounded-10 mb-4">
                                        <div class="card-body p-4">
                                            <h3 class="fs-18 mb-4 border-bottom pb-20 mb-20">ایجاد سرویس</h3>
                                            <form>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-4"> <label class="label">مسافر</label>
                                                            <div class="form-group position-relative"> <select class="chosen" id="passenger" style="width: 100%;" name="passenger" data-placeholder="انتخاب مسافر">

                                                                    <?php foreach ($Users as $B) : ?>
                                                                        <option value=""></option>
                                                                        <option data-name="<?= $B['name'] . ' ' . $B['lname'] ?>" value="<?= $B['id'] ?>"><?= $B['name'] . ' ' . $B['lname'] ?></option>
                                                                    <?php endforeach; ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-4"> <label class="label">راننده</label>
                                                            <div class="form-group position-relative"> <select class="chosen" id="driver" style="width: 100%;" name="driver" data-placeholder="راننده را انتخاب کنید">

                                                                    <?php foreach ($Drivers as $D) : ?>
                                                                        <option value=""></option>
                                                                        <option data-name="<?= $B['name'] . ' ' . $B['lname'] ?>" data-ax="<?= $D['ax'] ?>" value="<?= $D['did'] ?>"><?= $D['name'] . ' ' . $D['lname'] ?></option>
                                                                    <?php endforeach; ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-4"> <label class="label">خودرو</label>
                                                            <div class="form-group position-relative"> <select class="chosen" id="Cars" style="width: 100%;" name="car" data-placeholder="خودرو را انتخاب کنید">

                                                                    <option value=""></option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>






                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-4" bis_skin_checked="1"> <label class="label"> انتخاب مبدا و مقصد</label>
                                                            <div class="form-group position-relative" bis_skin_checked="1">
                                                                <div style="height: 550px;position: relative;" id="map"></div>
                                                                <button type="button" id="reset-btn">ریست</button> <!-- دکمه ریست -->




                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4"> <label class="label">تاریخ شروع پروژه</label>
                                                            <div class="form-group position-relative"> <input type="text" class="form-control text-gray-light h-58" placeholder="روز/ماه/سال" data-jdp=""> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4"> <label class="label">تاریخ پایان پروژه</label>
                                                            <div class="form-group position-relative"> <input type="text" class="form-control text-gray-light h-58" placeholder="روز/ماه/سال" data-jdp=""> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-4"> <label class="label">شرح پروژه</label>
                                                            <div class="form-group position-relative"> <textarea class="form-control ps-5 text-dark" placeholder="چند متن دمو ... " cols="30" rows="5"></textarea> <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4"> <label class="label">بودجه</label>
                                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark h-58 ps-5" placeholder="مقدار را وارد کنید"> <i class="ri-briefcase-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4"> <label class="label">زمان فاکتور</label>
                                                            <div class="form-group position-relative"> <select class="form-select form-control text-gray-light h-58 ps-5" aria-label="Default select example">
                                                                    <option selected="">30 روز</option>
                                                                    <option value="1">25 روز</option>
                                                                    <option value="2">20 روز</option>
                                                                    <option value="3">15 روز</option>
                                                                </select> <i class="ri-calendar-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-4 p-4 bg-border-gray-light d-sm-flex justify-content-between align-items-center rounded-10">
                                                            <div class="d-sm-flex align-items-center mb-3 mb-sm-0 me-lg-3">
                                                                <div class="me-md-5 pe-xxl-5 mb-3 mb-sm-0">
                                                                    <h4 class="body-font fs-15 fw-semibold text-body">آواتار پروژه</h4>
                                                                    <p>این روی آواتار پروژه شما نمایش داده می شود.</p>
                                                                </div> <img src="assets/images/product-11.jpg" class="rounded-4 wh-78 ms-3 ms-lg-0" alt="product">
                                                            </div>
                                                            <div class="d-flex ms-sm-3 ms-md-0"> <button class="btn bg-danger bg-opacity-10 text-danger fw-semibold">حذف</button> <button class="btn bg-primary bg-opacity-10 text-primary fw-semibold ms-3">بروزرسانی</button> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-4"> <label class="label">فایل های پیوست</label>
                                                            <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                                                <div class="product-upload"> <label for="file-upload" class="file-upload mb-0"> <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i> <span class="d-block fw-semibold text-body">فایل ها را آپلود کلیک کنید</span> </label> <input id="file-upload" type="file"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group"> <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white">ایجاد پروژه</button> </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

















                                <div class="col-lg-3">






























                                    <div class="card">
                                        <div class="card-body">
                                            <div id="invoice">

                                                <div class="invoice overflow-auto">
                                                    <div style="width: 99%;text-align: right;">
                                                        <header>
                                                            <div class="row">

                                                                <div class="col company-details">
                                                                    <h2 class="name" style="text-align: right;">
                                                                        خلاصه سرویس

                                                                    </h2>

                                                                </div>
                                                            </div>
                                                        </header>
                                                        <main>
                                                            <div class="row contacts" style="text-align: right;">
                                                                

                                                            </div>
                                                            <table >
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th colspan="2" class="text-left">عنوان</th>
                                                                        <th class="text-right">توضیحات</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="factor">
                                                                  

                                                                </tbody>
                                                                <tfoot>
                                                                   
                                                                </tfoot>
                                                            </table>

                                                            <div class="notices">
                                                                <div>NOTICE:</div>
                                                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after
                                                                    30 days.</div>
                                                            </div>
                                                        </main>
                                                        <!-- <footer>Invoice was created on a computer and is valid without the signature and seal.
                                                        </footer> -->
                                                    </div>

                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>













                                    <div class="card bg-white border-0 rounded-10 mb-4">
                                        <div class="card-body p-4">
                                            <h3 class="fs-18 mb-4 border-bottom pb-20 mb-20">خلاصه سرویس</h3>
                                            <div class="form-group"> <label class="label">مسافر</label>
                                                <div class="form-group position-relative">

                                                    <div style="padding-top: 17px;" class="form-control text-gray-light h-58 ps-5 main_passenger"> </div>
                                                    <i class="ri-user position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                </div>
                                            </div>


                                            <br />

                                            <div class="form-group driver_holder"> <label class="label">راننده</label>
                                                <div class="form-group position-relative" style="text-align: center;">

                                                    <img src="" class="driver_photo wh-110 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="جردن استیونسون">

                                                    <div style="padding-top: 17px;text-align: right;" class=" form-control text-gray-light h-58 ps-5 main_driver"> </div>
                                                    <i class="ri-user position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>







                                </div>
                            </div>






























                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    var base = "<?=base_url()?>";
</script>
<script src="<?= base_url() ?>assets/js/custom/my.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />


<style>

td{
    width: 100px !important; /* عرض ثابت برای سلول‌ها */
    word-wrap: break-word !important; /* شکستن کلمات طولانی */
    overflow-wrap: break-word !important; /* شکستن کلمات طولانی */
    border: 1px solid #000; /* برای مشاهده مرز سلول‌ها */
    padding: 5px; /* برای کمی فاصله درون سلول‌ها */

}


</style>




<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js"></script>




