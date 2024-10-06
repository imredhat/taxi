
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
                                    <div class="form-group mb-4" bis_skin_checked="1"> <label class="label">انتخاب مبدا</label>
                                        <div class="form-group position-relative" bis_skin_checked="1">
                                            <div style="    height: 550px;position: relative;;" id="map" ></div>



                                        </div>
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
                url: "<?= base_url() ?>Service/GetDriverCarList",
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






    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>


    <script>
        var map = L.map('map').setView([36.5381485, 52.6753341], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ' '
        }).addTo(map);

        var startMarker, endMarker, routeControl;

        map.on('click', function(e) {
            var coord = e.latlng;
            var lat = coord.lat;
            var lng = coord.lng;
            console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng);

            if (!startMarker) {
                startMarker = L.marker([lat, lng]).addTo(map).bindPopup('Start Point').openPopup();
            } else if (!endMarker) {
                endMarker = L.marker([lat, lng]).addTo(map).bindPopup('End Point').openPopup();
                showRoute();
            } else {
                // Reset markers and route
                map.removeLayer(startMarker);
                map.removeLayer(endMarker);
                if (routeControl) {
                    map.removeControl(routeControl);
                }
                startMarker = L.marker([lat, lng]).addTo(map).bindPopup('Start Point').openPopup();
                endMarker = null;
            }
        });

        function showRoute() {
            if (startMarker && endMarker) {
                routeControl = L.Routing.control({
                    waypoints: [
                        startMarker.getLatLng(),
                        endMarker.getLatLng()
                    ],
                    routeWhileDragging: true,
                    createLine: function(waypoints) {
                        return L.Routing.line(waypoints, {
                            styles: [{color: 'blue', weight: 2,smoothFactor: 1}] // Thicker line with weight 8
                        });
                    }
                }).addTo(map);
                

                routeControl.on('routesfound', function(e) {
                    var routes = e.routes;
                    var summary = routes[0].summary;
                    var distance = summary.totalDistance / 1000; // in kilometers
                    var time = summary.totalTime / 3600; // in hours
                    console.log("Total distance: " + distance.toFixed(2) + " km");
                    console.log("Estimated time: " + time.toFixed(2) + " hours");
                });
            }
        }

        // Add search control
        const provider = new window.GeoSearch.OpenStreetMapProvider();
        const searchControl = new window.GeoSearch.GeoSearchControl({
            provider: provider,
            style: 'bar',
            autoComplete: true,
            autoCompleteDelay: 250,
        });
        map.addControl(searchControl);

        // Move map to search result location
        searchControl.on('resultselected', function(e) {
            var lat = e.location.y;
            var lng = e.location.x;
            map.setView([lat, lng], 17);
        });
    </script>
