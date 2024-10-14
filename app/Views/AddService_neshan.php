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

// echo "<pre>";
// print_r($array);
// die();

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


?>

<script>

let baseRate = <?=findRateByKey($array , "pp_km");?>; // قیمت پایه هر کیلومتر

</script>

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">

</div>




<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">

        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">بررسی قیمت </h4>
        </div>




        <div class="col-lg-12">
            <div class="form-group mb-4" bis_skin_checked="1"> <label class="label"> انتخاب مبدا و مقصد</label>
                <div class="form-group position-relative" bis_skin_checked="1">
                <div class="controls">

                <?php foreach($options as $O):if(is_object(json_decode($O['rate']))):?>
                    <?php 
                    $OI = json_decode($O['rate']);
                    $VA = json_decode($O['values']);
                    
                    ?>

                    <label><?=$O['name']?> :

                            <select id="<?=$O['option']?>">
                                
                                <?php $i = 0; foreach ($OI as $OIO => $VAL): ?>
                                    <option value="<?=$VAL ?>"><?=$VA[$i]?></option>
                                <?php $i++; endforeach;?>

                            </select>
                        </label>


        


                    <?php
                endif;endforeach;
?>
                    




                        <br>
                        <button type="button" id="reset">ریست</button>
                        <button type="button" id="calculate-btn">محاسبه کرایه</button>

                        <div class="fare"></div>
                        <div class="total"></div>
                    </div>






                    <div style="height: 600px;position: relative;" id="map"></div>



                  

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
<script src="<?= base_url() ?>assets/js/custom/my_neshan.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />


<style>



</style>




<link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-polyline/1.2.1/polyline.min.js"></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>




<!-- بارگذاری SDK نقشه نشان -->








<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>

<script>
    jalaliDatepicker.startWatch();
</script>

