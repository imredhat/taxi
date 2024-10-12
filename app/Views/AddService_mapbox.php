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
                                <div class="col-lg-7">
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
                                                        <div class="form-group mb-4"> <label class="label">تاریخ تماس</label>
                                                            <div class="form-group position-relative"> <input name="call_date" type="text" class="form-control text-gray-light h-58" placeholder="روز/ماه/سال" data-jdp=""> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4"> <label class="label">تاریخ سفر</label>
                                                            <div class="form-group position-relative"> <input name="trip_date" type="text" class="form-control text-gray-light h-58" placeholder="روز/ماه/سال" data-jdp=""> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-4"> <label class="label">سایر توضیحات</label>
                                                            <div class="form-group position-relative"> <textarea name="desc" class="form-control ps-5 text-dark" placeholder="توضیحات ... " cols="30" rows="5"></textarea> <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i> </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <input name="isFactor" value="Yes" type="checkbox" class="btn btn-toggle">فاکتور
                                                        <input name="isPaid" value="Yes" type="checkbox" class="btn btn-toggle">پرداخت شده
                                                        <input name="isTax" value="Yes" type="checkbox" class="btn btn-toggle">مالیات

                                                    </div>


                                                    <div class="col-sm-12">


                                                        <br />
                                                    </div>




                                                    <div class="col-lg-12">
                                                        <div class="form-group"> <button id="addService" type="button" class="btn btn-primary py-3 px-5 fw-semibold text-white">                                                 
                                                        
                                                        ایجاد سرویس
                                                        <div style="zoom: 0.5; display:none" class="spinner-border text-light" role="status"> </div>
                                                    
                                                    
                                                    </button> </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>






                                <div class="col-lg-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="invoice">

                                                <div class="invoice overflow-auto">
                                                    <div style="width: 99%;text-align: right;">
                                                        <header>
                                                            <div class="row">

                                                                <div class="col company-details">
                                                                    <h3 class="name" style="text-align: right;">
                                                                        خلاصه سرویس

                                                                    </h3>

                                                                </div>
                                                            </div>
                                                        </header>
                                                        <main>
                                                            <div class="row contacts" style="text-align: right;">


                                                            </div>
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th colspan="2" class="text-left">عنوان</th>
                                                                        <th class="text-right">توضیحات</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="factor">


                                                                </tbody>

                                                            </table>


                                                            <table>

                                                                <tfoot>

                                                                </tfoot>
                                                            </table>

                                                            <div class="notices">
                                                                <div>نکته مهم:</div>
                                                                <div class="notice"> در انتخاب مبدا و مقصد دقت کنید</div>
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
    var base = "<?= base_url() ?>";
</script>
<script src="<?= base_url() ?>assets/js/custom/my_mapbox.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />


<style>



</style>



<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>







<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>

<script>
    jalaliDatepicker.startWatch();
</script>

<style>
    input.btn.btn-toggle {
        margin: 4px 0 0;
        line-height: normal;
        width: 40px;
        height: 30px;
    }

    ّ
</style>