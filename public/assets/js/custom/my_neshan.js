
// آرایه گلوبال برای ذخیره اطلاعات مهم
let startMarker, endMarker, routeLine;
let tripData = {
    toll: null,
    endAdd: null,
    weather: null,
    carType: null,
    startAdd: null,
    distance: null,
    waitRate: null,
    endPoint: null,
    badRoadKM: null,
    finalFare: null,
    Waithours: null,
    startPoint: null,
    badRoadRate: null,
    travelTime: null,
    weatherRate: null,
    roadCondition: null,
};

let no = 0;
initiate();


function initiate() {
    $(".factor").empty();
    $(".package:first-child").addClass("package_selected");
    $(".changeWeather:first-child svg").addClass("svg_select");
    var currentPackage = $(".package_selected").data("name");



    tripData.isFriday = 1;
    tripData.Waithours = 0;
    tripData.passengerRate = 1;
    tripData.badRoadRate = badRoad;
    tripData.Packgae = currentPackage;
    tripData.holiDayRate = holiDayRate;
    tripData.extraPassenger = extraPassenger;
    tripData.weatherRate = $(".changeWeather:first-child").data("rate");
    tripData.waitRate = packages.find(pkg => pkg.name === tripData.Packgae).wait_rate;

}


$(document).ready(function () {

    $(".leaflet-bottom.leaflet-right").hide();
    $(".leaflet-control-container").next("div").hide();
    $("body").attr("sidebar-data-theme", "sidebar-hide");


    height = self.innerHeight - 170
    $("#map").css("height", height);


    // API Key نشان که از پنل خود دریافت کرده‌اید
    const API_KEY = 'web.840318dd773d4122a1d07e932344af55';
    const Service_KEY = 'service.89629a97053c4dd3bd06adb146db6886';


    const startIcon = L.icon({
        iconUrl: '../assets/images/start.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });


    const endIcon = L.icon({
        iconUrl: '../assets/images/end.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });


    let map = new L.Map('map', {
        key: API_KEY,
        maptype: 'neshan',
        center: [35.6892, 51.3890], // مختصات تهران
        zoom: 8
    });

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

                    calculateFare();

                } else {
                    console.error("مسیر یافت نشد.");
                }
            });
    }

    // تابع محاسبه کرایه
    function calculateFare() {

        const distance = tripData.distance;
        const Packgae = tripData.Packgae;

        // const toll = 0; // دریافت مبلغ عوارض
        // const isHoliday = tripData.isHoliday = checkIfHoliday();
        // const toll = getRandomToll(); // دریافت مبلغ عوارض

        const fare = PackagePrice(Packgae, distance, tripData.TimeMin);

        // fare = fare * weatherRate * passengerRate *

        tripData.fare = fare;
        tripData.finalFare = fare;

        $("#submit").fadeIn();
        $(".fareHolder").html(formatFare(fare.toFixed(0)) + 'تومان').fadeIn();
    }

    function calculateFinalFare() {

        const FinalFare = tripData.fare;
        const WaitRate = tripData.waitRate
        const isFriday = tripData.isFriday;
        const Waithours = tripData.Waithours;
        const weatherRate = tripData.weatherRate;
        const passengerRate = tripData.passengerRate;
        const badRoadRate = tripData.badRoadRate;
        const badRoadKM = tripData.badRoadKM;
        const Friday = (isFriday == 0) ? 1 : holiDayRate;




        fare = FinalFare * weatherRate * passengerRate * Friday + (Waithours * WaitRate) + (badRoadRate * badRoadKM)

        tripData.finalFare = fare;

        console.log(tripData);

        $("#submit").fadeIn();
        $(".base_fare").html(formatFare(tripData.finalFare.toFixed(0)) + 'تومان').fadeIn();

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


    function PackagePrice(packageName, distance, time) {
        const selectedPackage = packages.find(pkg => pkg.name === packageName);

        if (!selectedPackage) {
            return 'Package not found!';
        }

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
        reset();
    });

    function reset() {
        no = 0;


        if (endMarker) endMarker.remove();
        if (startMarker) startMarker.remove();
        if (routeLine) map.removeLayer(routeLine);

        $("#submit").fadeOut();
        $(".factor").empty();
        $("#sabt_estelam").hide();


        $("#factor_holder").hide();
        $(".fareHolder").empty().hide();
        $("#map_holder").attr("class", "col-lg-12");

        $('input[name="trip_date"]').val();
        $('input[name="wait_hours"]').val(0);
        $('input[name="total_passenger"]').val(1);
        $(".changeWeather svg").removeClass("svg_select");
        $("#insertReq").removeAttr("disabled");


        Object.keys(tripData).forEach(key => {
            tripData[key] = null;
        });

        const inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(input => input.value = '');

        $(".package:first-child").click();
        $(".fareHolder").hide();


        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(text => text.value = '');

        console.log("نقاط و مسیر ریست شد.");
    }



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



    $(".weather svg").on("click", function () {
        $(".weather svg").removeClass("svg_select");
        $(this).addClass("svg_select");

        var weather = $(this).parent('a')[0].dataset.name;
        var rate = $(this).parent('a')[0].dataset.rate;

        tripData.weather = weather;
        tripData.weatherRate = rate;

        calculateFinalFare();
    })


    $(".package").on("click", function () {
        $(".package").removeClass("package_selected");
        $(this).addClass("package_selected");


        var currentPackage = $(this).data("name");
        tripData.Packgae = currentPackage;
        tripData.waitRate = packages.find(pkg => pkg.name === tripData.Packgae).wait_rate;


        $(".factor").empty();
        calculateFare();


    });


    $('input[name="trip_date"]').on("change", function () {

        var val = $(this).val();

        const result = convertDateAndCheckFriday(val);
        if (result.isFriday) {
            tripData.isFriday = 1;
            calculateFinalFare();
        } else {
            tripData.isFriday = 0;
            calculateFinalFare();
        }

    });


    $('input[name="total_passenger"]').on("change", function () {

        var val = $(this).val();
        if (val <= 1) {

            $(this).val(1);
            tripData.passengerRate = 1;
            calculateFinalFare();
        }
        if (val > 3) {
            qty = Math.pow(tripData.extraPassenger, (val - 3));

            tripData.passengerRate = qty;
            calculateFinalFare();
        }

    });


    $('input[name="wait_hours"]').on("change", function () {

        var val = $(this).val();

        if (val < 1) {
            $(this).val(0);
            tripData.Waithours = val;
        }
        if (val > 0) {
            tripData.Waithours = val;
        }

        calculateFinalFare();

    });


    $('select[name="isWait"]').on("change", function () {

        var val = $(this).val();
        if (val == 1) {
            $('input[name="wait_hours"]').removeAttr("disabled");
            $('input[name="wait_hours"]').next("button").removeAttr("disabled");
            $('input[name="wait_hours"]').prev("button").removeAttr("disabled");
        } else {
            $('input[name="wait_hours"]').attr("disabled", "disabled");
            $('input[name="wait_hours"]').prev("button").attr("disabled", true);
            $('input[name="wait_hours"]').next("button").attr("disabled", true);

        }

    });


    $('select[name="badRoad"]').on("change", function () {

        var val = $(this).val();
        if (val == 1) {
            $('input[name="badRoadKM"]').removeAttr("disabled");
            $('input[name="badRoad_km"]').next("button").removeAttr("disabled");
            $('input[name="badRoad_km"]').prev("button").removeAttr("disabled");
        } else {
            $('input[name="badRoad_km"]').attr("disabled", "disabled");
            $('input[name="badRoad_km"]').prev("button").attr("disabled", true);
            $('input[name="badRoad_km"]').next("button").attr("disabled", true);

        }

    });


    $('input[name="badRoad_km"]').on("change", function () {

        var val = $(this).val();

        if (val < 1) {
            $(this).val(0);
            tripData.badRoadKM = val;
        }
        if (val > 0) {
            tripData.badRoadKM = parseFloat(val);
        }

        calculateFinalFare();

    });



    $(".spinner-grow").hide();
    $("#insertReq").click(function (e) {

        e.preventDefault();

        tripData.badRoad = document.querySelector("select[name='badRoad']").value;
        tripData.isWait = document.querySelector("select[name='isWait']").value;

        tripData.isGuest = document.querySelector("select[name='isGuest']").value;
        tripData.trip_date = document.querySelector("input[name='trip_date']").value;
        tripData.trip_time = document.querySelector("input[name='trip_time']").value;
        tripData.company_name = document.querySelector("input[name='company_name']").value;
        tripData.passenger_id = document.querySelector("input[name='passenger_id']").value;
        tripData.passenger_tel = document.querySelector("input[name='passenger_tel']").value;
        tripData.passenger_name = document.querySelector("input[name='passenger_name']").value;
        tripData.total_passenger = document.querySelector("input[name='total_passenger']").value;
        tripData.end_address_desc = document.querySelector("[name='end_address_desc']").value;
        tripData.start_address_desc = document.querySelector("textarea[name='start_address_desc']").value;

        tripData.wait_hours = document.querySelector("input[name='wait_hours']").value;
        tripData.badRoad_km = document.querySelector("input[name='badRoad_km']").value;
        tripData.luggage = document.querySelector("[name='luggage']").value;

        $(this).attr("disabled", 'disabled');
        $(".spinner-grow").fadeIn();
        $.ajax({
            type: "POST",
            url: base + "Trips/AddTrip",
            data: tripData,
            success: function (data) {
                // console.log(data);
                // return;

                if (data.status == "OK") {
                    reset();
                    $(".btn-close").click();
                    // alert('استعلام با موفقیت صبت شد');
                    toast('استعلام با موفقیت ثبت شد');
                    map.setView([35.6892, 51.3890], 8);


                    // window.location.href = base + 'Trips/Step2/' + data.ID;
                } else {


                    $(".spinner-grow").fadeOut();

                }


            }


        });
    });



    function toast(text) {

        const toastLiveExample = document.getElementById('liveToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

        $('.toast-body').html(text);
        toastBootstrap.show();

    }


    //==========================================================
    function jalaliToGregorian(jy, jm, jd) {
        const g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        const j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];

        jy = jy - 979;
        jm = jm - 1;
        jd = jd - 1;

        let j_day_no = 365 * jy + Math.floor(jy / 33) * 8 + Math.floor((jy % 33 + 3) / 4);
        for (let i = 0; i < jm; ++i) {
            j_day_no += j_days_in_month[i];
        }
        j_day_no += jd;

        let g_day_no = j_day_no + 79;

        let gy = 1600 + 400 * Math.floor(g_day_no / 146097); // 146097 = 365*400 + 400/4 - 400/100 + 400/400
        g_day_no = g_day_no % 146097;

        let leap = true;
        if (g_day_no >= 36525) { // 36525 = 365*100 + 100/4
            g_day_no--;
            gy += 100 * Math.floor(g_day_no / 36524); // 36524 = 365*100 + 100/4 - 100/100
            g_day_no = g_day_no % 36524;

            if (g_day_no >= 365) {
                g_day_no++;
            } else {
                leap = false;
            }
        }

        gy += 4 * Math.floor(g_day_no / 1461); // 1461 = 365*4 + 4/4
        g_day_no %= 1461;

        if (g_day_no >= 366) {
            leap = false;

            g_day_no--;
            gy += Math.floor(g_day_no / 365);
            g_day_no = g_day_no % 365;
        }

        let gm;
        for (gm = 0; gm < 12; gm++) {
            let days_in_month = g_days_in_month[gm];
            if (leap && gm == 1) days_in_month++; // February has 29 days in leap years
            if (g_day_no < days_in_month) break;
            g_day_no -= days_in_month;
        }

        let gd = g_day_no + 1;

        return { gy, gm: gm + 1, gd }; // Return as {year, month, day}
    }

    function convertDateAndCheckFriday(persianDate) {
        const [jy, jm, jd] = persianDate.split('/').map(Number);
        const { gy, gm, gd } = jalaliToGregorian(jy, jm, jd);
        const gregorianDate = new Date(gy, gm - 1, gd); // month is zero-based in JavaScript Date
        const dayOfWeek = gregorianDate.getDay();
        const isFriday = dayOfWeek === 5;
        const formattedDate = `${gy}-${String(gm).padStart(2, '0')}-${String(gd).padStart(2, '0')}`;

        return {
            formattedDate,
            isFriday
        };
    }

    //==========================================================


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