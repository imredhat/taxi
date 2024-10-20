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
        tripData.isFriday = tripData.holiDayRate;
        calculateFinalFare();
    } else {
        tripData.isFriday = 1;
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

