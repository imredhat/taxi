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
        case 'Call':
            return 'استعلام';
        case 'Reserve':
            return 'رزرو';
        case 'Confirm':
            return 'تایید شده';
        case 'Cancled':
            return 'لغو شده';
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
        ["#000000", "#FFFFFF"], // Black background, White text
        ["#FFFFFF", "#000000"], // White background, Black text
        ["#FF0000", "#FFFFFF"], // Red background, White text
        ["#00FF00", "#000000"], // Green background, Black text
        ["#0000FF", "#FFFFFF"], // Blue background, White text
        ["#FFFF00", "#000000"], // Yellow background, Black text
        ["#800080", "#FFFFFF"], // Purple background, White text
        ["#FFA500", "#000000"], // Orange background, Black text
        ["#FFC0CB", "#000000"], // Pink background, Black text
        ["#A52A2A", "#FFFFFF"], // Brown background, White text
        ["#808080", "#FFFFFF"], // Gray background, White text
        ["#00FFFF", "#000000"], // Cyan background, Black text
        ["#FF00FF", "#000000"], // Magenta background, Black text
        ["#00FF00", "#000000"], // Lime background, Black text
        ["#800000", "#FFFFFF"], // Maroon background, White text
        ["#000080", "#FFFFFF"], // Navy background, White text
        ["#808000", "#FFFFFF"], // Olive background, White text
        ["#008080", "#FFFFFF"], // Teal background, White text
        ["#00FFFF", "#000000"], // Aqua background, Black text
        ["#FF00FF", "#000000"], // Fuchsia background, Black text
        ["#C0C0C0", "#000000"], // Silver background, Black text
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
            <h4 class="fw-semibold fs-18 mb-sm-0">سرویس ها</h4> 
            
            
            <a href="<?=base_url()?>Service/Add"
                class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                
                <span class="py-sm-1 d-block"> <i class="ri-add-line text-white"></i> <span>افزودن سرویس</span> </span> </a>
        </div>
        <div class="default-table-area my-task-list">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">شناسه</th>
                            <th scope="col">مسافر</th>
                            <th scope="col">راننده</th>
                            <th scope="col">تاریخ سفر</th>
                            <th scope="col">هزینه سفر</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">پرداخت</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>






                        <?php if (isset($Service)): foreach ($Service as $S): ?>
                                <tr class="text-center">
                                    <td class="text-start">
                                        سرویس#<?= $S['service_id'] ?>
                                    </td>

                                    <td>
                                        <span style="background-color: <?= getRandomColorPair()[0]; ?> !important;color:<?= getRandomColorPair()[1]; ?> !important" class="py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block"><?= $S['passenger_name'] ?> <?= $S['passenger_last'] ?></span>
                                    </td>

                                    <td> <img src="<?= base_url() ?>uploads/drivers/ax/<?= $S['driver_photo'] ?>" class="rounded-circle wh-25 cursor" alt="driver" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $S['driver_name'] . ' ' . $S['driver_last'] ?>">
                                    </td>

                                    <td> <span><?= $S['trip_date'] ?></span> </td>
                                    <td> <span><?= number_format($S['price']) ?> تومان</span> </td>

                                    <td>
                                        <span class="bg-success bg-opacity-10 text-success py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block"><?= getServiceStatus($S['service_status']) ?></span>
                                    </td>

                                    <td> <span
                                            class="bg-primary bg-opacity-10 text-primary py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block"><?= getIsPaid($S['isPaid']) ?></span>
                                    </td>



                                    <td>
                                        <div class="dropdown action-opt">
                                            <button class="btn bg p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i data-feather="more-horizontal"></i> </button>
                                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"> <i data-feather="share-2"></i> اشتراک گذاری </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"> <i data-feather="link-2"></i> دریافت لینک </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"> <i data-feather="edit-3"></i>تغییر نام </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"> <i data-feather="download"></i> دانلود </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"> <i data-feather="trash-2"></i> حذف </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                        <?php endforeach;
                        endif; ?>








                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="http://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $(".table").DataTable({
            "order": [
                [2, "desc"]
            ],
            "language": {
                "decimal": "",
                "emptyTable": "موردی یافت نشد",
                "info": "نمایش _START_ از _END_ تا _TOTAL_ مورد",
                "infoEmpty": "نمایش 0 از 0 تا 0 مورد",
                "infoFiltered": "(فیلتر از _MAX_ مورد)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "نمایش _MENU_ مورد",
                "loadingRecords": "بارگذاری...",
                "processing": "آماده سازی...",
                "search": "جستجو:",
                "zeroRecords": "موردی یافت نشد",
                "paginate": {
                    "first": "اولین",
                    "last": "آخرین",
                    "next": "بعدی",
                    "previous": "قبلی"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }

        });
    });
</script>