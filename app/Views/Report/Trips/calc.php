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

<h3 style="margin-top: 20px !important;">گزارش سرویس</h3>


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
                ?>



<table class="table table-bordered">
    <tr class="mini">
        <td style="background: aquamarine;">عنوان فیلتر</td>
        <td style="background: aquamarine;">مقدار</td>
    </tr>

    
    <?php if (isset($user) && !empty($user)): ?>
        <tr class="mini">
            <td>کد اشتراک</td>
            <td><?= ($user) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($driver) && !empty($driver)): ?>
        <tr class="mini">
            <td>شناسه راننده</td>
            <td><?= ($driver) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($loc_start) && !empty($loc_start)): ?>
        <tr class="mini">
            <td>آدرس شروع</td>
            <td><?= ($loc_start) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($loc_end)   && !empty($loc_end)): ?>
        <tr class="mini">
            <td>آدرس پایان</td>
            <td><?= ($loc_end) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($contact_start_date) && !empty($contact_start_date)): ?>
        <tr class="mini">
            <td>تاریخ تماس از</td>
            <td><?= ($contact_start_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($contact_end_date) && !empty($contact_end_date)): ?>
        <tr class="mini">
            <td>تاریخ تماس تا</td>
            <td><?= ($contact_end_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($trip_start_date) && !empty($trip_start_date)): ?>
        <tr class="mini">
            <td>تاریخ سفر از</td>
            <td><?= ($trip_start_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($trip_end_date) && !empty($trip_end_date)): ?>
        <tr class="mini">
            <td>تاریخ سفر تا</td>
            <td><?= ($trip_end_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($guest_name) && !empty($guest_name)): ?>
        <tr class="mini">
            <td>نام مسافر</td>
            <td><?= ($guest_name) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($guest_tel) && !empty($guest_tel)): ?>
        <tr class="mini">
            <td>شماره تماس مسافر</td>
            <td><?= ($guest_tel) ?></td>
        </tr>
    <?php endif; ?>
</table>





    
<table class="table align-middle">


<thead>
    <tr class="text-center">
        <th scope="col">شناسه</th>
        <th scope="col no-wrap">مشتری / مسافر</th>
        <th scope="col">مبدا</th>
        <th scope="col">مقصد</th>
        <th scope="col">تاریخ سفر</th>
        <th scope="col">تاریخ تماس</th>
        <th scope="col">هزینه سفر</th>
        <th scope="col">وضعیت</th>
        <th scope="col">شماره تماس</th>
    </tr>
</thead>
<tbody>



    <?php if (isset($Trip)): foreach ($Trip as $S): ?>
            <tr class="text-center tr_<?= $S['id'] ?>">
                <td class="text-start">
                    <?= 1000 + $S['id'] ?>
                </td>

                    <td class="text-start no-wrap">
                        
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
                <td> <span><?= number_format($S['userCustomFare']) ?> تومان</span> </td>

                <td>
                    <span ><?= getServiceStatus($S['status']) ?></span>
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
    


            </tr>



            
            <?php if (isset($S['Transactions']) && !empty($S['Transactions'])): ?>


                        <tr class="tr"  style="zoom: 0.8;">
                            <th>مبلغ</th>
                            <th>نوع تراکنش</th>
                            <th>نام</th>
                            <th>تلفن</th>
                            <th>توضیحات</th>
                            <th>شناسه تراکنش</th>
                            <th>کد پیگیری</th>
                            <th>تاریخ</th>
                            <th>بانک</th>
                            

                        </tr>

                        <?php foreach ($S['Transactions'] as $transaction): ?>
                            <tr class="tr"  style="zoom: 0.8;">
                                <td><?php echo number_format($transaction['amount']) ?> ریال</td>
                                <td>
                                    <?php if ($transaction['type'] == 'in'): ?>
                                        دریافتی از مشتری
                                    <?php else: ?>
                                        پرداختی به راننده
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $transaction['name'] ?></td>
                                <td><?php echo $transaction['tel'] ?></td>
                                <td><?php echo $transaction['desc'] ?></td>
                                <td><?php echo $transaction['trans_id'] ?></td>
                                <td><?php echo $transaction['refid'] ?></td>
                                <td><?php echo $transaction['date_p'] ?></td>

                                    <td><?php echo $transaction['bank_name'] ?></td>
                               

                            </tr>
                        <?php endforeach; ?>

             <?php endif; ?>




    <?php endforeach;endif; ?>
</tbody>
</table>          










<div class="card bg-white border-0 rounded-10 mb-4">
   <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
         <h4 class="fw-bold fs-18 mb-0">سفارشات</h4>
      </div>
      <ul class="ps-0 mb-0 list-unstyled sales_by_locations mt-4">

      <?php foreach($status as $key => $value): ?>
         <li>
            <span class="fw-semibold d-block mb-2"><?=getServiceStatus($key)?></span> 
            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?=round(( $value/$AllType)*100) ?>" aria-valuemin="0" aria-valuemax="100">
               <div class="progress-bar" style="width: <?=round(( $value/$AllType)*100) ?>%"> <span class="count fw-semibold text-body">%<?=round(( $value/$AllType)*100) ?></span> </div>
            </div>
         </li>

            <?php endforeach; ?>
      </ul>
   </div>
</div>






<style>
    .mini td {
        height: 8px;
        padding: 1px !important;
    }

    .tr th,.tr td{
        background: blue;
        color: white;
    }

    .no-wrap 
{
    white-space: nowrap;
}

.table > :not(caption) > * > *{
    padding: 0 !important;
    margin: 0 !important;
}

@media print {
  /* All your print styles go here */
  .table > :not(caption) > * > *{
    padding: 0 !important;
    margin: 0 !important;
}
.py-1,.py-2{
    padding: 0 !important;
    margin: 0 !important;
}
body *{
    background: white;
}
.tr{
    background: black !important;
}
}
</style>