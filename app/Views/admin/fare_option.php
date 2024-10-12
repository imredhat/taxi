<?php

$array['options'] = $options;

// echo "<pre>";
// print_r($array);
// die();

function findRateByKey($array, $key)
{


    // Loop through the main options array
    foreach ($array['options'] as $option) {
        // Handle level 1 elements like 'pp_km' and 'isHoliday'
        if (in_array($option['option'], ['pp_km', 'isHoliday'])) {
            if ($option['option'] === $key) {
                return $option['rate']; // Return the value directly from the 'rate' field
            }
        }

        // Handle level 2 elements where 'rate' is a JSON string
        if (isset($option['rate'])) {
            // Try to decode the 'rate' if it's a JSON string
            $rates = json_decode($option['rate'], true);

            // If decoding is successful and it is an array
            if (is_array($rates) && array_key_exists($key, $rates)) {
                return $rates[$key];
                // Return the value of the matching key
            }
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
                                    <label class="label">قیمت به ازای هر کیلومتر</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="price_per_km" placeholder="قیمت به ازای هر کیلومتر" value="<?= findRateByKey($array, 'pp_km'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ روز تعطیل</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="holiday_rate" placeholder="قیمت به ازای هر کیلومتر" value="<?= findRateByKey($array, 'isHoliday'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom pb-3 mb-3">
                                <p class="fs-15">نرخ خودرو ها</p>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ ECO</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="eco_rate" placeholder="ECO" value="<?= findRateByKey($array, 'eco_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ ECO+</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="eco_plus_rate" placeholder="ECO+" value="<?= findRateByKey($array, 'eco_plus_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ VIP</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="vip_rate" placeholder="VIP" value="<?= findRateByKey($array, 'vip_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ VIP+</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="vip_plus_rate" placeholder="VIP+" value="<?= findRateByKey($array, 'vip_plus_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">نرخ VIP SUV</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="vip_suv_rate" placeholder="VIP SUV" value="<?= findRateByKey($array, 'vip_suv_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom pb-3 mb-3">
                                <p class="fs-15">نرخ وضعیت جوی</p>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">آفتابی</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="sunny_rate" placeholder="آفتابی" value="<?= findRateByKey($array, 'sunny_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">بارانی</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="rainy_rate" placeholder="بارانی" value="<?= findRateByKey($array, 'rainy_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">برفی</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="snowy_rate" placeholder="برفی" value="<?= findRateByKey($array, 'snowy_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom pb-3 mb-3">
                                <p class="fs-15">نرخ وضعیت جاده</p>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">عادی</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="normal_road_rate" placeholder="عادی" value="<?= findRateByKey($array, 'normal_road_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">اتوبان خوب</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="good_highway_rate" placeholder="اتوبان خوب" value="<?= findRateByKey($array, 'good_highway_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">اتوبان با جاده بد</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="bad_highway_rate" placeholder="اتوبان با جاده بد" value="<?= findRateByKey($array, 'bad_highway_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">خاکی خوب</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="good_dirt_road_rate" placeholder="خاکی خوب" value="<?= findRateByKey($array, 'good_dirt_road_rate'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">خاکی بد</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="bad_dirt_road_rate" placeholder="خاکی بد" value="<?= findRateByKey($array, 'bad_dirt_road_rate'); ?>">
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