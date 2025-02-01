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
        case 'Confirm':
            return 'تایید شده';
        case 'Notifed':
            return 'اطلاع رسانی شده';
        case 'Cancled':
            return 'کنسل شده';
        case 'Requested':
            return 'درخواست شده';
        case 'Done':
            return 'به پایان رسیده';
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
            <h4 class="fw-semibold fs-18 mb-sm-0"><?=$Title; ?></h4>


            <a href="<?= base_url() ?>Trips/New"
                class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">

                <span class="py-sm-1 d-block"> <i class="ri-add-line text-white"></i> <span>افزودن استعلام</span> </span> </a>
        </div>
        <div class="default-table-area my-task-list">
            <div class="table-responsive">
              
            <table class="table align-middle">


<thead>
    <tr class="text-center">
        <th scope="col">شناسه</th>
        <th scope="col">مشتری / مسافر</th>
        <th scope="col">مبدا</th>
        <th scope="col">مقصد</th>
        <th scope="col">تاریخ سفر</th>
        <th scope="col">تاریخ تماس</th>
        <th scope="col">هزینه سفر</th>
        <th scope="col">وضعیت</th>
        <th scope="col">شماره تماس</th>
        <th scope="col"></th>
    </tr>
</thead>
<tbody>



    <?php if (isset($Trip)): foreach ($Trip as $S): ?>
            <tr class="text-center tr_<?= $S['id'] ?>">
                <td class="text-start">
                    <?= 1000 + $S['id'] ?>
                </td>

                    <td class="text-start">
                        
                    <?php

                                if(isset($S['isGuest']) && $S['isGuest'] > 0){
                                     echo $S['passenger_name'].'<br/> <span class="mosafer"> [مسافر : '.$S['guest_name'].'] </span>';
                                }else{
                                    echo $S['passenger_name'];
                                }
                            
                    
                    ?> </td>

                <td class="w-50">
                    <span style="text-align: right;width: 100% !important;" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-50 d-block"><?= $S['startAdd']  ?></span>
                </td>


                <td>
                    <span style="text-align: right;width: 100% !important;" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-50 d-block"><?= $S['endAdd']  ?></span>
                </td>



                <td> <span><?= $S['trip_date'] ?></span> </td>
                <td style="direction: ltr;"> <span><?= $S['call_date'] ?></span> </td>
                <td> <span><?= number_format($S['finalFare']) ?> تومان</span> </td>

                <td>
                    <span class="<?= getServiceDIV($S['status']) ?> bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block"><?= getServiceStatus($S['status']) ?></span>
                </td>

                <?php if ($S['isGuest'] > 0): ?>
                    <td class="text-start">
                        
                    <?php
          
                                if(isset($S['isGuest']) && $S['isGuest'] > 0){
                                     echo $S['passenger_tel'].'<br/> <span class="mosafer"> [مسافر : '.$S['passenger_tel'].'] </span>';
                                }else{
                                    echo $S['passenger_tel'];
                                }
                            
                    
                    ?>


                    </span> </td>
                <?php else: ?>
                    <td class="text-start"><?= $S['guest_tel'] ?> </td>
                <?php endif; ?>



                <td>
                    <div class="dropdown action-opt">
                        <button class="btn bg p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i data-feather="more-horizontal"></i> </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#updateStatus" data-id="<?= $S['id'] ?>" data-status="<?= $S['status'] ?>" class="dropdown-item" href="javascript:;"> <i data-feather="share-2"></i> تغییر وضعیت </a>
                            </li>
                            <li>
                                <a data-bs-toggle="modal" data-package="<?=$S['Packgae'] ?>" data-fare="<?= number_format($S['finalFare']) ?>" data-id="<?= $S['id'] ?>" data-bs-target="#PayingFare" class="dropdown-item" href="javascript:;"> <i data-feather="link-2"></i> اعلام به رانندگان </a>

                            </li>
                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#ViewItem" class="dropdown-item view_item" href="javascript:;" data-id="<?= $S['id'] ?>">
                                    <svg class="feather feather-link-2" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
                                        <path fill="#5b5b98"d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z" />
                                    </svg>
                                    نمایش </a>
                            </li>

                            <li>
                                <a class="dropdown-item editBTN" data-id="<?= $S['id'] ?>" href="javascript:;" data-toggle="modal" data-target="#staticBackdrop">
                                    <i data-feather="edit"></i> ویرایش
                                </a>
                            </li>


                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#TrancactionList" class="dropdown-item" data-id="<?= $S['id'] ?>" href="javascript:;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>    
                                تراکنش ها
                                </a>
                            </li>



                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#TrancactionAddModal" class="dropdown-item" data-id="<?= $S['id'] ?>" href="javascript:;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                 افزودن تراکنش
                                </a>
                            </li>






                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#Delete" class="dropdown-item" data-id="<?= $S['id'] ?>"  href="javascript:;"> <i data-feather="trash-2"></i> حذف </a>
                            </li>


                            
                            <li>
                                <a  class="dropdown-item" href="<?=base_url()?>TripsDetail/<?= $S['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path fill="#5b5b98" d="m18.5,17c0,.829-.671,1.5-1.5,1.5s-1.5-.671-1.5-1.5.671-1.5,1.5-1.5,1.5.671,1.5,1.5Zm5.207,6.707c-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-1.822-1.822c-.981.699-2.177,1.115-3.471,1.115-3.308,0-6-2.692-6-6s2.692-6,6-6,6,2.692,6,6c0,1.294-.416,2.49-1.115,3.471l1.822,1.822c.391.391.391,1.023,0,1.414Zm-2.966-5.878c.334-.501.334-1.157,0-1.659-.632-.949-1.82-2.171-3.741-2.171-1.97,0-3.168,1.284-3.787,2.241-.294.454-.294,1.064,0,1.518.62.957,1.819,2.241,3.787,2.241,2.193,0,3.453-1.738,3.741-2.171Zm-9.741,5.171c0,.553-.448,1-1,1h-5c-2.757,0-5-2.243-5-5V5C0,2.243,2.243,0,5,0h4.515c1.871,0,3.629.729,4.95,2.051l3.484,3.484c.889.888,1.522,2.001,1.833,3.217.076.3.011.617-.179.861s-.481.387-.79.387h-5.813c-1.654,0-3-1.346-3-3V2.023c-.16-.016-.322-.023-.485-.023h-4.515c-1.654,0-3,1.346-3,3v14c0,1.654,1.346,3,3,3h5c.552,0,1,.447,1,1Zm1-16c0,.552.449,1,1,1h4.339c-.22-.383-.489-.736-.804-1.051l-3.484-3.484c-.318-.318-.671-.588-1.051-.806v4.341Z"/></svg>
                                جزئیات </a>
                            </li>


                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#Request" class="dropdown-item" data-id="<?= $S['id'] ?>"  href="javascript:;"> 
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                                    <path fill="#5b5b98" d="m8,12c3.309,0,6-2.691,6-6S11.309,0,8,0,2,2.691,2,6s2.691,6,6,6Zm0-10c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4Zm8,17v5h-2v-5c0-1.654-1.346-3-3-3h-6c-1.654,0-3,1.346-3,3v5H0v-5c0-2.757,2.243-5,5-5h6c2.757,0,5,2.243,5,5Zm7.957-9.52l-4.926,4.926c-.396.395-.915.593-1.434.593s-1.038-.198-1.433-.592l-2.871-2.871,1.414-1.414,2.87,2.871,4.965-4.926,1.414,1.414Z"/>
                                    </svg>                                                    
                                درخواست ها </a>
                            </li>



                            <li>
                                <!-- <a class="dropdown-item factorBTN" data-id="<?= $S['id'] ?>" href="javascript:;" data-toggle="modal" data-target="#endFactor"> -->
                                <a class="dropdown-item factorBTN" data-id="<?= $S['id'] ?>" href="javascript:;" >
                                    <i data-feather="edit"></i> فاکتور سرویس
                                </a>
                            </li>




                        </ul>
                    </div>
                </td>
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