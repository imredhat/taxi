<?php

$array['options'] = $options;

// echo "<pre>";
// print_r($array);
// die();

function findRateByKey($array, $key)
{


    // Loop through the main options array
    foreach ($array['options'] as $option) {

        if ($option['option'] === $key) {
            return $option['rate']; // Return the value directly from the 'rate' field
        }
    }


    // If the key was not found
    return "Key not found.";
}




?>

<form action="<?= base_url() ?>Option/saveSettings" method="post">

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">تنظیمات</h4>

                    <div class="border-bottom pb-3 mb-3">
                        <h4 class="fs-18 fw-semibold mb-1"></h4>
                        <p class="fs-15">اطلاعات زیر مربوط به محاسبات کرایه میباشد</p>
                    </div>
                    <form>
                        <div class="row">

                          
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ روز تعطیل</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="isHoliday" placeholder="ضریب روز های تعطیل" value="<?= findRateByKey($array, 'isHoliday'); ?>">
                                    </div>
                                </div>
                            </div>

                          

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">قیمت به ازای هر مسافر اضافه</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="extraPassenger" placeholder="قیمت به ازای هر مسافر اضافه" value="<?= findRateByKey($array, 'extraPassenger'); ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">قیمت به ازای هر کیلومتر جاده بد یا خاکی</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="bad_road" placeholder="قیمت به ازای هر کیلومتر جاده بد یا خاکی" value="<?= findRateByKey($array, 'bad_road'); ?>">
                                    </div>
                                </div>
                            </div>




                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button class="btn btn-primary py-3 px-5 fw-semibold text-white">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>