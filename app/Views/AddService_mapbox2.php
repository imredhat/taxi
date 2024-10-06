<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">

</div>




<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">

        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">افزودن سرویس </h4>
        </div>


        <div class="tab-content" id="myTab2Content">
            <div class="tab-pane fade show active" id="preview2-tab-pane" role="tabpanel" aria-labelledby="preview2-tab" tabindex="0">

                <div class="tab-content" id="myTabstep2Content">
                    <div class="tab-pane fade show active" id="step1-tab-pane" role="tabpanel" aria-labelledby="step1-tab" tabindex="0">
                        <form action="<?= base_url() ?>OneStep" method="post" enctype="multipart/form-data">
                            <div class="row">


                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">مسافر</label>
                                        <div class="form-group position-relative"> <select class="chosen" style="width: 100%;" name="brand" data-placeholder="انتخاب مسافر">

                                                <?php foreach ($Users as $B) : ?>
                                                    <option value=""></option>
                                                    <option value="<?= $B['id'] ?>"><?= $B['name'] . ' ' . $B['lname'] ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">راننده</label>
                                        <div class="form-group position-relative"> <select class="chosen" id="driver" style="width: 100%;" name="driver" data-placeholder="راننده را انتخاب کنید">

                                                <?php foreach ($Drivers as $D) : ?>
                                                    <option value=""></option>
                                                    <option value="<?= $D['did'] ?>"><?= $D['name'] . ' ' . $D['lname'] ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">خودرو</label>
                                        <div class="form-group position-relative"> <select class="chosen" id="Cars" style="width: 100%;" name="driver" data-placeholder="خودرو را انتخاب کنید">

                                                <option value=""></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>






                                <div class="col-lg-12">
                                    <div class="form-group mb-4" bis_skin_checked="1"> <label class="label"> انتخاب مبدا و مقصد</label>
                                        <div class="form-group position-relative" bis_skin_checked="1">
                                            <div style="height: 550px;position: relative;" id="map" ></div>
                                            <button id="reset-btn">ریست</button> <!-- دکمه ریست -->




                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group mb-4"><img src="<?=base_url()?>assets/images/top-view-winding-car-road-grass-bushes_107791-10321.avif" />
                                    </div>
                               </div>
                                
                                



                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">نام</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-15" placeholder="نام" name="first_name"> <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">نام خانوادگی</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-15" placeholder="نام خانوادگی" name="last_name">
                                            <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4"> <label class="label">موبایل</label>
                                        <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-15" placeholder="موبایل" name="mobile"> <i class="ri-smartphone-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="form-group mb-4"> <label class="label">آدرس</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-15" placeholder="آدرس" name="address"> <i class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4"> <label class="label">کد ملی</label>
                                        <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-15" placeholder="کد ملی" name="national_id"> <i class="ri-numbers-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4"> <label class="label">شماره کارت بانکی</label>
                                        <div class="form-group position-relative"> <input type="number" class="form-control text-dark ps-5 h-15" placeholder="شماره کارت بدون فاصله وارد کنید" name="bank_card_number"> <i class="ri-bank-card-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4"> <label class="label">شماره شبا</label>
                                        <div class="form-group position-relative"> <input type="text" class="form-control text-dark ps-5 h-15" placeholder="با IR بنویسید" name="iban"> <i class="ri-bank-card-2-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
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
        padding: 10px !important;
        height: 40px !important;
        font-size: 15px;
    }

    li.active-result {
        font-size: 16px;
        padding: 10px !important;
    }

    b {
        margin-top: 10px;
        margin-right: 5px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/chosen/chosen.min.css" />
<script>



    $(document).ready(function() {


  

        $(".chosen").chosen();



        $("#driver").on('change', function() {
            var driverId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?=base_url() ?>"+'Service/GetDriverCarList',
                data: {
                    driver_id: driverId
                },
                success: function(data) {
                    var carsHtml = '';
                    data = JSON.parse(data)
                    $.each(data, function(index, car) {
                        carsHtml += '<option value="' + car.cid + '">' + car.car_brand + ' | ایران ' + car.iran + car.harf + car.pelak + car.pelak_last + '</option>';
                    });
                    $('#Cars').html(carsHtml);
                    $('#Cars').trigger('chosen:updated');
                }
            });
        });
    });
</script>








    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js"></script>
    <style>
        #map { width: 100%; height: 800px; margin: 0 auto; }
        .mapboxgl-ctrl-geocoder { margin: 10px; }
        #reset-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        #reset-btn:hover {
            background-color: #ff1a1a;
        }
    </style>




