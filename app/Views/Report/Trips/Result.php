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
        case 'Service':
            return 'bg-light ';
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
            <h4 class="fw-semibold fs-18 mb-sm-0"><?=$Title; ?></h4>

            <?php
                $user = isset($_GET['user']) ? 1000 + $_GET['user'] : null;
                $driver = isset($_GET['driver']) ? 1000 + $_GET['driver'] : null;
                $loc_start = isset($_GET['loc_start']) ? $_GET['loc_start'] : null;
                $loc_end = isset($_GET['loc_end']) ? $_GET['loc_end'] : null;
                $contact_start_date = isset($_GET['contact_start_date']) ? $_GET['contact_start_date'] : null;
                $contact_end_date = isset($_GET['contact_end_date']) ? $_GET['contact_end_date'] : null;
                $trip_start_date = isset($_GET['trip_start_date']) ? $_GET['trip_start_date'] : null;
                $trip_end_date = isset($_GET['trip_end_date']) ? $_GET['trip_end_date'] : null;
                $guest_name = isset($_GET['guest_name']) ? $_GET['guest_name'] : null;
                $guest_tel = isset($_GET['guest_tel']) ? $_GET['guest_tel'] : null;

                $status = isset($_GET['status']) ? $_GET['status'] : null;
                $payment_status = isset($_GET['payment_status']) ? $_GET['payment_status'] : null;
                ?>

            <div class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                <?php if (isset($user)): ?>
                    <span class="badge text-bg-primary py-1 px-2 text-white rounded-1 fw-semibold fs-15">کد اشتراک : <?= ($user) ?></span>
                <?php endif; ?>
                <?php if (isset($driver)): ?>
                    <span class="badge text-bg-secondary py-1 px-2 text-white rounded-1 fw-semibold fs-15">شناسه راننده : <?= ($driver) ?></span>
                <?php endif; ?>
                <?php if (isset($loc_start)): ?>
                    <span class="badge text-bg-success py-1 px-2 text-white rounded-1 fw-semibold fs-15">آدرس شروع : <?= ($loc_start) ?></span>
                <?php endif; ?>
                <?php if (isset($loc_end)): ?>
                    <span class="badge text-bg-danger py-1 px-2 text-white rounded-1 fw-semibold fs-15">آدرس پایان : <?= ($loc_end) ?></span>
                <?php endif; ?>
                <?php if (isset($contact_start_date)): ?>
                    <span class="badge text-bg-warning py-1 px-2 text-white rounded-1 fw-semibold fs-15">تاریخ تماس از : <?= ($contact_start_date) ?></span>
                <?php endif; ?>
                <?php if (isset($contact_end_date)): ?>
                    <span class="badge text-bg-info py-1 px-2 text-white rounded-1 fw-semibold fs-15">تاریخ تماس تا : <?= ($contact_end_date) ?></span>
                <?php endif; ?>
                <?php if (isset($trip_start_date)): ?>
                    <span class="badge text-bg-success py-1 px-2 text-white rounded-1 fw-semibold fs-15">تاریخ سفر از : <?= ($trip_start_date) ?></span>
                <?php endif; ?>
                <?php if (isset($trip_end_date)): ?>
                    <span class="badge text-bg-dark py-1 px-2 text-white rounded-1 fw-semibold fs-15">تاریخ سفر تا : <?= ($trip_end_date) ?></span>
                <?php endif; ?>
                <?php if (isset($guest_name)): ?>
                    <span class="badge text-bg-primary py-1 px-2 text-white rounded-1 fw-semibold fs-15">نام مسافر : <?= ($guest_name) ?></span>
                <?php endif; ?>
                <?php if (isset($guest_tel)): ?>
                    <span class="badge text-bg-secondary py-1 px-2 text-white rounded-1 fw-semibold fs-15">شماره تماس مسافر : <?= ($guest_tel) ?></span>
                <?php endif; ?>
                <?php if (isset($status)): ?>
                    <span class="badge text-bg-info py-1 px-2 text-white rounded-1 fw-semibold fs-15">وضعیت : <?= getServiceStatus($status) ?></span>
                <?php endif; ?>
                <?php if (isset($payment_status)): ?>
                    <span class="badge text-bg-warning py-1 px-2 text-white rounded-1 fw-semibold fs-15">وضعیت پرداخت : <?= getPaymentStatus($payment_status) ?></span>
                <?php endif; ?>
            </div>
                        

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



                <td> <span><?= $S['trip_date'] ?><?php 
                if(!empty($S['trip_time'])){
                        $tripDateTime = explode(':',  $S['trip_time']);
                        echo '-<span>' . $tripDateTime[0] . '</span>:<span>' . $tripDateTime[1] . '</span>'; 
                }
                    ?></span> 
            
            <?php if(!empty($S['driverID'] && $S['driverID'] > 0)): ?> <br/>
                <span  class="badge bg-opacity-10 bg-dark py-1 px-2 text-dark rounded-1 fw-semibold fs-12">
                    
                <svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    viewBox="0 0 508 508" xml:space="preserve">
                        <circle style="fill:#324A5E;" cx="254" cy="254" r="254"/>
                        <path style="fill:#2C9984;" d="M438,428.8c-45.6,48-110,78.4-181.6,79.2l0,0c-0.8,0-1.6,0-2.4,0c-72.4,0-138-30.4-184-79.2l0,0
                            c17.2-59.6,54.8-63.6,54.8-63.6c49.2-23.6,78.8-57.2,80.4-59.2h97.2c1.6,2,31.2,35.6,80.8,59.2C383.2,365.2,421.2,369.2,438,428.8z"
                            />
                        <path style="fill:#FFD05B;" d="M307.2,437.2v-126c-3.6-2.4-6.8-6-8.4-10c-1.2-2.4-2-5.2-2.4-8.4l-4-53.6h-76.8l-2.8,40.4l0,0
                            l-0.8,13.2c-0.4,8-5.2,14.8-11.6,18.8v125.2l53.6,60.4L307.2,437.2z"/>
                        <path style="fill:#F9B54C;" d="M298.8,301.2L298.8,301.2c-64.4,50.8-85.6-19.2-86-21.6l0,0l2.8-40.4h77.2l4,53.6
                            C296.8,296,297.2,298.8,298.8,301.2z"/>
                        <polygon style="fill:#E6E9EE;" points="312,432.4 312,338 196,338 196,432.4 254,500 "/>
                        <polygon style="fill:#F1543F;" points="264.8,355.2 270.4,338 237.6,338 243.2,355.2 "/>
                        <polygon style="fill:#FF7058;" points="291.2,450.8 264.8,355.2 243.2,355.2 216.8,450.8 254,494.8 "/>
                        <path style="fill:#4CDBC4;" d="M329.2,436l-14.4-33.2h39.6c-10-46-36.8-80-49.6-94.4c-1.2-1.6-2.4-2.4-2.4-2.8H300
                            c4,10.4,10.8,39.6-8.8,82c0,0-20.4,58.8-37.6,106.4C236.4,446.4,216,387.6,216,387.6c-19.6-42.4-12.4-71.6-8.8-82h-2.4
                            c-0.4,0.4-1.2,1.2-2.4,2.8c-12.4,14-39.2,48.4-49.6,94.4h39.6L178,436c25.2,13.6,67.2,66.4,71.6,72c1.2,0,2.4,0,4,0
                            c0.8,0,1.6,0,2.4,0l0,0c0.4,0,0.8,0,1.2,0C262.4,502,304,449.6,329.2,436z"/>
                        <path style="fill:#2B3B4E;" d="M334.8,200.8c2.8-8.4,4.4-17.2,4.4-26.4c0-46.4-38.4-84-85.2-84c-47.2,0-85.2,37.6-85.2,84
                            c0,9.2,1.6,18,4.4,26.4H334.8z"/>
                        <path style="fill:#FFD05B;" d="M338.8,185.6c-3.2-1.6-7.2-0.8-10.8,2c-0.8-49.6-33.6-67.6-74-67.6s-73.2,18-73.6,67.6
                            c-4-2.8-7.6-3.6-10.8-2c-6.4,3.6-7.2,15.6-2,27.6c4.8,10.8,12.8,17.2,18.8,16c11.2,38.8,37.2,73.6,67.6,73.6s56.4-35.2,67.6-73.6
                            c6,1.2,14.4-5.2,18.8-16C346,201.2,344.8,188.8,338.8,185.6z"/>
                        <ellipse style="fill:#2B3B4E;" cx="254" cy="139.6" rx="70.4" ry="34.4"/>
                        <path style="fill:#4CDBC4;" d="M176,119.2h156.4c15.6-6,27.6-14.4,32.4-24C378,68,330,40.8,254,40.8S130,68.4,143.6,95.2
                            C148.4,104.8,160.4,113.2,176,119.2z"/>
                        <g>
                            <path style="fill:#2C9984;" d="M176,119.2c50-16.4,106.4-16.4,156.4,0c0,7.2,0,14.4,0,21.6c-52,0-104.4,0-156.4,0
                                C176,133.6,176,126.4,176,119.2z"/>
                            <circle style="fill:#2C9984;" cx="254" cy="77.6" r="17.6"/>
                        </g>
                        <g>
                            <path style="fill:#FFFFFF;" d="M298.8,301.6c0,0-3.2,18-44.8,36.4c0,0,30.8,19.2,36.4,34.8C290.4,372.8,318.8,334,298.8,301.6z"/>
                            <path style="fill:#FFFFFF;" d="M209.6,301.6c0,0,3.2,18,44.4,36.4c0,0-30.8,19.2-36.4,34.8C217.6,372.8,189.2,334,209.6,301.6z"/>
                        </g>
                        <path style="fill:#324A5E;" d="M254,250.4c-14-7.2-19.6,14.4-42,2c0,0,8.8,24.4,42,9.6c33.2,14.4,42-9.6,42-9.6
                            C273.6,264.8,268,243.2,254,250.4z"/>
                        </svg>
                        
                <?=$S['driver_name'] ?> <?=$S['driver_lname'] ?>
                 
                    </span>      <br/>          <span class="badge bg-opacity-10 bg-dark py-1 px-2 text-dark rounded-1 fw-semibold fs-12"><?=$S['driver_mobile'] ?></span>

                    <?php endif;?>
            </td>
                <td style="direction: ltr;"> <span><?= $S['call_date'] ?></span> </td>
                <td> <span><?= number_format($S['userCustomFare']) ?> تومان
            
                <br/>

                <?php if($S['status'] == 'Done' || $S['status'] == 'Confirm'): ?>
            
                    <?php if ($S['payment_status'] == 'Paid'): ?>
                        <span class="badge text-bg-success py-1 px-2 text-white rounded-pill fw-semibold fs-12">تسویه شده</span>
                    <?php elseif ($S['payment_status'] == 'notPaid'): ?>
                        <span class="badge text-bg-danger py-1 px-2 text-white rounded-pill fw-semibold fs-12">اصلا پرداخت نشده</span>
                    <?php elseif ($S['payment_status'] == 'halfPaid'): ?>
                        <span class="badge text-bg-info py-1 px-2 text-white rounded-pill fw-semibold fs-12">نیمه پرداخت شده</span>
                    <?php endif; ?>
                <?php endif; ?>
            
            </span> </td>

                <td>
                    <span class="<?= getServiceDIV($S['status']) ?> bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block"><?= getServiceStatus($S['status']) ?></span>
                </td>

                    <td class="text-start">

                    <?php
          
                                if(isset($S['isGuest']) && $S['isGuest'] > 0){
                                    echo $S['passenger_tel'].'<br/> <span class="mosafer"> [مسافر : '.$S['guest_tel'].'] </span>';
                                }else{
                                    echo $S['passenger_tel'];
                                }
                            
                    
                    ?>


                    </span> </td>
    


                <td>
                    <div class="dropdown action-opt">
                        <button class="btn bg p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i data-feather="more-horizontal"></i> </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#updateStatus" data-id="<?= $S['id'] ?>" data-status="<?= $S['status'] ?>" class="dropdown-item" href="javascript:;"> <i data-feather="share-2"></i> تغییر وضعیت </a>
                            </li>
                            <li>
                                <a data-bs-toggle="modal" data-package="<?=$S['package'] ?>" data-fare="<?= number_format($S['finalFare']) ?>" data-id="<?= $S['id'] ?>" data-bs-target="#PayingFare" class="dropdown-item" href="javascript:;"> <i data-feather="link-2"></i> اعلام به رانندگان </a>

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
                                <a class="dropdown-item PishfactorBTN" data-id="<?= $S['id'] ?>" href="javascript:;" >
                                    <i data-feather="edit"></i> پیش فاکتور 
                                </a>
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
</table>  </div>


        </div>
    </div>



















