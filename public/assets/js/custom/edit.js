
$(document).ready(function () {


    $("body").on("change", "select#isGuest", function () {
        if ($(this).val() == "1") {
            $('.passengerBox').show();
        } else {
            $('.passengerBox').hide();
        }
    });



    $("#driver").chosen();
    $("#car").chosen();


    $(".spinner-border-sm").hide();
    $("#checkID").click(function () {

        var Tel = $('input[name="Tel"]').val();

        // $(this).attr("disabled", 'disabled');
        $(".spinner-border-sm").fadeIn();
        $.ajax({
            type: "POST",
            url: base + "Trips/FindID",
            data: { Tel: Tel },
            success: function (data) {
                if (data.status == "OK") {

                    $(".spinner-border-sm").hide();

                    $('input[name="passenger_name"]').val(data.User.name + ' ' + data.User.lname);
                    $('input[name="passenger_tel"]').val(data.User.mobile);
                    $('input[name="company_name"]').val(data.User.company_name);
                    $('body input[name="passenger_id"]').val(data.User.id);



                    // window.location.href = base + 'Trips/Step2/' + data.ID;
                } else {
                    $(".spinner-border-sm").fadeOut();
                    // alert('کابری با این شماره اشتراک یافت نشد');
                }
            }
        });
    });



    $('#driver').on('change', function () {
        var driverID = $(this).val();

        if (driverID == 0) {
            $('#car').empty();
            $('#car').trigger("chosen:updated");
            return;
        }

        $.ajax({
            type: "POST",
            url: base + "Driver/GetDriverCars",
            data: { driverID: driverID },
            success: function (data) {
                if (data.status == "OK") {
                    var carSelect = $('#car');
                    carSelect.empty();
                    $.each(data.data, function (index, car) {
                        carSelect.append($('<option>', {
                            value: car.cid,
                            text: car.car_brand + ' ' + car.type_name + ' [ ایران ' + car.iran + '-' + car.pelak + car.harf + car.pelak_last + ' ] '
                        }));
                    });
                    carSelect.trigger("chosen:updated");
                } else {
                    alert('خطا در دریافت اطلاعات خودروها');
                }
            }
        });
    });




    function GetDriverCar(driverID) {
        $.ajax({
            type: "POST",
            url: base + "Driver/GetDriverCars",
            data: { driverID: driverID },
            success: function (data) {
                if (data.status == "OK") {
                    var carSelect = $('#car');
                    carSelect.empty();
                    $.each(data.data, function (index, car) {
                        carSelect.append($('<option>', {
                            value: car.cid,
                            text: car.car_brand + ' ' + car.type_name + ' [ ایران ' + car.iran + '-' + car.pelak + car.harf + car.pelak_last + ' ] '
                        }));
                    });
                    car = $("input[name='car']").val();
                    carSelect.val(car);
                    carSelect.trigger("chosen:updated");
                } else {
                    alert('خطا در دریافت اطلاعات خودروها');
                }
            }
        });
    }

    if ($('#driver').val() && $('#driver').val() > 0) {
        GetDriverCar($('#driver').val());
    }



    $(".updateTrip").click(function (e) {

        e.preventDefault();


        var tripData = {};
        tripData.id = $("body input[name='id']").val().replace(/\D/g, '');
        tripData.startAdd = $("body input[name='startAdd']").val();
        tripData.endAdd = $("body input[name='endAdd']").val();
        tripData.trip_date = $("body input[name='trip_date']").val();
        tripData.trip_time = $("body input[name='trip_time']").val();
        tripData.weather = $("body select[name='weather']").val();
        tripData.travelTime = $("body input[name='travelTime']").val();
        tripData.distance = $("body input[name='distance']").val();
        // tripData.finalFare = $("body input[name='finalFare']").val();
        tripData.passengerFare = $("body input[name='passengerFare']").val();
        tripData.driverFare = $("body input[name='driverFare']").val();
        tripData.trip_type = $("body select[name='trip_type']").val();
        tripData.driverID = $("body select[name='driverID']").val();
        tripData.carID = $("body select[name='carID']").val();
        tripData.passenger_id = $("body input[name='passenger_id']").val();
        tripData.isGuest = $("body select[name='isGuest']").val();
        tripData.passenger_name = $("body input[name='passenger_name']").val();
        tripData.passenger_tel = $("body input[name='passenger_tel']").val();
        tripData.guest_name = $("body input[name='guest_name']").val();
        tripData.guest_tel = $("body input[name='guest_tel']").val();
        tripData.total_passenger = $("body input[name='total_passenger']").val();
        tripData.wait_hours = $("body input[name='wait_hours']").val();
        tripData.status = $("body select[name='status_edit']").val();
        tripData.status_text = $("body select[name='status_edit'] option:selected").text();
        tripData.dsc = $("body textarea[name='dsc']").val();
        tripData.note = $("body textarea[name='note']").val();
        tripData.bank = $("body select[name='bank']").val();
        tripData.package_edit = $("body select[name='package_edit']").val();
        tripData.call_date = $("body input[name='call_date']").val();
        tripData.call_time = $("body input[name='call_time']").val();
        tripData.company_name = $("body input[name='company_name']").val();
        tripData.payment_status = $("body select[name='payment_status']").val();

        tripData.startPoint = $("body input[name='startPoint']").val();
        tripData.endPoint = $("body input[name='endPoint']").val();

        var ID = tripData.id.replace(/\D/g, '');
        var NewStatus = tripData.status_text;

        // console.log(tripData);

        $.ajax({
            type: "POST",
            url: base + "Trips/UpdateTrip",
            data: tripData,
            success: function (data) {

                // console.log(data);
                if (data.status == 'OK') {
                    toast('ویرایش سفر با موفقیت انجام شد');
                    $("#EditItem").modal('hide');

                    location.reload(true);



                    // $(".tr_" + ID + " td:nth-child(7)").html('<span class="' + data.class + ' text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block">' + NewStatus + ' </span>');

                } else {
                    warn('مشکلی در ویرایش سفر رخ داده است');
                }


                // setTimeout(function () {
                //     location.reload();
                // }, 1000); // 3000 milliseconds = 3 seconds
            }


        });

    });



    $('#finalFare').val(formatNumberWithCommas($('#finalFare').val()));



    $("body").on("input", "input[name='driverFare']", function () {
        $(this).val(formatNumberWithCommas($(this).val().replace(/,/g, '')));
    });

    $("body").on("input", "#driverFare", function () {
        $(this).val(formatNumberWithCommas($(this).val().replace(/,/g, '')));
    });

    $('#finalFare').on('input', function (e) {
        $(this).val(formatNumberWithCommas($(this).val().replace(/,/g, '')));
    });



});










