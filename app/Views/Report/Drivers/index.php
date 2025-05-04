<?php
function getPassengerType($type)
{
    switch ($type) {
        case 'P':
            return 'حقیقی';
        case 'C':
            return 'شرکتی';
        default:
            return '';
    }
}

function getCategory($category)
{
    switch ($category) {
        case 'exclusive':
            return 'دربستی';
        case 'ticket':
            return 'بلیط';
        default:
            return '';
    }
}

function getFactorStatus($status)
{
    switch ($status) {
        case 'Yes':
            return 'بله';
        case 'No':
            return 'خیر';
        default:
            return '';
    }
}

function getServiceType($type)
{
    switch ($type) {
        case 'OneWay':
            return 'یک طرفه';
        case 'Sweep':
            return 'رفت و برگشت';
        case 'Full':
            return 'در اختیار';
        default:
            return '';
    }
}
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


function getServiceDIV($status)
{
    switch ($status) {
        case 'Called':
            return 'bg-primary ';
        case 'Reserved':
            return 'bg-secondary ';
        case 'Confirm':
            return 'bg-success ';
        case 'Notifed':
            return 'bg-warning ';
        case 'Cancled':
            return 'bg-danger ';
        case 'Requested':
            return 'bg-info ';
        case 'Done':
            return 'bg-dark ';
    }
}

function getIsPaid($paid)
{
    switch ($paid) {
        case 'Yes':
            return 'بله';
        case 'No':
            return 'خیر';
        default:
            return '';
    }
}

function getIsTax($tax)
{
    switch ($tax) {
        case 'Yes':
            return 'بله';
        case 'No':
            return 'خیر';
        default:
            return '';
    }
}

function getRandomColor()
{
    // Array of color names
    $colors = [
        "Red",
        "Green",
        "Blue",
        "Yellow",
        "Purple",
        "Orange",
        "Pink",
        "Brown",
        "Black",
        "Gray",
        "Cyan",
        "Magenta",
        "Lime",
        "Maroon",
        "Navy",
        "Olive",
        "Teal",
        "Aqua",
        "Fuchsia",
        "Silver"
    ];

    // Get a random index from the array
    $randomIndex = array_rand($colors);

    // Return the color name at the random index
    return $colors[$randomIndex];
}

function getPaymentStatus($status)
{
    switch ($status) {
        case 'Paid':
            return 'تسویه شده';
        case 'halfPaid':
            return 'نیمه پرداخت شده';
        case 'notPaid':
            return 'اصلا پرداخت نشده';
        default:
            return '';
    }
}


function getRandomColorPair()
{
    // Array of color pairs (background color, text color)
    $colorPairs = [
        ["#FFFFFF", "#000"], // Black background, White text
    ];

    // Get a random index from the array
    $randomIndex = array_rand($colorPairs);

    // Return the color pair at the random index
    return $colorPairs[$randomIndex];
}
?>

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">

</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">گزارش رانندگان</h4>


        </div>
        <div class="default-table-area my-task-list">
            <div class="table-responsive">
              
            <table class="table align-middle">


<thead>
    <tr class="text-center">
        <th scope="col">شناسه</th>
        <th scope="col"></th>
        <th scope="col">نام و نام خانوادگی</th>
        <th scope="col">شماره تماس</th>
        <th scope="col">تعداد درخواست ها</th>
        <th scope="col">درخواست های تایید شده</th>
        <th scope="col">درخواست های تایید نشده</th>

    </tr>
</thead>
<tbody>



    <?php if (isset($Drivers)): foreach ($Drivers as $D): ?>
            <tr class="text-center tr_<?= $D['did'] ?>">
               
    
            
                <td> <span><?= $D['code'] ?></span> </td>
                <td> <span><img class="rounded-circle wh-54" src="<?=base_url()?>/uploads/drivers/<?= $D['did'] ?>/<?= $D['ax'] ?> "/></span> </td>
                <td> <span><?= $D['name'].' '. $D['lname'] ?></span> </td>
                <td> <span><?= $D['mobile'] ?></span> </td>
                
                <td> <span><?= $D['TotalRequests'] ?></span> </td>
                <td> <span><?= $D['AcceptedRequests'] ?></span> </td>
                <td> <span><?= $D['RejectedRequests'] ?></span> </td>
          

    


               
            </tr>
    <?php endforeach;endif; ?>
</tbody>
</table>            </div>
        </div>
    </div>
</div>








<link rel="stylesheet" href="<?=base_url()?>assets/css/jalalidatepicker.min.css">
<script type="text/javascript" src="<?=base_url()?>assets/js/jalalidatepicker.min.js"></script>

<script>
    jalaliDatepicker.startWatch();
</script>

<style>

jdp-container {
    z-index: 99999 !important;
}

span.mosafer {
        font-size: 12px;
        background: antiquewhite;
    }
    .notif_spinner,
    .change_status {
        display: none;
    }

    .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        height: 40px;
    }

    .chosen-container.chosen-container-multi {
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

    .chosen-container-multi .chosen-choices {

        padding: 15px 5px !important;
        border-radius: 15px;
        border: 1px solid #aaa !important;
        background-color: #fff !important;
        background-image: none !important;
    }

    .chosen-choices li {
        float: right !important;
        margin-right: 20px !important;
    }
</style>


<script src="<?=base_url()?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?=base_url()?>assets/js/dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>

<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />
<link href="<?=base_url()?>assets/css/leaflet.css" rel="stylesheet" type="text/css">


<script src="<?= base_url() ?>assets/js/custom/service.js"></script>
<script src="<?=base_url()?>assets/js/jalaali.min.js"></script>
<script src="<?=base_url()?>assets/js/polyline.min.js"></script>
<script src="<?=base_url()?>assets/js/leaflet.js" type="text/javascript"></script>





<script>
    $("body").on("click" , ".print_btn" , function(e) {

        e.preventDefault();
        // alert("dsfsdf");


        let cururl = $(this).attr("href");


        const width = screen.width;
        const height = screen.height;
        const left = 0;
        const top = 0;

        return window.open(cururl, '_blank', `width=${width},height=${height},top=${top},left=${left}`);

        });
</script>