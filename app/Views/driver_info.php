<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اطلاعات راننده و خودرو</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
        direction: rtl;
        text-align: right;
    }

    .driver-info,
    .car-info {
        margin-bottom: 30px;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .driver-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .car-photos img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Driver Information Section -->
        <div class="driver-info text-center">
            <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$Driver['ax']?>" alt="عکس راننده"
                class="driver-photo" style="width: 100%; height: 100%; object-fit: cover;">
            <h3 class="mt-3">
                <span class="border-color-gray" style="font-size: 13px;">
                    <?php if ($Driver['gender'] == 'مرد') {
    echo 'جناب آقای';
        } else {
            echo 'سرکار خانم';
        }?>

                </span>

                <?=$Driver['name'] . ' ' . $Driver['lname']?>
            </h3>
            <div class="row mt-4">
                

            <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>کد راننده</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center">
                            <?php
                            
                            require_once APPPATH.'Libraries/jdf.php'; 

                            $date_created = new DateTime($Driver['date_created']);
                            $gregorian_date = explode('-', $date_created->format('Y-m-d'));
                            $persian_date_array = gregorian_to_jalali($gregorian_date[0], $gregorian_date[1], $gregorian_date[2]);
                            $persian_date = implode('', $persian_date_array); 

                            $driver_code = $persian_date . '-' . (1000 + $Driver['did']);
                            echo $driver_code;
                            ?>
                        </span>
                    </div>
                </li> 
        
            
            <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>موبایل</span>
                    <div class="d-flex align-content-center">
                        <span
                            class="fs-14 d-flex align-items-center"><?=$Driver['mobile']?><?php if (!empty($Driver['mobile2'])) {echo " | " . $Driver['mobile2'];}?></span>
                    </div>
                </li>
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>آدرس</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['address']?></span>
                    </div>
                </li>

                
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>کد پستی</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['postal_code']?></span>
                    </div>
                </li>

                <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>تلفن منزل                    </span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['phone']?></span>
                    </div>
                </li>
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>سطح تحصیلات</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['education_level']?></span>
                    </div>
                </li>
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>زبان خارجی</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['foreign_language']?></span>
                    </div>
                </li>
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>میزان تسلط به زبان خارجی</span>
                    <div class="d-flex align-content-center">
                        <span
                            class="fs-14 d-flex align-items-center"><?=$Driver['foreign_language_proficiency']?></span>
                    </div>
                </li>

                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>تاریخ تولد</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['birthday']?></span>
                    </div>
                </li>
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>کد ملی</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['melli']?></span>
                    </div>
                </li>

                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>شماره کارت</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['bank']?></span>
                    </div>
                </li>
                <li
                    class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                    <span>شماره شبا</span>
                    <div class="d-flex align-content-center">
                        <span class="fs-14 d-flex align-items-center"><?=$Driver['shaba']?></span>
                    </div>
                </li>
            </div>


            <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                <span>کارت ملی</span>
                <div class="d-flex align-content-center">
                    <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$Driver['scan_melli']?>"
                    data-bs-toggle="modal" data-bs-target="#scanModal">
                        <img style="width: 50px;"
                            src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$Driver['scan_melli']?>"
                            alt="اسکن کارت ملی" class="img-fluid" style="max-width: 100px;">
                    </a>
                </div>
            </li>


            <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                <span>گواهینامه</span>
                <div class="d-flex align-content-center">
                    <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$Driver['scan_govahiname']?>"
                    data-bs-toggle="modal" data-bs-target="#scanModal">
                        <img style="width: 50px;"
                            src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$Driver['scan_govahiname']?>"
                            alt="اسکن گواهینامه" class="img-fluid" style="max-width: 100px;">
                    </a>
                </div>
            </li>


      

        </div>

        <!-- Car Information Section -->
        <?php foreach ($cars as $car): ?>
        <div class="card mt-5">
            <div class="card-header">
                جزئیات خودرو <?=$car['brand']?> <?=$car['type_name']?>
            </div>



            <style>
            .carousel-item img {
                height: 400px;
                object-fit: cover;
            }
            </style>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 car-photos">
                        <div id="carPhotosCarousel<?=$car['cid']?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_back']?>"
                                        target="_blank">
                                        <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_back']?>"
                                            class="d-block w-100" alt="عکس پشت خودرو">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_front']?>"
                                        target="_blank">
                                        <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_front']?>"
                                            class="d-block w-100" alt="عکس جلوی خودرو">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_in_back']?>"
                                        target="_blank">
                                        <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_in_back']?>"
                                            class="d-block w-100" alt="عکس داخل پشت خودرو">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_in_front']?>"
                                        target="_blank">
                                        <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_in_front']?>"
                                            class="d-block w-100" alt="عکس داخل جلوی خودرو">
                                    </a>
                                </div>
                            </div>
                            <br /><br />

                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carPhotosCarousel<?=$car['cid']?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">بعدی</span>
                            </button>
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carPhotosCarousel<?=$car['cid']?>"
                                    data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                                    <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_back']?>"
                                        class="d-block " alt="عکس پشت خودرو" style="width: 50px; height: 30px;">
                                </button>
                                <button type="button" data-bs-target="#carPhotosCarousel<?=$car['cid']?>"
                                    data-bs-slide-to="1" aria-label="Slide 2">
                                    <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_front']?>"
                                        class="d-block " alt="عکس جلوی خودرو" style="width: 50px; height: 30px;">
                                </button>
                                <button type="button" data-bs-target="#carPhotosCarousel<?=$car['cid']?>"
                                    data-bs-slide-to="2" aria-label="Slide 3">
                                    <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_in_back']?>"
                                        class="d-block w-100" alt="عکس داخل پشت خودرو"
                                        style="width: 50px; height: 30px;">
                                </button>
                                <button type="button" data-bs-target="#carPhotosCarousel<?=$car['cid']?>"
                                    data-bs-slide-to="3" aria-label="Slide 4">
                                    <img src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['pic_in_front']?>"
                                        class="d-block w-100" alt="عکس داخل جلوی خودرو"
                                        style="width: 50px; height: 30px;">
                                </button>
                            </div>
                        </div>


                    </div>


                    <div class="col-md-6">

                    <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                        <span>برند</span>
                        <div class="d-flex align-content-center">
                            <span class="fs-14 d-flex align-items-center"><?=$car['brand']?></span>
                        </div>
                    </li>



                        <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10"
                            style="direction: rtl;">
                            <span>پلاک</span>
                            <div class="d-flex align-content-center">
                                <div class="fs-14 d-flex align-items-center" style="direction: rtl;">
                                    ایران <?=$car['iran']?> <?=$car['pelak']?> <?=$car['harf']?> <?=$car['pelak_last']?>
                                </div>
                            </div>
                        </li>

                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>نام مالک خودرو</span>
                            <div class="d-flex align-content-center">
                                <span class="fs-14 d-flex align-items-center"><?=$car['owner']?></span>
                            </div>
                        </li>

                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>سال</span>
                            <div class="d-flex align-content-center">
                                <span class="fs-14 d-flex align-items-center"><?=$car['year']?></span>
                            </div>
                        </li>


                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>رنگ</span>
                            <div class="d-flex align-content-center">
                                <span class="fs-14 d-flex align-items-center"><?=$car['color']?></span>
                            </div>
                        </li>

                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>نوع سوخت</span>
                            <div class="d-flex align-content-center">
                                <span class="fs-14 d-flex align-items-center"><?=$car['fuel']?></span>
                            </div>
                        </li>



                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>شناسه VIN</span>
                            <div class="d-flex align-content-center">
                                <span class="fs-14 d-flex align-items-center"><?=$car['vin']?></span>
                            </div>
                        </li>
                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>تاریخ انقضای بیمه</span>
                            <div class="d-flex align-content-center">
                                <span class="fs-14 d-flex align-items-center"><?=$car['insurance_expiry_date']?></span>
                            </div>
                        </li>

                        <li
                            class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                            <span>کارت ماشین</span>
                            <div class="d-flex align-content-center">
                                <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_car_card']?>"
                                data-bs-toggle="modal" data-bs-target="#scanModal">
                                    <img style="width: 50px;"
                                        src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_car_card']?>"
                                        alt="اسکن کارت ماشین" class="img-fluid" style="max-width: 100px;">
                                </a>
                            </div>
                        </li>


                    <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                        <span>تصویر پشت کارت ماشین</span>
                        <div class="d-flex align-content-center">
                            <?php if (isset($car['scan_car_card_back']) && !empty($car['scan_car_card_back'])): ?>
                                <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_car_card_back']?>" data-bs-toggle="modal" data-bs-target="#scanModal">
                                    <img style="width: 50px;" src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_car_card_back']?>" alt="تصویر پشت کارت ماشین" class="img-fluid" style="max-width: 100px;">
                                </a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                        <span>تصویر بیمه ماشین</span>
                        <div class="d-flex align-content-center">
                            <?php if (isset($car['scan_insurance']) && !empty($car['scan_insurance'])): ?>
                                <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_insurance']?>" data-bs-toggle="modal" data-bs-target="#scanModal">
                                    <img style="width: 50px;" src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_insurance']?>" alt="تصویر بیمه ماشین" class="img-fluid" style="max-width: 100px;">
                                </a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="d-flex justify-content-between align-items-center border-bottom border-color-gray pb-10 mb-10">
                        <span>تصویر الحاقیه بیمه</span>
                        <div class="d-flex align-content-center">
                            <?php if (isset($car['scan_insurance_addendum']) && !empty($car['scan_insurance_addendum'])): ?>
                                <a href="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_insurance_addendum']?>" data-bs-toggle="modal" data-bs-target="#scanModal">
                                    <img style="width: 50px;" src="<?=base_url()?>uploads/drivers/<?=$Driver['did']?>/<?=$car['scan_insurance_addendum']?>" alt="تصویر الحاقیه بیمه" class="img-fluid" style="max-width: 100px;">
                                </a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <!-- Lightbox Modal for Scans -->
                    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <img src="" id="scanImage" class="img-fluid mt-2" alt="تصویر">
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    document.querySelectorAll('[data-bs-target="#scanModal"]').forEach(function(element) {
                        element.addEventListener('click', function() {
                            var src = this.getAttribute('href');
                            document.querySelector('#scanModal img').setAttribute('src', src);
                        });
                    });
                    </script>

                    </div>

                </div>

            </div>




            <!-- Lightbox Modal for Scan Car Card -->
            <div class="modal fade" id="scanCarCardModal" tabindex="-1" aria-labelledby="scanCarCardModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="" id="scanCarCardImage" class="img-fluid" alt="اسکن کارت ماشین">
                        </div>
                    </div>
                </div>
            </div>

            <script>
            document.querySelector('[data-bs-target="#scanCarCardModal"]').addEventListener('click', function() {
                var src = this.getAttribute('href');
                document.querySelector('#scanCarCardModal img').setAttribute('src', src);
            });
            </script>
        </div>

        <?php endforeach;?>





        <script>
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(element) {
            element.addEventListener('click', function() {
                var target = this.getAttribute('data-bs-target');
                var src = this.getAttribute('href');
                document.querySelector(target + ' img').setAttribute('src', src);
            });
        });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>