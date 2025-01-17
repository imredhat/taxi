
$(document).ready(function () {

    $("#driver").chosen();


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



    const sel = document.getElementById("packageSelect");


sel.addEventListener("change",()=>{
  let selectedOption = sel.options[sel.selectedIndex];
  console.log(selectedOption); // get the element
  console.log(selectedOption.value); //get the value attribute
  console.log(selectedOption.innerText); // get the inner text
});



    $(".updateTrip").click(function (e) {

        e.preventDefault();

        var tripData = {};
        tripData.id = document.querySelector("input[name='id']").value;
        tripData.startAdd = document.querySelector("input[name='startAdd']").value;
        tripData.endAdd = document.querySelector("input[name='endAdd']").value;
        tripData.trip_date = document.querySelector("input[name='trip_date']").value;
        tripData.trip_time = document.querySelector("input[name='trip_time']").value;
        tripData.weather = document.querySelector("select[name='weather']").value;
        tripData.travelTime = document.querySelector("input[name='travelTime']").value;
        tripData.distance = document.querySelector("input[name='distance']").value;
        tripData.finalFare = document.querySelector("input[name='finalFare']").value;
        tripData.passengerFare = document.querySelector("input[name='passengerFare']").value;
        tripData.driverFare = document.querySelector("input[name='driverFare']").value;
        tripData.trip_type = document.querySelector("select[name='trip_type']").value;
        tripData.driverID = document.querySelector("select[name='driverID']").value;
        tripData.passenger_id = document.querySelector("input[name='passenger_id']").value;
        tripData.isGuest = document.querySelector("select[name='isGuest']").value;
        tripData.passenger_name = document.querySelector("input[name='passenger_name']").value;
        tripData.passenger_tel = document.querySelector("input[name='passenger_tel']").value;
        tripData.total_passenger = document.querySelector("input[name='total_passenger']").value;
        tripData.wait_hours = document.querySelector("input[name='wait_hours']").value;
        tripData.status = document.querySelector("select[name='status']").value;
        tripData.package = document.querySelector("select[name='package']").value;

        // var NewStatus = $("select[name='status'] option:selected").text();



        $.ajax({
            type: "POST",
            url: base + "Trips/UpdateTrip",
            data: tripData,
            success: function (data) {

                console.log(data);
                if (data.status == 'OK') {
                    toast('ویرایش سفر با موفقیت انجام شد');
                    $("#EditItem").modal('hide');
                    // location.reload();

                    // $(".tr_" + ID + " td:nth-child(7)").html('<span class="' + data.class + ' text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block">' + NewStatus + ' </span>');

                } else {
                    warn('مشکلی در ویرایش سفر رخ داده است');
                }
            }


        });

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
            countEl.value = Number(countEl.value) + 1;
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

$('#finalFare').val(formatNumberWithCommas($('#finalFare').val()));



$('#passengerFare').on('input', function (e) {
    $(this).val(formatNumberWithCommas($(this).val().replace(/,/g, '')));
});

$('#driverFare').on('input', function (e) {
    $(this).val(formatNumberWithCommas($(this).val().replace(/,/g, '')));
});

$('#finalFare').on('input', function (e) {
    $(this).val(formatNumberWithCommas($(this).val().replace(/,/g, '')));
});