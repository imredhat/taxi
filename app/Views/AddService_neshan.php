<style>
    #factor_holder {
        display: none;
    }

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

    .fareHolder {
        width: auto;
        height: 50px;
        z-index: 9;
        bottom: 40%;
        position: fixed;
        background: white;
        padding: 10px;
        left: 0;
        box-shadow: 1px 1px 60px;
        display: none;
        font-size: x-large;
    }
</style>


<?php


$array['options'] = $options;
function findRateByKey($array, $key)
{


    // Loop through the main options array
    foreach ($array['options'] as $option) {

        if ($option['option'] === $key) {
            return $option['rate']; // Return the value directly from the 'rate' field
        }
    }


    // If the key was not found
    return "Key not found.";
}

$carType = '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15"><path d="M24,13a3,3,0,0,0-3-3h-.478L15.84,3.285A3,3,0,0,0,13.379,2h-7A3.016,3.016,0,0,0,3.575,3.937l-2.6,6.848A2.994,2.994,0,0,0,0,13v5H2v.5a3.5,3.5,0,0,0,7,0V18h6v.5a3.5,3.5,0,0,0,7,0V18h2ZM14.2,4.428,18.084,10H11V4h2.379A1,1,0,0,1,14.2,4.428Zm-8.753.217A1,1,0,0,1,6.381,4H9v6H3.416ZM7,18.5a1.5,1.5,0,0,1-3,0V18H7Zm13,0a1.5,1.5,0,0,1-3,0V18h3ZM22,16H2V13a1,1,0,0,1,1-1H21a1,1,0,0,1,1,1Z"/></svg>';
$weather = '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15"><path d="M23,11H18.92a6.924,6.924,0,0,0-.429-1.607l3.527-2.044a1,1,0,1,0-1-1.731l-3.53,2.047a7.062,7.062,0,0,0-1.149-1.15l2.046-3.531a1,1,0,0,0-1.731-1L14.607,5.509A6.9,6.9,0,0,0,13,5.08V1a1,1,0,0,0-2,0V5.08a6.9,6.9,0,0,0-1.607.429L7.349,1.982a1,1,0,0,0-1.731,1L7.664,6.515a7.062,7.062,0,0,0-1.149,1.15L2.985,5.618a1,1,0,1,0-1,1.731L5.509,9.393A6.924,6.924,0,0,0,5.08,11H1a1,1,0,0,0,0,2H5.08a6.924,6.924,0,0,0,.429,1.607L1.982,16.651a1,1,0,1,0,1,1.731l3.53-2.047a7.062,7.062,0,0,0,1.149,1.15L5.618,21.016a1,1,0,0,0,1.731,1l2.044-3.527A6.947,6.947,0,0,0,11,18.92V23a1,1,0,0,0,2,0V18.92a6.947,6.947,0,0,0,1.607-.429l2.044,3.527a1,1,0,0,0,1.731-1l-2.046-3.531a7.062,7.062,0,0,0,1.149-1.15l3.53,2.047a1,1,0,1,0,1-1.731l-3.527-2.044A6.924,6.924,0,0,0,18.92,13H23A1,1,0,0,0,23,11ZM12,17c-6.608-.21-6.606-9.791,0-10C18.608,7.21,18.606,16.791,12,17Z"/></svg>';
$roadCondition  = '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15"><path d="M21.46,4.134A4.992,4.992,0,0,0,16.536,0H7.451A4.992,4.992,0,0,0,2.525,4.138l-2.449,14A5,5,0,0,0,5,24H19a5,5,0,0,0,4.925-5.866ZM21.3,20.929A3,3,0,0,1,19,22H5a3,3,0,0,1-2.955-3.518l2.449-14A3,3,0,0,1,7.451,2h9.085A3,3,0,0,1,19.49,4.48l2.463,14A3,3,0,0,1,21.3,20.929ZM13,5V7a1,1,0,0,1-2,0V5a1,1,0,0,1,2,0Zm0,6v2a1,1,0,0,1-2,0V11a1,1,0,0,1,2,0Zm0,6v2a1,1,0,0,1-2,0V17a1,1,0,0,1,2,0Z"/></svg>';
?>