<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoicmVkaGF0NSIsImEiOiJjazV1cDdramoweDQwM2hsbzdqeGg2eXJwIn0.rE2Vf8qf_hAr3ZN2uAlQuw';

    // فعال کردن پلاگین RTL
    mapboxgl.setRTLTextPlugin(
        "https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js",
        null,
        true
    );

    // ایجاد نقشه
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11', // استفاده از استایل نقشه فارسی
        center: [51.3890, 35.6892], // مختصات تهران
        zoom: 12
    });

    // افزودن کنترل جستجو
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        placeholder: "منطقه را جستجو کنید",
        mapboxgl: mapboxgl
    });
    map.addControl(geocoder, 'top-left');

    let startPoint = null;
    let endPoint = null;
    let startMarker = null;
    let endMarker = null;

    // افزودن مارکر قابل جابجایی
    function addDraggableMarker(lngLat, color, isStartPoint) {
        const marker = new mapboxgl.Marker({
            color: color,
            draggable: true
        })
        .setLngLat(lngLat)
        .addTo(map);

        marker.on('dragend', () => {
            const newLngLat = marker.getLngLat();
            if (isStartPoint) {
                startPoint = [newLngLat.lng, newLngLat.lat];
            } else {
                endPoint = [newLngLat.lng, newLngLat.lat];
            }
            checkRoute();
        });

        return marker;
    }

    // انتخاب نقطه با کلیک روی نقشه
    map.on('click', (e) => {
        const coordinates = [e.lngLat.lng, e.lngLat.lat];
        if (!startPoint) {
            // اگر نقطه شروع هنوز انتخاب نشده باشد
            if (startMarker) startMarker.remove();
            startPoint = coordinates;
            startMarker = addDraggableMarker(startPoint, 'green', true);
            console.log(`نقطه شروع انتخاب شد: ${startPoint}`);
        } else if (!endPoint) {
            // اگر نقطه شروع انتخاب شده و نقطه پایان انتخاب نشده باشد
            if (endMarker) endMarker.remove();
            endPoint = coordinates;
            endMarker = addDraggableMarker(endPoint, 'red', false);
            console.log(`نقطه پایان انتخاب شد: ${endPoint}`);
            checkRoute();  // بعد از انتخاب مقصد، مسیر نمایش داده شود
        } else {
            // اگر هر دو نقطه قبلاً انتخاب شده‌اند
            console.log("هر دو نقطه قبلاً انتخاب شده‌اند. ابتدا یکی را جابجا کنید.");
        }
    });

    // محاسبه و نمایش مسیر
    function checkRoute() {
        if (startPoint && endPoint) {
            const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${startPoint[0]},${startPoint[1]};${endPoint[0]},${endPoint[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const route = data.routes[0].geometry;
                    const distance = data.routes[0].distance / 1000; // به کیلومتر
                    let duration = data.routes[0].duration / 60; // به دقیقه

                    console.log(`مسافت: ${distance.toFixed(2)} کیلومتر`);
                    console.log(`زمان تقریبی: ${formatDuration(duration)}`);

                    if (map.getSource('route')) {
                        map.removeLayer('route');
                        map.removeSource('route');
                    }

                    map.addSource('route', {
                        type: 'geojson',
                        data: {
                            type: 'Feature',
                            geometry: route
                        }
                    });
                    map.addLayer({
                        id: 'route',
                        type: 'line',
                        source: 'route',
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': '#3887be',
                            'line-width': 5,
                            'line-opacity': 0.75
                        }
                    });

                    const bounds = turf.bbox(route);
                    map.fitBounds(bounds, { padding: 20 });
                });
        }
    }

    // فرمت زمان براساس دقیقه، ساعت و روز
    function formatDuration(duration) {
        if (duration < 60) {
            return `${duration.toFixed(0)} دقیقه`;
        } else if (duration < 1440) {
            const hours = Math.floor(duration / 60);
            const minutes = duration % 60;
            return `${hours} ساعت و ${minutes.toFixed(0)} دقیقه`;
        } else {
            const days = Math.floor(duration / 1440);
            const hours = Math.floor((duration % 1440) / 60);
            const minutes = duration % 60;
            return `${days} روز و ${hours} ساعت و ${minutes.toFixed(0)} دقیقه`;
        }
    }

    // تابع ریست کردن نقاط و مسیر
    function resetMarkers() {
        if (startMarker) startMarker.remove();
        if (endMarker) endMarker.remove();
        if (map.getSource('route')) {
            map.removeLayer('route');
            map.removeSource('route');
        }
        startPoint = null;
        endPoint = null;
        startMarker = null;
        endMarker = null;
        console.log("نقاط و مسیر ریست شد.");
    }

    // افزودن event listener به دکمه ریست
    document.getElementById('reset-btn').addEventListener('click', resetMarkers);

</script>

