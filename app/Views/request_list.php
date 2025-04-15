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
            return 'پذیرش توسط راننده';
        case 'Notifed':
            return 'اعلام به راننده';
        case 'Cancled':
            return 'کنسل شده';
        case 'Requested':
            return 'اعلام آمادگی راننده';
        case 'Done':
            return 'به پایان رسیده';
        case 'Service':
            return 'سرویس درحال انجام';
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
        default:
            return '';
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
            <h4 class="fw-semibold fs-18 mb-sm-0">استعلام ها</h4>


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
                            <th scope="col">مسافر</th>
                            <th scope="col">مبدا</th>
                            <th scope="col">مقصد</th>
                            <th scope="col">تاریخ سفر</th>
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
                                        <?= $S['id'] ?>
                                    </td>

                                    <?php if ($S['isGuest'] > 0): ?>
                                        <td class="text-start"><?= $S['passenger_name'] ?> </td>
                                    <?php else: ?>
                                        <td class="text-start"><?= $S['guest_name'] ?> </td>
                                    <?php endif; ?>

                                    <td class="w-50">
                                        <span style="text-align: right;width: 10%;" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-50 d-block"><?= $S['startAdd']  ?></span>
                                    </td>


                                    <td>
                                        <span style="text-align: right;" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-50 d-block"><?= $S['endAdd']  ?></span>
                                    </td>



                                    <td> <span><?= $S['trip_date'] ?></span> </td>
                                    <td> <span><?= number_format($S['finalFare']) ?> تومان</span> </td>

                                    <td>
                                        <span class="<?= getServiceDIV($S['status']) ?> bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block"><?= getServiceStatus($S['status']) ?></span>
                                    </td>

                                    <?php if ($S['isGuest'] > 0): ?>
                                        <td class="text-start"><?= $S['passenger_tel'] ?> </td>
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
                                                    <a data-bs-toggle="modal" data-package="<?=$S['Package'] ?>" data-fare="<?= number_format($S['finalFare']) ?>" data-id="<?= $S['id'] ?>" data-bs-target="#PayingFare" class="dropdown-item" href="javascript:;"> <i data-feather="link-2"></i> اعلام به رانندگان </a>

                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#ViewItem" class="dropdown-item view_item" href="javascript:;" data-id="<?= $S['id'] ?>">
                                                        <svg class="feather feather-link-2" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
                                                            <path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z" />
                                                        </svg>
                                                        نمایش </a>
                                                </li>

                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#Delete" class="dropdown-item" data-id="<?= $S['id'] ?>"  href="javascript:;"> <i data-feather="trash-2"></i> حذف </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        <?php endforeach;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">تغییر وضعیت</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group position-relative">
                    <select name="status" class="form-select form-control ps-5 h-58">
                        <option value="Called">استعلام</option>
                        <option value="Reserved">رزرو</option>
                        <option value="Notifed">اطلاع رسانی شده</option>
                        <option value="Requested">درخواست شده</option>
                        <option value="Service">سرویس درحال انجام</option>
                        <option value="Confirm">تایید شده</option>
                        <option value="Cancled">کنسل شده</option>
                        <option value="Done">به پایان رسیده</option>


                    </select>

                </div>
                <input type="hidden" name="ClickedTripID" value="" id="ClickedTripID" />
                <input type="hidden" name="ClickedStatus" value="" id="ClickedStatus" />



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary text-white ChangeStatus"><span role="status">ذخیره تغییرات</span> <span class="spinner-grow spinner-grow-sm change_status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PayingFare" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">اعلام سرویس</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-4 col-lg-12">
                    <h3>کرایه سرویس <span class="badge bg-success base_fare">0</span> تومان</h3>

                </div>

                <div class="form-group position-relative">
                    <input type="text" name="passenger_custom_fare" class="form-control text-dark ps-5 h-58" placeholder="مبلغ اعللامی به مسافر">
                    <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                </div>
                <div class="form-group position-relative pt-20">
                    <input type="text" name="driver_custom_fare" class="form-control text-dark ps-5 h-58" placeholder="مبلغ پرداختی به راننده">
                    <i class="ri-exchange-dollar-line position-absolute top-50 start-0 translate-middle-y pt-20 fs-20 text-gray-light ps-20"></i>
                </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary text-white notif"><span role="status">اعلام سرویس</span> <span class="spinner-grow spinner-grow-sm notif_spinner" aria-hidden="true"></span></button>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="ViewItem" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">نمایش سرویس</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center;">

                <div class="spinner-grow text-primary" role="status"> <span class="visually-hidden">بارگذاری...</span> </div>

            </div>

        </div>
    </div>
</div>







<div class="modal fade" id="Delete" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">حذف مورد</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                آیا از حذف این مورد مطمئن هستید ؟
                <input type="hidden" id="DeleteID" />
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">خیر</button>
                <button type="button" class="btn btn-primary text-white delete"><span role="status">تایید</span></button>

            </div>
        </div>
    </div>
</div>





<div class="toast-container position-fixed bottom-0 end-0 p-3" style="bottom: 55px !important;">
    <div id="liveToast" class="toast bg-success text-white fade hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body"></div>
    </div>
</div>


<div class="toast-warning-container position-fixed bottom-0 end-0 p-3" style="bottom: 55px !important;z-index: 9999;">
    <div id="warnToast" class="toast bg-danger   text-white fade hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body"></div>
    </div>
</div>





<style>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="http://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>

<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />
<link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">


<script src="<?= base_url() ?>assets/js/custom/service.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jalaali-js/dist/jalaali.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-polyline/1.2.1/polyline.min.js"></script>
<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>