<script>
    const packages = JSON.parse('<?= json_encode($Packages) ?>');
    let = holiDayRate = <?= findRateByKey($array, "isHoliday"); ?>;
    let = extraPassenger = <?= findRateByKey($array, "extraPassenger"); ?>;
    let = badRoad = <?= findRateByKey($array, "bad_road"); ?>;
</script>





<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="row">
        <div class="col-lg-12" id="map_holder">
            <div style="height: 500px;position: relative;" id="map"></div>

        </div>


        <div class="col-lg-3" id="factor_holder">
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
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="fareHolder"></div>

    <footer class="footer-area bg-white text-center rounded-top-10">


        <div class="btsearch" role="search">
            <input style="width: 500px;" class="form-control me-2" type="search" id="searchInput" placeholder="جستجو..." aria-label="Search">
            <ul id="searchResults" class="list-group dropdown-menu show"></ul>

        </div>


        <div style="position: absolute; bottom:0" class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid"> <a class="navbar-brand" href="#">انتخاب ماشین</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: auto;">



                            <?php foreach ($Packages as $Type): ?>

                                <li class="nav-item dropdown package" data-name="<?= $Type['name']; ?>">
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $Type['name']; ?>">
                                        <img src="<?= base_url() ?>assets/images/<?= $Type['tag']; ?>.jpg" width="40" />
                                    </a>
                                </li>

                            <?php endforeach; ?>





                        </ul>



                        <div style="float: left;position: fixed;left:0;margin-left: 10px;">
                            <button type="button" id="reset" class="btn btn-danger bg-danger bg-opacity-10 text-danger border-0 fw-semibold py-2 px-4">ریست</button>
                            <button style="display: none;" type="button" id="submit" class="btn btn-outline-success fw-semibold py-2 px-4 hover-white ">نمایش فاکتور</button>
                            <button style="float: left;margin:0 10px ;display: none;" class="btn btn-outline-success fw-semibold py-2 px-4 hover-white" data-bs-toggle="offcanvas" id="sabt_estelam" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" type="button"> </span> <span role="status">ثبت استعلام</span> <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span></button>
                        </div>


                    </div>
                </div>
            </nav>
        </div>
    </footer>




    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" aria-modal="true">
        <div class="offcanvas-header border-bottom p-4">
            <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">ثبت استعلام</h5> <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">



            <form class="col-lg-12">
                <div class="row">


                    <div class="form-group mb-4 col-lg-12">
                        <h3>کرایه سرویس <span class="badge bg-success base_fare">0</span></h3>

                    </div>


                    <!-- Passenger ID -->
                    <div class="form-group mb-4 col-lg-9">
                        <label class="label">کد اشتراک مسافر</label>
                        <input type="text" name="passenger_id" class="form-control" placeholder="کد مسافر" required>
                    </div>

                    <div class="form-group mb-4  col-lg-3" style="margin: 30px 0;">
                        <button type="button" id="checkID" class="btn btn-outline-danger fw-semibold py-2 px-4 mt-2 me-2 hover-white">
                            بررسی
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        </button>

                    </div>




                    <hr />

                    <!-- Passenger Name -->
                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">نام مسافر</label>
                        <input type="text" name="passenger_name" class="form-control" placeholder="نام مسافر" required>
                    </div>

                    <!-- Passenger Phone -->
                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">شماره تماس مسافر</label>
                        <input type="tel" name="passenger_tel" class="form-control" placeholder="شماره تماس مسافر" required>
                    </div>

                    <!-- Is Guest -->
                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">مسافر کسی دیگر است ؟؟</label>
                        <select name="isGuest" class="form-control" required>
                            <option value="0">خیر</option>
                            <option value="1">بله</option>
                        </select>
                    </div>



                    <div class="col-lg-6"> <label class="label d-block">تعداد مسافر</label>
                        <div class="product-quantity">
                            <div class="add-to-cart-counter gap-3 justify-content-between">
                                <button type="button" class="minusBtn bg-success text-white"></button>
                                <input name="total_passenger" type="text" size="25" value="1" class="count border-success">
                                <button type="button" class="plusBtn bg-success text-white"></button>
                            </div>
                        </div>
                    </div>




                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">توقف دارد ؟</label>
                        <select name="isWait" class="form-control" required>
                            <option value="0">خیر</option>
                            <option value="1">بله</option>

                        </select>
                    </div>


                    


                   


                    <div class="col-lg-6"> <label class="label d-block">تعداد ساعت تاخیر</label>
                        <div class="product-quantity">
                            <div class="add-to-cart-counter gap-3 justify-content-between">
                                <button disabled type="button" class="minusBtn bg-success text-white"></button>
                                <input disabled name="wait_hours" type="text" size="25" value="0" class="count border-success">
                                <button disabled type="button" class="plusBtn bg-success text-white"></button>
                            </div>
                        </div>
                    </div>


                    <hr />


                     <!-- Trip Type -->
                     <div class="form-group mb-4 col-lg-12">
                        <label class="label">نوع سفر</label>
                        <select name="trip_type" class="form-control" required>
                            <option value="one_way">یک طرفه رفت</option>
                            <option value="round_trip_with_stop">رفت ، توقف ، برگشت</option>
                            <option value="round_trip_with_service">رفت ، در اختیار ، برگشت</option>
                        </select>
                    </div>





                    <!-- Company Name -->
                    <div class="form-group mb-4 col-lg-12">
                        <label class="label">نام شرکت در صورت نیاز به فاکتور</label>
                        <input type="text" name="company_name" class="form-control" placeholder="نام شرکت">
                    </div>

                    <!-- Trip Date -->
                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">تاریخ سفر</label>
                        <div class="form-group position-relative"> <input name="trip_date" type="text" class="form-control text-dark ps-5 h-58" placeholder="روز/ماه/سال" data-jdp=""> <i class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i> </div>
                    </div>

                    <!-- Trip Time -->
                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">زمان سفر</label>
                        <div class="form-group position-relative"> <input type="text" name="trip_time" class="form-control text-dark ps-5 h-58" placeholder="--:-- --" data-jdp="" data-jdp-only-time=""> <i class="ri-time-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i> </div>
                    </div>

                    <div class="form-group mb-4 col-lg-12">
                        <label class="label">توضیحات آدرس شروع</label>
                        <textarea name="start_address_desc" class="form-control" placeholder="توضیحات آدرس شروع" required></textarea>
                    </div>

                    <div class="form-group mb-4 col-lg-12">
                        <label class="label">توضیحات آدرس پایان</label>
                        <textarea name="end_address_desc" class="form-control" placeholder="توضیحات آدرس پایان" required></textarea>
                    </div>



                    <div class="form-group mb-4 col-lg-6">
                        <label class="label">جاده بد یا خاکی دارد ؟ </label>
                        <select name="badRoad" class="form-control" required>
                            <option value="0">خیر</option>
                            <option value="1">بله</option>

                        </select>
                    </div>



                    <div class="col-lg-6"> <label class="label d-block">چند کیلومتر</label>
                        <div class="product-quantity">
                            <div class="add-to-cart-counter gap-3 justify-content-between">
                                <button disabled type="button" class="minusBtn bg-success text-white"></button>
                                <input disabled name="badRoad_km" type="text" size="25" value="0" class="count border-success">
                                <button disabled type="button" class="plusBtn bg-success text-white"></button>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-4 col-lg-12">
                        <label class="label">توضیحات بار</label>
                        <textarea name="luggage" class="form-control" placeholder="توضیحات در مورد بار یا چمدان همراه" required></textarea>
                    </div>


                    <div class="form-group mb-4 col-lg-12">
                        <label class="label">وضعیت آب و هوا</label>
                        <div class="form-group mb-4 col-lg-12 weather">

                            <a class="changeWeather" data-rate="1" data-name="sunny" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="آفتابی">
                                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                    <path d="M23,11H18.92a6.924,6.924,0,0,0-.429-1.607l3.527-2.044a1,1,0,1,0-1-1.731l-3.53,2.047a7.062,7.062,0,0,0-1.149-1.15l2.046-3.531a1,1,0,0,0-1.731-1L14.607,5.509A6.9,6.9,0,0,0,13,5.08V1a1,1,0,0,0-2,0V5.08a6.9,6.9,0,0,0-1.607.429L7.349,1.982a1,1,0,0,0-1.731,1L7.664,6.515a7.062,7.062,0,0,0-1.149,1.15L2.985,5.618a1,1,0,1,0-1,1.731L5.509,9.393A6.924,6.924,0,0,0,5.08,11H1a1,1,0,0,0,0,2H5.08a6.924,6.924,0,0,0,.429,1.607L1.982,16.651a1,1,0,1,0,1,1.731l3.53-2.047a7.062,7.062,0,0,0,1.149,1.15L5.618,21.016a1,1,0,0,0,1.731,1l2.044-3.527A6.947,6.947,0,0,0,11,18.92V23a1,1,0,0,0,2,0V18.92a6.947,6.947,0,0,0,1.607-.429l2.044,3.527a1,1,0,0,0,1.731-1l-2.046-3.531a7.062,7.062,0,0,0,1.149-1.15l3.53,2.047a1,1,0,1,0,1-1.731l-3.527-2.044A6.924,6.924,0,0,0,18.92,13H23A1,1,0,0,0,23,11ZM12,17c-6.608-.21-6.606-9.791,0-10C18.608,7.21,18.606,16.791,12,17Z" />
                                </svg>
                            </a>

                            <a data-bs-toggle="tooltip" data-rate="1.05" data-name="rainy"="" data-bs-placement="top" data-bs-title="بارانی">
                                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                    <path d="M14,24a1,1,0,0,1-1-1V18a1,1,0,0,1,2,0v5A1,1,0,0,1,14,24ZM6,24a1,1,0,0,1-1-1V18a1,1,0,0,1,2,0v5A1,1,0,0,1,6,24Zm12-2a1,1,0,0,1-1-1V16a1,1,0,0,1,2,0v5A1,1,0,0,1,18,22Zm-8,0a1,1,0,0,1-1-1V16a1,1,0,0,1,2,0v5A1,1,0,0,1,10,22ZM2,18.328a1,1,0,0,1-.777-.371A5.532,5.532,0,0,1,1.8,10.43a1,1,0,0,0,.345-.9,8.147,8.147,0,0,1-.033-2.889A7.945,7.945,0,0,1,8.5.138a8.052,8.052,0,0,1,8.734,4.438,1.039,1.039,0,0,0,.743.57A7.55,7.55,0,0,1,22.846,16.5a1,1,0,0,1-1.692-1.068,5.537,5.537,0,0,0-3.571-8.325,3.009,3.009,0,0,1-2.158-1.672A6,6,0,0,0,4.086,6.967a6.136,6.136,0,0,0,.024,2.18,3,3,0,0,1-.964,2.763A3.518,3.518,0,0,0,2.777,16.7,1,1,0,0,1,2,18.328Z" />
                                </svg>
                            </a>

                            <a data-bs-toggle="tooltip" data-rate="1.1" data-name="snowy" data-bs-placement="top" data-bs-title="برفی">
                                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                    <path d="M17.914,5.132a1.033,1.033,0,0,1-.683-.555C13.1-3.756.516.231,2.146,9.528a1,1,0,0,1-.345.9A5.54,5.54,0,0,0,2.214,18.9a.988.988,0,0,0,1.524-.486,5.5,5.5,0,0,1,10.554.08A2.063,2.063,0,0,0,16.5,20C25.123,20.017,27.132,7.12,17.914,5.132ZM17,11H15.726l.633,1.105a1,1,0,1,1-1.734.995L14,12.01l-.625,1.09a1,1,0,1,1-1.734-.995L12.274,11H11a1,1,0,0,1,0-2h1.274L11.641,7.9A1,1,0,1,1,13.375,6.9L14,7.99l.625-1.09a1,1,0,1,1,1.734.995L15.726,9H17A1,1,0,0,1,17,11Zm-4,9a1,1,0,0,1-1,1H10.726l.633,1.105a1,1,0,1,1-1.734,1L9,22.01,8.375,23.1a1,1,0,1,1-1.734-1L7.274,21H6a1,1,0,0,1,0-2H7.274L6.641,17.9a1,1,0,1,1,1.734-1L9,17.99l.625-1.09a1,1,0,1,1,1.734,1L10.726,19H12A1,1,0,0,1,13,20Z" />
                                </svg>
                            </a>






                        </div>
                    </div>


                </div>

                <div class="form-group d-flex gap-3">
                    <button id="insertReq" class="btn btn-primary text-white fw-semibold py-2 px-4" type="submit">ثبت سفر</button>
                </div>
            </form>

        </div>
    </div>



    <style>
        li.nav-item.dropdown.package {
            border-radius: 50px;
            overflow: hidden;
            cursor: pointer;
        }

        .package_selected {
            border-radius: 50px;
            border: 1px solid;
            box-shadow: 1px 1px 10px #ccc;
        }

        .weather svg {
            width: 60px;
            height: 60px;
            text-align: center;
            float: none;
            color: #3b3b3b;
            border-radius: 80px;
            padding: 10px;
        }

        .svg_select {
            border: 3px solid rgba(var(--bs-success-rgb), var(--bs-bg-opacity)) !important;
            color: rgba(var(--bs-success-rgb), var(--bs-bg-opacity)) !important;
        }

        .weather a {
            text-decoration: auto;
            cursor: pointer;
        }

        .rtl .offcanvas.show {
            transform: translateX(0);
            box-shadow: 40px 0 38px #ccc;
        }

        jdp-container {
            z-index: 99999 !important;
        }


        li.nav-item.dropdown {
            margin: 0 10px;
        }

        footer svg {
            float: right;
            margin: 10px;
        }

        #map * {
            z-index: 0 !important;
        }

        .fare,
        .total {
            padding: 30px;
        }


        #searchResults {
            position: absolute;
            bottom: 0;
            margin-bottom: 70px;
            background: #ffffff;
            height: 150px;
            overflow: auto;
            display: none;
            width: 500px;
        }

        .list-group-item,
        .dropdown-item {
            cursor: pointer;
        }

        .bg-body-tertiary {
            --bs-bg-opacity: 1;
            background-color: white !important;
            width: 100% !important;
        }

        footer.footer-area.bg-white.text-center.rounded-top-10 {
            position: fixed;
            bottom: 0;
            background: blue;
            width: 96%;
            height: 60px;
        }

        .dropdown-menu[data-bs-popper] {
            bottom: 100%;
            top: auto !important;
        }

        .btsearch {
            position: relative;
            z-index: 2;
            margin: auto !important;
            width: 580px;
            bottom: -5px;
        }

        .dropdown-item:hover {
            color: var(--bs-dropdown-link-active-color);
            text-decoration: none;
            background-color: var(--bs-dropdown-link-active-bg);
        }
    </style>


</div>
</div>

</div>




<div class="toast-container position-fixed bottom-0 end-0 p-3" style="bottom: 55px !important;">
    <div id="liveToast" class="toast bg-success text-white fade hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body"></div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    var base = "<?= base_url() ?>";
</script>
<script src="<?= base_url() ?>assets/js/custom/my_neshan.js"></script>
<script src="<?= base_url() ?>assets/js/custom/custom.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />



<link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-polyline/1.2.1/polyline.min.js"></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>


<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>

<script>
    jalaliDatepicker.startWatch();
    
</script>