</div>







<div class="row">
    <div class="col-sm-8" style="margin: auto;">
        

    

<div class="row data_footer">

<div class="col-sm-6">
    <h3 style="text-align: center;">اطلاعات مالی</h3>
    <table class="tb table-bordered">

        <tr>
            <td>مبلغ کل</td>
            <td><?= number_format($totalIn + $totalOut) ?> تومان</td>
        </tr>
        <tr>
            <td>مجموع دریافتی</td>
            <td><?= number_format($totalIn) ?> تومان</td>
        </tr>
        <tr>
            <td>مجموع پرداختی</td>
            <td><?= number_format($totalOut) ?> تومان</td>
        </tr>

        <tr>
            <td style="background: #cdcdcd;">میزان سود</td>
            <td style="background: #cdcdcd;"><?= number_format($totalIn - $totalOut) ?> تومان</td>
        </tr>
        <tr>
            <td>میانگین کرایه دریافتی از مشتری</td>
            <td><?= number_format($averageUserCustomFare) ?> تومان</td>
        </tr>
        <tr>
            <td>میانگین پرداختی به راننده</td>
            <td><?= number_format($averageDriverCustomFare) ?> تومان</td>
        </tr>
        <tr>
            <td>بیشترین کرایه دریافتی</td>
            <td><?= number_format($maxUserCustomFare) ?> تومان
                | <a id="UserTab" href="<?= base_url() ?>UserCard/<?= $maxUserCustomFareUser ?>">مشاهده مشتری</a>
            </td>
        </tr>
        <tr>
            <td>کمترین کرایه دریافتی</td>
            <td><?= number_format($minUserCustomFare) ?> تومان
                | <a id="UserTab" href="<?= base_url() ?>UserCard/<?= $minUserCustomFareUser ?>">مشاهده مشتری</a>
            </td>
        </tr>
        <tr>
            <td>بیشترین کرایه پرداختی به راننده</td>
            <td><?= number_format($maxDriverCustomFare) ?> تومان
                | <a id="DriverTab" href="<?= base_url() ?>DriverCard/<?= $maxUserCustomFareDriver ?>">مشاهده راننده</a>

            </td>
        </tr>
        <tr>
            <td>کمترین کرایه پرداختی به راننده</td>
            <td>
                <?= number_format($minDriverCustomFare) ?> تومان
                | <a id="DriverTab" href="<?= base_url() ?>DriverCard/<?= $minUserCustomFareDriver ?>">مشاهده راننده</a>

            </td>
        </tr>
        </tr>

    </table>
</div>


<div class="col-sm-6">
    <table class="tb table-bordered">
        <h3 style="text-align: center;">تعداد و نوع سفارشات</h3>

        <thead>
            <tr>
                <th> وضعیت سفارشات</th>
                <th>تعداد</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($t_status as $key => $value): ?>
                <tr>
                    <td><?= getServiceStatus($key) ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td style="background: #cdcdcd;">مجموع سفر</td>
                <td style="background: #cdcdcd;"><?= $AllType ?></td>
            </tr>
        </tbody>
    </table>
</div>

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

    .tb {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  .tb-layout: fixed;
}

.tb caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

.tb tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

.tb th,
.tb td {
  padding: .625em;
  text-align: center;
}

.tb th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  .tb {
    border: 0;
  }

  .tb caption {
    font-size: 1.3em;
  }
  
  .tb thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  .tb tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  .tb td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  .tb td::before {
    /*
    * aria-label has no advantage, it won't be read inside a .tb
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  .tb td:last-child {
    border-bottom: 0;
  }
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