function toast(text) {

    const toastLiveExample = document.getElementById('liveToast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

    $('.toast-body').html(text);
    toastBootstrap.show();

}
function warn(text) {

    const toastLiveExample = document.getElementById('warnToast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

    $('.toast-body').html(text);
    toastBootstrap.show();

}




























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



try {
    var resultEl = document.querySelector(".resultSet"),
        plusMinusWidgets = document.querySelectorAll(".add-to-cart-counter");
    for (var i = 0; i < plusMinusWidgets.length; i++) {
        plusMinusWidgets[i].querySelector(".minusBtn").addEventListener("click", clickHandler);
        plusMinusWidgets[i].querySelector(".plusBtn").addEventListener("click", clickHandler);
        // plusMinusWidgets[i].querySelector(".count").addEventListener("change", changeHandler);
    }

    function clickHandler(event) {
        var countEl = event.target.parentNode.querySelector(".count");
        if (event.target.className.match(/\bminusBtn\b/)) {
            countEl.value = Number(countEl.value) - 1;

        } else if (event.target.className.match(/\bplusBtn\b/)) {
            if (event.target.className.match(/\bpss\b/)) {
                countEl.value = Number(countEl.value) + 1;

            } else {
                countEl.value = Number(countEl.value) + 1;
            }
        }
        triggerEvent(countEl, "change");
    };

    function triggerEvent(el, type) {
        if ('createEvent' in document) {
            var e = document.createEvent('HTMLEvents');
            e.initEvent(type, false, true);
            el.dispatchEvent(e);
        } else {
            var e = document.createEventObject();
            e.eventType = type;
            el.fireEvent('on' + e.eventType, e);
        }
    }
} catch { }










//==========================================================

function convertToJalali(gregorianDate) {
    var [date, time] = gregorianDate.split(" ");
    var [year, month, day] = date.split("-").map(Number);
    var [hour, minute, second] = time.split(":").map(Number);
    var jalaliDate = jalaali.toJalaali(year, month, day);

    return ` ${jalaliDate.jy}/${jalaliDate.jm}/${jalaliDate.jd} ساعت : ${hour}:${minute}:${second}`;
}

//==========================================================




function formatNumberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

