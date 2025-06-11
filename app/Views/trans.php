<?php
unset($css_files['b36caa4af5f8b40ecf114db81b79f9e5d11be22f']);
foreach ($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>


<form action="<?=base_url()?>Transaction" method="get">
<div class="container">
    <div class="row">

            <label for="contact_start_date" class="form-label">فیلتر بر اساس تاریخ </label>

            <div class="col-sm-5 form-group mb-4 position-relative">
                <input type="text" id="contact_start_date" name="from_date" class="form-control bg-body-bg text-dark rounded-pill date pdp-el" placeholder="تاریخ تماس از ..." value="<?php if(isset($_GET['from_date'])) { echo $_GET['from_date']; } ?>">
            </div>
            <div class="col-sm-5 form-group mb-4 position-relative">
                <input type="text" id="contact_end_date" name="to_date" class="form-control bg-body-bg  text-dark rounded-pill date pdp-el" placeholder="تاریخ تماس تا ..." value="<?php if(isset($_GET['from_date'])) { echo $_GET['to_date']; } ?>">
            </div>

            <div class="col-sm-2 form-group mb-4 position-relative">
                <button type="submit" class="form-control bg-body-bg  text-dark rounded-pill pdp-el"> اعمال</button>
            </div>
    </div>
</div>
</form>








<?php echo $output; ?>

<?php foreach ($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


<link rel="stylesheet" href="https://behzadi.github.io/persianDatepicker/css/persianDatepicker-default.css" />
<script src="https://behzadi.github.io/persianDatepicker/js/persianDatepicker.js"></script>
<script>
    // $('input[name="date_start"]').persianDatepicker();
    $('.date').persianDatepicker({
        formatDate: "YYYY/0M/0D"
    });
</script>

<style>
    div#options-content,
    #message-box,
    .alert,
    .span12 {
        width: 70%;
        margin: auto;
        float: none;
    }

    table {
        border-radius: 10px !important;
    }


    .container-full {
        margin: 0;
        margin-left: 0;
        width: 100%;
        min-height: 100%;
        position: unset;
        top: sdf;
        left: 0 !important;
        background: #f5f7fa;
        padding-top: none;
        z-index: 9999;
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        -o-transition: all 1s ease;
        transition: all 1s ease;
        margin: auto;
        padding: 0;
        margin: 0 auto;
        direction: rtl;
        ;
    }

    body,
    .table-section {
        background-color: var(--bs-body-bg);
    }

    .fa::before {
        font-family: FontAwesome;
    }

    input
</style>