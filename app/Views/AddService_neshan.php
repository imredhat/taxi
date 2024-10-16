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


<?php

$array['options'] = $options;
function findRateByKey($array, $key)
{


    // Loop through the main options array
    foreach ($array['options'] as $option) {
        // Handle level 1 elements like 'pp_km' and 'isHoliday'
        if (in_array($option['option'], ['pp_km', 'isHoliday'])) {
            if ($option['option'] === $key) {
                return $option['rate']; // Return the value directly from the 'rate' field
            }
        }

        // Handle level 2 elements where 'rate' is a JSON string
        if (isset($option['rate'])) {
            // Try to decode the 'rate' if it's a JSON string
            $rates = json_decode($option['rate'], true);

            // If decoding is successful and it is an array
            if (is_array($rates) && array_key_exists($key, $rates)) {
                return $rates[$key];
                // Return the value of the matching key
            }
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
    let baseRate = <?= findRateByKey($array, "pp_km"); ?>; // قیمت پایه هر کیلومتر
</script>





<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="row">
        <div class="col-lg-9 map_holder">
            <div style="height: 500px;position: relative;" id="map"></div>

        </div>


        <div class="col-lg-3 factor_holder">
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



    <footer class="footer-area bg-white text-center rounded-top-10">


        <div class="btsearch" role="search">
            <input style="width: 500px;" class="form-control me-2" type="search" id="searchInput" placeholder="جستجو..." aria-label="Search">
            <ul id="searchResults" class="list-group dropdown-menu show"></ul>

        </div>


        <div style="position: absolute; bottom:0" class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid"> <a class="navbar-brand" href="#">تنظیمات قیمت</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: auto;">



                            <?php foreach ($options as $O): if (is_object(json_decode($O['rate']))): ?>
                                    <?php
                                    $OI = json_decode($O['rate']);
                                    $VA = json_decode($O['values']);

                                    ?>

                                    <li class="nav-item dropdown">
                                        <?= ${$O['option']}; ?>
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?= $O['name'] ?> </a>
                                        <ul class="dropdown-menu">


                                            <?php $i = 0;
                                            foreach ($OI as $OIO => $VAL): ?>
                                                <li><a data-<?= $O['option'] ?>="<?= $VAL ?>" class="dropdown-item"><?= $VA[$i] ?></a></li>
                                            <?php $i++;
                                            endforeach; ?>

                                        </ul>
                                    </li>


                            <?php endif;
                            endforeach; ?>





                        </ul>



                        <div style="float: left;position: fixed;left:0">
                            <button type="button" id="reset" class="btn btn-danger bg-danger bg-opacity-10 text-danger border-0 fw-semibold py-2 px-4">ریست</button>
                            <button type="button" id="calculate-btn" class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">محاسبه کرایه</button>
                            <button style="display: none;" type="button" id="submit" class="btn btn-outline-success fw-semibold py-2 px-4 hover-white ">ثبت سفارش</button>
                        </div>


                    </div>
                </div>
            </nav>
        </div>
    </footer>



    <style>
        li.nav-item.dropdown {
            margin: 0 10px;
        }

        footer svg {
            float: right;
            margin: 10px;
        }

        #map * {
            z-index: 0;
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var base = "<?= base_url() ?>";
</script>
<script src="<?= base_url() ?>assets/js/custom/my_neshan.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />






<link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-polyline/1.2.1/polyline.min.js"></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>




<!-- بارگذاری SDK نقشه نشان -->

<script>
    var Dropdowns = function() {

        $('.dropdown-item').on('click', function() {
            var selectedText = $(this).text();
            $('.nav-link.show').text(selectedText);
        });





        var t = $(".dropup, .dropright, .dropdown, .dropleft"),
            e = $(".dropdown-menu"),
            r = $(".dropdown-menu .dropdown-menu");
        $(".dropdown-menu .dropdown-toggle").on("click", function() {
                var a;
                return (a = $(this)).closest(t).siblings(t).find(e).removeClass("show"),
                    a.next(r).toggleClass("show"),
                    !1
            }),
            t.on("hide.bs.dropdown", function() {
                var a, t;
                a = $(this),
                    (t = a.find(r)).length && t.removeClass("show")
            })
    }()
</script>






<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>

<script>
    jalaliDatepicker.startWatch();
</script>