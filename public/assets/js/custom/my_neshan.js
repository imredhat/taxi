
// آرایه گلوبال برای ذخیره اطلاعات مهم
let startMarker, endMarker, routeLine;
let tripData = {
    startPoint: null,
    endPoint: null,
    distance: null,
    travelTime: null,
    toll: null,
    startAdd: null,
    endAdd: null,
    roadCondition: null,
    weather: null,
    carType: null
};

let no = 0;
initiate();

function initiate() {
    $(".factor").empty();
    $(".package:first-child").addClass("package_selected");
    var currentPackage = $(".package_selected").data("name");
    tripData.Packgae = currentPackage;

}


$(document).ready(function () {

    $("body").attr("sidebar-data-theme", "sidebar-hide");
    $(".leaflet-control-container").next("div").hide();
    $(".leaflet-bottom.leaflet-right").hide();


    height = self.innerHeight - 170
    $("#map").css("height", height);

    // API Key نشان که از پنل خود دریافت کرده‌اید
    const API_KEY = 'web.840318dd773d4122a1d07e932344af55';
    const Service_KEY = 'service.89629a97053c4dd3bd06adb146db6886';


    const startIcon = L.icon({
        iconUrl: '../assets/images/start.png', // آدرس عکس برای نقطه شروع
        iconSize: [50, 50], // سایز آیکن
        iconAnchor: [20, 40], // مکان آیکن نسبت به مختصات
        popupAnchor: [0, -60] // مکان پاپ‌آپ نسبت به آیکن
    });

    // تعریف آیکن سفارشی برای نقطه پایان
    const endIcon = L.icon({
        iconUrl: '../assets/images/end.png', // آدرس عکس برای نقطه پایان
        iconSize: [50, 50], // سایز آیکن
        iconAnchor: [20, 40], // مکان آیکن نسبت به مختصات
        popupAnchor: [0, -60] // مکان پاپ‌آپ نسبت به آیکن
    });


    // ساخت نقشه نشان
    let map = new L.Map('map', {
        key: API_KEY,
        maptype: 'neshan',
        center: [35.6892, 51.3890], // مختصات تهران
        zoom: 8
    });

    // جستجو روی نقشه
    $("#searchInput").on('input', function () {
        let query = $(this).val();

        // پاک کردن نتایج قبلی در صورت خالی بودن ورودی
        if (query === '') {
            $("#searchResults").html('');
            return;
        }

        // درخواست به API نشان برای جستجو
        fetch(`https://api.neshan.org/v1/search?term=${query}&lat=35.6892&lng=51.3890`, {
            headers: {
                'Api-Key': Service_KEY
            }
        })
            .then(response => response.json())
            .then(data => {
                let results = data.items;
                let searchResults = $("#searchResults");
                searchResults.fadeIn();
                searchResults.html('');

                // نمایش نتایج جستجو
                results.forEach(result => {
                    searchResults.append(`<li class="list-group-item bg-white" data-lat="${result.location.y}" data-lng="${result.location.x}">${result.title}</li>`);
                });

                // انتخاب نتیجه جستجو
                $("#searchResults li").on('click', function () {
                    let lat = $(this).data('lat');
                    let lng = $(this).data('lng');
                    let point = [lat, lng];


                    map.setView(point, 8); // بزرگ‌نمایی روی نقطه جستجو


                    if (!tripData.startPoint) {
                        tripData.startPoint = point;
                        startMarker = L.marker(tripData.startPoint, { icon: startIcon, draggable: true }).addTo(map);

                        getAddressFromCoordinates(point, 'start');
                        console.log(`نقطه شروع انتخاب شد: ${tripData.startPoint}`);


                    } else if (!tripData.endPoint) {
                        tripData.endPoint = point;
                        endMarker = L.marker(tripData.endPoint, { icon: endIcon, draggable: true }).addTo(map);

                        console.log(`نقطه پایان انتخاب شد: ${tripData.endPoint}`);

                        getAddressFromCoordinates(point, 'end');
                        drawRouteWithAPI(); // رسم مسیر پس از انتخاب مبدا و مقصد
                    }

                    // پاک کردن فیلد جستجو و نتایج
                    $("#searchInput").val('');
                    $("#searchResults").html('');
                    searchResults.hide();
                });
            });
    });


    let startMarker, endMarker;



    map.on('click', function (e) {
        let point = [e.latlng.lat, e.latlng.lng];

        if (!tripData.startPoint) {
            tripData.startPoint = point;
            startMarker = L.marker(tripData.startPoint, { icon: startIcon, draggable: true }).addTo(map);

            // console.log(`نقطه شروع انتخاب شد: ${tripData.startPoint}`);

            getAddressFromCoordinates(point, 'start');
        } else if (!tripData.endPoint) {
            tripData.endPoint = point;
            endMarker = L.marker(tripData.endPoint, { icon: endIcon, draggable: true }).addTo(map);
            console.log(`نقطه پایان انتخاب شد: ${tripData.endPoint}`);
            getAddressFromCoordinates(point, 'end');
            drawRouteWithAPI(); // رسم مسیر پس از انتخاب نقاط

        } else {
            console.log("نمی‌توانید نقطه دیگری اضافه کنید.");
        }
    });






    // تابع دریافت آدرس متنی از مختصات
    function getAddressFromCoordinates(coordinates, label) {
        const [lat, lng] = coordinates;

        const url = `https://api.neshan.org/v1/reverse?lat=${lat}&lng=${lng}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Api-Key': `service.89629a97053c4dd3bd06adb146db6886` // کلید API خود را اینجا قرار دهید
            }
        })
            .then(response => response.json())
            .then(data => {

                if (label == "start") {
                    tripData.startAdd = data.state + '-' + data.city + '-' + data.address;
                } else {
                    tripData.endAdd = data.state + '-' + data.city + '-' + data.address;
                }


            })
            .catch(error => console.error('Error:', error));
    }




    // تابع رسم مسیر با API نشان
    function drawRouteWithAPI() {
        const [startLat, startLng] = tripData.startPoint;
        const [endLat, endLng] = tripData.endPoint;

        const url = `https://api.neshan.org/v4/direction?type=car&origin=${startLat},${startLng}&destination=${endLat},${endLng}&avoidTrafficZone=false&avoidOddEvenZone=false&alternative=false&bearing=`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Api-Key': Service_KEY
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.routes && data.routes.length > 0) {
                    const polylinePoints = data.routes[0].overview_polyline.points;
                    const coordinates = polyline.decode(polylinePoints).map(coord => [coord[0], coord[1]]);



                    tripData.distance = data.routes[0].legs[0].distance.value / 1000;
                    tripData.travelTime = data.routes[0].legs[0].duration.text;
                    tripData.TimeMin = data.routes[0].legs[0].duration.value;


                    // رسم مسیر
                    routeLine = L.polyline(coordinates, { color: 'blue' }).addTo(map);
                    map.fitBounds(routeLine.getBounds());

                    console.log(data.routes[0].legs[0]);


                    calculateFare();

                } else {
                    console.error("مسیر یافت نشد.");
                }
            });
    }




    console.log(getPackageField("Eco", "base_fare")); // نتیجه: 50000




    // تابع محاسبه کرایه
    function calculateFare() {

        const distance = tripData.distance;
        const weather = tripData.weather;
        const roadCondition = tripData.roadCondition;
        const Packgae = tripData.Packgae;
        const toll = 0; // دریافت مبلغ عوارض
        const isHoliday = tripData.isHoliday = checkIfHoliday();

        // const toll = getRandomToll(); // دریافت مبلغ عوارض


        if (isHoliday) {
            baseRate *= 1.2; // 20% افزایش در روزهای تعطیل
        }

        const fare = PackagePrice(tripData.Packgae, distance, tripData.TimeMin);
        tripData.fare = fare;


        $("#submit").fadeIn();
        $(".fareHolder").html(formatFare(fare.toFixed(0)) + 'تومان').fadeIn();


    }

    function formatFare(amount) {
        precision = 1000;
        amount = Math.ceil(amount / precision) * precision;
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // تابع تولید عوارض جاده
    function getRandomToll() {
        const toll = Math.floor(Math.random() * (100000 - 10000 + 1)) + 10000;
        tripData.toll = toll;
        return toll;
    }

    // تابع بررسی تعطیلی
    function checkIfHoliday() {
        const today = new Date();
        const day = today.getDay();

        // در ایران روز جمعه (day=5) تعطیل است
        return day === 5;
    }


    function PackagePrice(packageName, distance, time) {
        const selectedPackage = packages.find(pkg => pkg.name === packageName);

        if (!selectedPackage) {
            return 'Package not found!';
        }

        // محاسبه هزینه اولیه بر اساس مسافت
        let fare = 0;
        if (distance < 50) {
            fare += parseInt(selectedPackage.base_fare);
        } else {
            fare += parseInt(selectedPackage.long_fare);
        }

        fare += distance * parseInt(selectedPackage.distance_rate);
        fare += time * parseInt(selectedPackage.time_rate);

        return fare;
    }

    // دکمه ریست کردن نقاط و مسیر
    document.getElementById('reset').addEventListener('click', function () {
        no = 0;

        tripData.startPoint = null;
        tripData.endPoint = null;

        if (endMarker) endMarker.remove();
        if (startMarker) startMarker.remove();
        if (routeLine) map.removeLayer(routeLine);

        $("#submit").fadeOut();
        $(".factor").empty();
        $("#sabt_estelam").hide();


        $("#factor_holder").hide();
        $(".fareHolder").empty().hide();
        $("#map_holder").attr("class", "col-lg-12");

        console.log("نقاط و مسیر ریست شد.");
    });





    $("#submit").click(function () {

        // calculateFare();
        $(".fareHolder").hide();

        $("#factor_holder").fadeIn();
        $("#map_holder").attr("class", "col-lg-9");
        $(this).hide();
        $("#sabt_estelam").show();

        var wether = $("li.nav-item.dropdown").eq(1).children('a').text();
        var road = $("li.nav-item.dropdown").eq(2).children('a').text();


        // typer.splice(0, 1);
        allPack = '<div style="text-align:left;">';

        for (let index = 0; index < packages.length; index++) {

            lable = packages[index]['name'];


            const fare = PackagePrice(lable, tripData.distance, tripData.TimeMin);


            allPack += 'تومان ' + lable + ' : ' + formatFare((fare).toFixed(0)) + ' <br/>';
        }
        allPack += '</div>';



        CreateFactor('مقصد', tripData.endAdd, '');
        CreateFactor('مبدا', tripData.startAdd, '');
        CreateFactor('مسافت', tripData.distance, 'کیلومتر');
        CreateFactor('روز تعطیل', tripData.isHoliday ? "بله" : "خیر", '');
        CreateFactor('زمان تقریبی رسیدن', tripData.travelTime, '');
        CreateFactor('کرایه', formatFare(tripData.fare.toFixed(0)), 'تومان');
        CreateFactor('شرایط مسیر', `جاده : ${road} <br/>  شرایط آب و هوایی : ${wether}`, '');
        CreateFactor('مقایسه قیمت ها', allPack, '');

        $(".base_fare").html(formatFare((tripData.fare).toFixed(0)) + 'تومان')
        // CreateFactor('عوارض', formatFare(toll), 'تومان');


    });



    function CreateFactor(lable, data, last) {
        no = newNum();
        row = '<tr><td class="no">' + no + '</td><td class="text-left" colspan="2">' + lable + '</td><td class="unit">' + data + ' ' + last + ' </td></tr>';
        $(".factor").append(row);
    }


    function newNum() {
        no++;
        let formattedNo = no < 10 ? '0' + no : no;
        return formattedNo;
    }

    function getPackageField(packageName, fieldName) {
        const selectedPackage = packages.find(pkg => pkg.name === packageName);
        if (selectedPackage && selectedPackage[fieldName]) {
            return selectedPackage[fieldName];
        } else {
            return 'Field or package not found!';
        }
    }


    //=================================================================================================================================================
    //=================================================================================================================================================
    //=================================================================================================================================================




    $(".spinner-border-sm").hide();
    $("#checkID").click(function () {

        var passenger_id = $('input[name="passenger_id"]').val();

        // $(this).attr("disabled", 'disabled');
        $(".spinner-border-sm").fadeIn();
        $.ajax({
            type: "POST",
            url: base + "Trips/FindID",
            data: { ID: passenger_id },

            success: function (data) {


                if (data.status == "OK") {

                    console.log(data);
                    $(".spinner-border-sm").hide();

                    $('input[name="passenger_name"]').val(data.User.name + ' ' + data.User.lname);
                    $('input[name="passenger_tel"]').val(data.User.mobile);


                    // window.location.href = base + 'Trips/Step2/' + data.ID;
                } else {
                    $(".spinner-border-sm").fadeOut();
                    alert('کابری با این شماره اشتراک یافت نشد');
                }


            }


        });
    });

    // Hamsafar();

    // function Hamsafar() {
    //     var url = 'https://hamsafartaxi.com/google_route.php?origin=35.59899109568322,51.43578649284009&destination=35.813894421727326,51.45960307999931&waypoints=waypoints=35.66565377014952,51.41102157070676|35.60901156352773,51.275752415417045';
    //     $.ajax({
    //         type: "GET",
    //         contentType: "application/json; charset=utf-8",
    //         url: url,
    //         async: true,
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             //console.log("error: " + textStatus + " - " + errorThrown);
    //             $("#panelWait").hide();
    //         },
    //         success: function (data) {
    //             if (manual_result != '')
    //                 data = manual_result;
    //             console.log('Success: ' + data);
    //             data = data.trim();

    //             if (data.indexOf('OK;') >= 0) {
    //                 var jsonStr = data.substr(3);
    //                 var json = JSON.parse(jsonStr);
    //                 console.log(json);

    //                 routesCallback(json, json['status']);
    //             } else {
    //                 $("#panelWait").hide();
    //                 $("#lblMessage").text("خطا در محاسبه کرایه");
    //                 $("#btnContinueRequest").hide();
    //                 $("#car_classs").hide();
    //                 last_requested_path = '';
    //             }
    //         },
    //         complete: function () {
    //             $("#panelWait").hide();
    //         }
    //     });
    // }

    $(".weather svg").on("click", function () {
        $(".weather svg").removeClass("svg_select");
        $(this).addClass("svg_select");
    })


    $(".package").on("click", function () {
        $(".package").removeClass("package_selected");
        $(this).addClass("package_selected");


        var currentPackage = $(this).data("name");
        tripData.Packgae = currentPackage;

        $(".factor").empty();
        calculateFare();


    });







    //==========================================================
    function persianToCalendars(year, month, day, op = {}) {
        const formatOut = gD => "toCal" in op ? (op.calendar = op.toCal, new Intl.DateTimeFormat(op.locale ?? "en", op).format(gD)) : gD,
            dFormat = new Intl.DateTimeFormat('en-u-ca-persian', { dateStyle: 'short', timeZone: "UTC" });
        let gD = new Date(Date.UTC(2000, month, day));
        gD = new Date(gD.setUTCDate(gD.getUTCDate() + 226867));
        const gY = gD.getUTCFullYear() - 2000 + year;
        gD = new Date(((gY < 0) ? "-" : "+") + ("00000" + Math.abs(gY)).slice(-6) + "-" + ("0" + (gD.getUTCMonth() + 1)).slice(-2) + "-" + ("0" + (gD.getUTCDate())).slice(-2));
        let [pM, pD, pY] = [...dFormat.format(gD).split("/")], i = 0;
        gD = new Date(gD.setUTCDate(gD.getUTCDate() +
            ~~(year * 365.25 + month * 30.44 + day - (pY.split(" ")[0] * 365.25 + pM * 30.44 + pD * 1)) - 2));
        while (i < 4) {
            [pM, pD, pY] = [...dFormat.format(gD).split("/")];
            if (pD == day && pM == month && pY.split(" ")[0] == year) return formatOut(gD);
            gD = new Date(gD.setUTCDate(gD.getUTCDate() + 1)); i++;
        }
        throw new Error('Invalid Persian Date!');
    }
    //==========================================================



    $('input[name="trip_date"]').on("change", function () {

        var val = $(this).val();

        const result = convertDateAndCheckFriday(val);
        console.log(`Converted Date: ${result.formattedDate}, Is Friday: ${result.isFriday}`);

    });







    function convertDateAndCheckFriday(persianDate) {
        const [jy, jm, jd] = persianDate.split('/').map(Number);
        const gregorian = jalaali.toGregorian(jy, jm, jd);
        const gregorianDate = new Date(gregorian.gy, gregorian.gm - 1, gregorian.gd); // month is zero-based
        const dayOfWeek = gregorianDate.getDay();
        const isFriday = dayOfWeek === 5;
        const formattedDate = `${gregorian.gy}-${String(gregorian.gm).padStart(2, '0')}-${String(gregorian.gd).padStart(2, '0')}`;

        return {
            formattedDate,
            isFriday
        };
    }





    $(".spinner-grow").hide();
    $("#insertReq").click(function () {

        tripData.isGuest = $('select[name="isGuest"]').val();
        tripData.trip_date = $('input[name="trip_date"]').val();
        tripData.trip_time = $('input[name="trip_time"]').val();
        tripData.company_name = $('input[name="company_name"]').val();
        tripData.passenger_id = $('input[name="passenger_id"]').val();
        tripData.passenger_tel = $('input[name="passenger_tel"]').val();
        tripData.passenger_name = $('input[name="passenger_name"]').val();
        tripData.total_passenger = $('input[name="total_passenger"]').val();
        tripData.end_address_desc = $('textarea[name="end_address_desc"]').val();
        tripData.start_address_desc = $('textarea[name="start_address_desc"]').val();

        $(this).attr("disabled", 'disabled');
        $(".spinner-grow").fadeIn();
        $.ajax({
            type: "POST",
            url: base + "Trips/AddTrip",
            data: tripData,
            success: function (data) {
                console.log(data);

                return;

                if (data.status == "OK") {
                    window.location.href = base + 'Trips/Step2/' + data.ID;
                } else {
                    $(".spinner-grow").fadeOut();
                    alert('مشکلی در ثبت اطلاعات بوجود آمده');
                }


            }


        });
    });


});