<div class="col-lg-12">
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="tab-content" id="myTab2Content">
                <div class="tab-pane fade show active" id="preview2-tab-pane" role="tabpanel" aria-labelledby="preview2-tab" tabindex="0">
                    <ul class="nav nav-tabs justify-content-between border-0 mb-4 wizard-tabs2" id="myTabstep2" role="tablist">
                        <li class="nav-item" role="presentation"> <button class="nav-link p-0 d-flex align-items-center active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1-tab-pane" type="button" role="tab" aria-controls="step1-tab-pane" aria-selected="true"> <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                                <div class="text-start ms-3 d-none d-lg-block">
                                    <h4 class="fs-18 fw-semibold">اطلاعات شخصی</h4>
                                    <p class="text-gray-light mb-0">فرم زیر را پر کنید</p>
                                </div>
                            </button> </li>
                        <li class="nav-item" role="presentation"> <button class="nav-link p-0 d-flex align-items-center" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2-tab-pane" type="button" role="tab" aria-controls="step2-tab-pane" aria-selected="false"> <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
                                <div class="text-start ms-3 d-none d-lg-block">
                                    <h4 class="fs-18 fw-semibold">اطلاعات خوردو</h4>
                                    <p class="text-gray-light mb-0">جزئیات دقیق تر</p>
                                </div>
                            </button> </li>
                        <li class="nav-item" role="presentation"> <button class="nav-link p-0 d-flex align-items-center" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3-tab-pane" type="button" role="tab" aria-controls="step3-tab-pane" aria-selected="false"> <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">3</span>
                                <div class="text-start ms-3 d-none d-lg-block">
                                    <h4 class="fs-18 fw-semibold">اسکن مدارک</h4>
                                    <p class="text-gray-light mb-0">احراز هویت</p>
                                </div>
                            </button> </li>
                        <li class="nav-item" role="presentation"> <button class="nav-link p-0 d-flex align-items-center" id="step4-tab" data-bs-toggle="tab" data-bs-target="#step4-tab-pane" type="button" role="tab" aria-controls="step4-tab-pane" aria-selected="false"> <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">4</span>
                                <div class="text-start ms-3 d-none d-lg-block">
                                    <h4 class="fs-18 fw-semibold">تصاویر خودرو</h4>
                                    <p class="text-gray-light mb-0">عکس های داخل و بیرون</p>
                                </div>
                            </button> </li>
                    </ul>
                    <div class="tab-content" id="myTabstep2Content">
                        <div class="tab-pane fade show active" id="step1-tab-pane" role="tabpanel" aria-labelledby="step1-tab" tabindex="0">
                            <form action="<?=base_url()?>OneStep" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-4" bis_skin_checked="1"> <label class="label">جنسیت</label>
                                            <div class="form-group position-relative" bis_skin_checked="1"> <select class="form-select form-control h-58" aria-label="Default select example" name="gender">
                                                    <option selected="" class="text-dark">مرد</option>
                                                    <option value="1" class="text-dark">زن</option>
                                                </select> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">نام</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="نام" name="first_name"> <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">نام خانوادگی</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="نام خانوادگی" name="last_name">
                                                <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">کد ملی</label>
                                            <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-58" placeholder="کد ملی" name="national_id"> <i class="ri-numbers-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">تاریخ تولد</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="تاریخ تولد" name="birthday"> <i class="ri-anticlockwise-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">تلفن منزل</label>
                                            <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-58" placeholder="021XXXXXXXXX" name="phone"> <i class="ri-phone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">رمز عبور</label>
                                            <div class="form-group position-relative"> <input type="password" class="form-control text-dark ps-5 h-58" placeholder="رمز عبور" name="password"> <i class="ri-smartphone-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">موبایل 1</label>
                                            <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-58" placeholder="موبایل" name="mobile"> <i class="ri-smartphone-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">موبایل 2</label>
                                            <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-58" placeholder="موبایل" name="mobile_2"> <i class="ri-cellphone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">میزان تحصیلات</label>
                                            <div class="form-group position-relative">
                                                <select class="form-select form-control h-58" aria-label="Default select example" name="education_level">
                                                    <option value="بدون تحصیلات">بدون تحصیلات</option>
                                                    <option value="سیکل">سیکل</option>
                                                    <option value="دیپلم">دیپلم</option>
                                                    <option value="کاردانی">کاردانی</option>
                                                    <option value="کارشناسی">کارشناسی</option>
                                                    <option value="کارشناسی ارشد">کارشناسی ارشد</option>
                                                    <option value="دکترا">دکترا</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">زبان خارجی</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="زبان خارجی" name="foreign_language"> <i class="ri-global-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-4"> <label class="label">میزان آشنایی با زبان خارجه</label>
                                            <div class="form-group position-relative">
                                                <select  class="form-select form-control h-58" aria-label="Default select example" name="foreign_language_proficiency">
                                                    <option value="-" class="text-dark">-</option>
                                                    <option value="مبتدی">مبتدی</option>
                                                    <option value="متوسط">متوسط</option>
                                                    <option value="پیشرفته">پیشرفته</option>
                                                    <option value="مسلط">مسلط</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-9">
                                        <div class="form-group mb-4"> <label class="label">آدرس</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="آدرس" name="address"> <i class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group mb-4"> <label class="label">کد پستی</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="کد پستی" name="postal_code"> <i class="ri-mail-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-6">
                                        <div class="form-group mb-4" bis_skin_checked="1"> <label class="label">نوع همکاری</label>
                                            <div class="form-group position-relative" bis_skin_checked="1">
                                                <select class="form-select form-control h-58" aria-label="Default select example" name="cooperation_type">
                                                    <option selected="" class="text-dark">شخصی</option>
                                                    <option value="1" class="text-dark">شرکتی</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4"> <label class="label">شماره کارت بانکی</label>
                                            <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-58" placeholder="شماره کارت بدون فاصله وارد کنید" name="bank_card_number"> <i class="ri-bank-card-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4"> <label class="label">شماره شبا</label>
                                            <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-58" placeholder="با IR بنویسید" name="iban"> <i class="ri-bank-card-2-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4"> <label class="label">یادداشت :</label>
                                            <div class="form-group position-relative"> <textarea class="form-control ps-5 text-dark" placeholder="چند متن  ... " cols="30" rows="5" name="notes"></textarea> <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group d-flex gap-3">
                                            <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0 prev-tab" data-bs-target="#step2-tab-pane" type="button"> قبلی</button>
                                            <button class="btn btn-primary py-3 px-5 fw-semibold text-white next-tab" data-bs-target="#step2-tab-pane" type="button"> بعدی</button>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="step2-tab-pane" role="tabpanel" aria-labelledby="step2-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-2"> </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4"> <label class="label">پلاک</label>
                                        <div class="input-group h-58 form-control p-0" bis_skin_checked="1">
                                            <div class="input-group-text rounded-10 px-3" bis_skin_checked="1"> ایران </div>
                                            <input class="form-control h-auto border-0 text-dark" placeholder="--" style="letter-spacing: 10px !important;    text-align: center;" name="plate_part1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4"> <label class="label">&ensp;</label>
                                        <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-58" placeholder="---" style="letter-spacing: 10px !important;    text-align: center;" name="plate_part2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4"> <label class="label">&ensp;</label>
                                        <div class="form-group position-relative"> <select class="form-select form-control ps-5 h-58" aria-label="Default select example" name="plate_letter">
                                                <option value="الف">الف</option>
                                                <option value="ب">ب</option>
                                                <option value="پ">پ</option>
                                                <option value="ت">ت</option>
                                                <option value="ث">ث</option>
                                                <option value="ج">ج</option>
                                                <option value="د">د</option>
                                                <option value="ز">ز</option>
                                                <option value="س">س</option>
                                                <option value="ش">ش</option>
                                                <option value="ص">ص</option>
                                                <option value="ط">ط</option>
                                                <option value="ع">ع</option>
                                                <option value="ف">ف</option>
                                                <option value="ق">ق</option>
                                                <option value="ک">ک</option>
                                                <option value="گ">گ</option>
                                                <option value="ل">ل</option>
                                                <option value="م">م</option>
                                                <option value="ن">ن</option>
                                                <option value="و">و</option>
                                                <option value="ه">ه</option>
                                                <option value="ی">ی</option>
                                                <option value="معلولین">معلولین</option>
                                                <option value="تشریفات">تشریفات</option>
                                            </select> <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4"> <label class="label">&ensp;</label>
                                        <div class="input-group h-58 form-control p-0" bis_skin_checked="1">
                                            <input type="number" class="form-control h-auto border-0 text-dark" placeholder="--" style="letter-spacing: 25px !important;    text-align: center;" name="plate_part3">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">نام مالک خودرو</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control ps-5 text-gray-light h-58" placeholder="نام مالک خودرو" name="owner">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">&ensp;</label>
                                        <div class="form-group position-relative"> <select class="brand" style="width: 100%;" name="brand">

                                        <option disabled selected>برند خودرو</option>

                                                <?php foreach ($Brands as $B): ?>
                                                    <option value="<?=$B['TiD']?>"><?=$B['brand']?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>
                                    </div>
                                </div>







                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">&ensp;</label>
                                        <div class="form-group position-relative"> <select class="chosen" style="width: 100%;" name="type">

                                        <option disabled selected>تیپ خودرو</option>



                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">سال ساخت</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control ps-5 text-gray-light h-58" placeholder="سال ساخت" name="year">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">رنگ خودرو</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control ps-5 text-gray-light h-58" placeholder="رنگ خودرو" name="color">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">نوع سوخت</label>
                                        <div class="form-group position-relative"> <select class="form-select form-control ps-5 h-58" aria-label="Default select example" name="fuel_type">
                                                <option value="بنزینی">بنزینی</option>
                                                <option value="گاز سوز">گاز سوز</option>
                                                <option value="گازوئیل">گازوئیل</option>
                                                <option value="دوگانه سوز">دوگانه سوز</option>
                                                <option value="هیبریدی">هیبریدی</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>






                                <div class="col-lg-6">
                                    <div class="form-group mb-4"> <label class="label">شناسه VIN</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control ps-5 text-gray-light h-58" placeholder="شناسه VIN" name="vin"> <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">تاریخ اعتبار بیمه</label>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control ps-5 text-gray-light h-58" placeholder="تاریخ اعتبار بیمه" name="insurance_expiry_date">
                                            <i class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0 prev-tab" data-bs-target="#step1-tab-pane" type="button"> قبلی</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white next-tab" data-bs-target="#step3-tab-pane" type="button"> بعدی</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="step3-tab-pane" role="tabpanel" aria-labelledby="step3-tab" tabindex="0">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر سلفی از چهره </label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="ax">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر کارت ملی</label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="scan_melli">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر گواهینامه</label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="scan_govahiname">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0 prev-tab" data-bs-target="#step3-tab-pane" type="button"> قبلی</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white next-tab" data-bs-target="#step4-tab-pane" type="button"> بعدی</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="step4-tab-pane" role="tabpanel" aria-labelledby="step4-tab" tabindex="0">
                            <p class="text-gray-light mb-4">عکسها را طبق نمونه و با کیفیت بارگذاری کنید . به عکسهای غیر از نمونه ترتیب اثر داده نخواهد شد</p>

                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="row" style="margin-bottom:50px">
                                        <div class="col-lg-3">
                                            <div class="image-container">
                                                <img src="<?=base_url()?>assets/images/front.jpg" class="img-fluid" alt="Front View">
                                            </div>
                                            <p class="text-center mt-2">تصویر جلو</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="image-container">
                                                <img src="<?=base_url()?>assets/images/back.jpg" class="img-fluid" alt="Back View">
                                            </div>
                                            <p class="text-center mt-2">تصویر عقب</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="image-container">
                                                <img src="<?=base_url()?>assets/images/in_back.jpg" class="img-fluid" alt="Interior Back View">
                                            </div>
                                            <p class="text-center mt-2">تصویر فضای داخلی پشت</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="image-container">
                                                <img src="<?=base_url()?>assets/images/in_front.jpg" class="img-fluid" alt="Interior Front View">
                                            </div>
                                            <p class="text-center mt-2">تصویر از فضای داخلی جلو</p>
                                        </div>
                                    </div>

