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
$payment_status = isset($_GET['payment_status']) ? $_GET['payment_status'] : null;
$Tstatus = isset($_GET['status']) ? $_GET['status'] : null;
?>



<table class="table table-bordered">
    <tr>
        <td style="background: #cdcdcd;">عنوان فیلتر</td>
        <td style="background: #cdcdcd;">مقدار</td>
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

    <?php if (isset($payment_status) && !empty($payment_status)): ?>
        <tr class="mini">
            <td>وضعیت پرداخت</td>
            <td><?= getPaymentStatus($payment_status) ?></td>
        </tr>
    <?php endif; ?>

    <?php if (isset($status) && !empty($status)): ?>
        <tr class="mini">
            <td>وضعیت سرویس</td>
            <td><?= getServiceStatus($Tstatus) ?></td>
        </tr>
    <?php endif; ?>
</table>





<div class="row data_footer">

    <div class="col-sm-6">
        <h3>اطلاعات مالی</h3>
        <table class="table table-bordered">

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
                <td>میانگین کرایه دریافتی از مشترک</td>
                <td><?= number_format($averageUserCustomFare) ?> تومان</td>
            </tr>
            <tr>
                <td>میانگین پرداختی به راننده</td>
                <td><?= number_format($averageDriverCustomFare) ?> تومان</td>
            </tr>
            <tr>
                <td>بیشترین کرایه دریافتی</td>
                <td><?= number_format($maxUserCustomFare) ?> تومان
                    | <a id="UserTab" href="<?= base_url() ?>UserCard/<?= $maxUserCustomFareUser ?>">مشاهده مشترک</a>
                </td>
            </tr>
            <tr>
                <td>کمترین کرایه دریافتی</td>
                <td><?= number_format($minUserCustomFare) ?> تومان
                    | <a id="UserTab" href="<?= base_url() ?>UserCard/<?= $minUserCustomFareUser ?>">مشاهده مشترک</a>
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
        <table class="table table-bordered">
            <h3>تعداد و نوع سفارشات</h3>

            <thead>
                <tr>
                    <th> وضعیت سفارشات</th>
                    <th>تعداد</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($status as $key => $value): ?>
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




<table class="table align-middle bg-white">


    <thead>
        <tr class="text-center bg-white">
            <th scope="col bg-white">شناسه</th>
            <th scope="col bg-white">مشتری / مسافر</th>
            <th scope="col bg-white">مبدا</th>
            <th scope="col bg-white">مقصد</th>
            <th scope="col bg-white">تاریخ سفر</th>
            <th scope="col bg-white">تاریخ تماس</th>
            <th scope="col bg-white">هزینه سفر</th>
            <th scope="col bg-white">وضعیت</th>
            <th scope="col bg-white">شماره تماس</th>
        </tr>
    </thead>
    <tbody>



        <?php if (isset($Trip)): foreach ($Trip as $S): ?>
                <tr class="text-center bg-white tr_<?= $S['id'] ?>">
                    <td class="text-start bg-white">
                        <?= 1000 + $S['id'] ?>
                    </td>

                    <td class="text-start  bg-white">

                        <?php

                        if (isset($S['isGuest']) && $S['isGuest'] > 0) {
                            echo $S['passenger_name'] . '<br/> <span class="mosafer"> [مسافر : ' . $S['guest_name'] . '] </span>';
                        } else {
                            echo $S['passenger_name'];
                        }


                        ?> </td>

                    <td class="bg-white">
                        <span style="text-align: right;width: 100% !important;" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-50 d-block"><?= $S['startAdd']  ?></span>
                    </td>


                    <td class=" bg-white">
                        <span style="text-align: right;width: 100% !important;" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-50 d-block"><?= $S['endAdd']  ?></span>
                    </td>



                    <td class=" bg-white"> <span><?= $S['trip_date'] ?></span> </td>
                    <td class=" bg-white" style="direction: ltr;"> <span><?= $S['call_date'] ?></span> </td>
                    <td class=" bg-white"> <span><?= number_format($S['userCustomFare']) ?> تومان</span> </td>

                    <td class=" bg-white">
                        <span><?= getServiceStatus($S['status']) ?></span>
                    </td>

                    <td class=" bg-white" class="text-start">

                        <?php

                        if (isset($S['isGuest']) && $S['isGuest'] > 0) {
                            echo $S['passenger_tel'] . '<br/> <span class="mosafer"> [مسافر : ' . $S['guest_tel'] . '] </span>';
                        } else {
                            echo $S['passenger_tel'];
                        }


                        ?>


                        </span> </td>



                </tr>




                <?php if (isset($S['Transactions']) && !empty($S['Transactions'])): ?>


                    <tr class="tr" style="zoom: 0.8;">
                        <th>نوع تراکنش</th>
                        <th>نام</th>
                        <th>توضیحات</th>
                        <th>شناسه تراکنش</th>
                        <th>کد پیگیری</th>
                        <th>تاریخ</th>
                        <th>مبلغ</th>
                        <th>بانک</th>
                        <th>تلفن</th>


                    </tr>

                    <?php foreach ($S['Transactions'] as $transaction): ?>
                        <tr class="tr" style="zoom: 0.8;">
                            <td>
                                <?php if ($transaction['type'] == 'in'): ?>
                                    دریافتی از مشتری
                                <?php else: ?>
                                    پرداختی به راننده
                                <?php endif; ?>
                            </td>
                            <td><?php echo $transaction['name'] ?></td>
                            <td><?php echo $transaction['desc'] ?></td>
                            <td><?php echo $transaction['trans_id'] ?></td>
                            <td><?php echo $transaction['refid'] ?></td>
                            <td><?php echo $transaction['date_p'] ?></td>
                            <td><?php echo number_format($transaction['amount']) ?> ریال</td>
                            
                            <td><?php echo $transaction['bank_name'] ?></td>
                            <td><?php echo $transaction['tel'] ?></td>


                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>




        <?php endforeach;
        endif; ?>
    </tbody>
</table>









<style>
    .mini td {
        height: 8px;
        padding: 1px !important;
    }

    .tr th,
    .tr td {
        background: #cdcdcd;
        color: #000000;
    }



    .table> :not(caption)>*>* {
        padding: 0 !important;
        margin: 0 !important;
    }

    @media print {

        /* All your print styles go here */
        .table> :not(caption)>*>* {
            padding: 0 !important;
            margin: 0 !important;
        }

        .py-1,
        .py-2 {
            padding: 0 !important;
            margin: 0 !important;
        }

        body * {
            background: white;
        }

        .tr {
            background: black !important;
        }
        .data_footer * , body{
            background: white !important;
        }
    }
</style>

<script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>