<style>
    .image-container {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
                                </div>
                                </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر جلوی خودرو ( نمای جلو با پالک و بغل ماشین در 1 عکس واضح)</label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="pic_back">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر جلو خودرو</label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="pic_front">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر داخلی پشت خودرو</label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="pic_in_back">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">تصویر داخلی جلو خودرو</label>
                                        <div class="form-group position-relative">
                                            <input type="file" class="form-control text-dark ps-5 h-58" name="pic_in_front">
                                            <i class="ri-user-3-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0 prev-tab" data-bs-target="#step3-tab-pane" type="button"> قبلی</button>
                                        <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white next-tab">ارسال</button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="type_class" value="" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        height: 40px;
    }

    .chosen-container.chosen-container-single {
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
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?=base_url()?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/chosen/chosen.min.css" />
<script>
    $(document).ready(function() {
        $('.next-tab').click(function() {
            var target = $(this).data('bs-target');
            $('.nav-link[data-bs-target="' + target + '"]').tab('show');
        });

        $('.prev-tab').click(function() {
            var activeTab = $('.nav-link.active');
            var prevTab = activeTab.parent().prev().find('.nav-link');
            if (prevTab.length) {
                prevTab.tab('show');
            }
        });

        $(".brand").chosen();
        $(".chosen").chosen();
    });
</script>




<script>
        $(document).ready(function() {
            $('.brand').on('change', function() {
                var brandId = $(this).val();
                $.ajax({
                    url: '<?=base_url()?>GetBrandCars/'+brandId,
                    type: 'GET',
                    success: function(response) {
                        var typeSelect = $('select[name="type"]');
                        typeSelect.empty();
                        typeSelect.append('<option disabled selected>تیپ خودرو</option>');
                        $.each(response, function(index, carType) {
                            typeSelect.append('<option data-class="' + carType.type_class + '" value="' + carType.bid + '">' + carType.type_name + '</option>');
                        });
                        typeSelect.trigger("chosen:updated");
                    }
                });
            });
        });



        $('select[name="type"]').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var typeClass = selectedOption.data('class');
            $('input[name="type_class"]').val(typeClass);
        });



    </script>

<link rel="stylesheet" href="https://behzadi.github.io/persianDatepicker/css/persianDatepicker-default.css" />
    <script src="https://behzadi.github.io/persianDatepicker/js/persianDatepicker.js"></script>
    <script>
        $("input[name='birthday']").persianDatepicker();
        $("input[name='insurance_expiry_date']").persianDatepicker();
    </script>