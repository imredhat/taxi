$(document).ready(function () {
    $(".table").DataTable({
        "order": [
            [2, "desc"]
        ],
        "language": {
            "decimal": "",
            "emptyTable": "موردی یافت نشد",
            "info": "نمایش _START_ از _END_ تا _TOTAL_ مورد",
            "infoEmpty": "نمایش 0 از 0 تا 0 مورد",
            "infoFiltered": "(فیلتر از _MAX_ مورد)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "نمایش _MENU_ مورد",
            "loadingRecords": "بارگذاری...",
            "processing": "آماده سازی...",
            "search": "جستجو:",
            "zeroRecords": "موردی یافت نشد",
            "paginate": {
                "first": "اولین",
                "last": "آخرین",
                "next": "بعدی",
                "previous": "قبلی"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }

    });

    // $("#packages").chosen();

    $('input[name="passenger_custom_fare"] , input[name="driver_custom_fare"]').on("input", function () {

        let originalValue = $(this).val().replace(/,/g, '');
        if (!isNaN(originalValue) && originalValue !== "") {
            $(this).val(originalValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        } else {
            $(this).val('');
        }
    })


    $('a[data-bs-target="#PayingFare"]').click(function () {
        $('.base_fare').html($(this).data("fare") + '<input name="tripID" type="hidden" value="' + $(this).data("id") + '" />');
        var package = $(this).data('package');

        $("select.form-control#packageSelect").val(package).change();
    });

    // ====================================================================================



    $('a[data-bs-target="#updateStatus"]').click(function () {

        var clickedID = $(this).data("id");
        var status = $(this).data("status");

        $("#ClickedTripID").val(clickedID);
        $("#ClickedStatus").val(status);
        $("select[name='status']").val(status).change();
    });


    $('a[data-bs-target="#Delete"]').click(function () {

        var clickedID = $(this).data("id");
        $("#DeleteID").val(clickedID);

    });



    // ====================================================================================

    $(".view_item").click(function () {
        modal = $("#ViewItem");
        ID = $(this).data("id");

        $("#ViewItem").empty();

        $.ajax({
            type: "GET",
            url: "Trips/GetTrip/" + ID,
            success: function (data) {
                $("#ViewItem").html(data);
            }
        });
    });

    // $("#ViewItem").click(function (e) {
    //     $("#ViewItem").empty();
    //     e.preventDefault();

    //     delete window.startPoint;
    //     delete window.endPoint;
    //     delete window.map;
    //     delete window.startIcon;
    //     delete window.endIcon;
    //     delete window.polylinePoints;
    //     delete window.routeCoordinates;
    //     delete window.data;
    //     delete window.response;

    // });

    $(".notif").click(function () {


        var ID = $("input[name='tripID']").val();
        var UserFare = $("input[name='driver_custom_fare']").val().replace(/[^0-9a-z-A-Z ]/g, "").replace(/ +/, " ");
        var DriverFare = $("input[name='passenger_custom_fare']").val().replace(/[^0-9a-z-A-Z ]/g, "").replace(/ +/, " ");
        var package = $("select[name='package']").val();

        console.log(package);

        if (UserFare.length <= 0 || DriverFare.length <= 0) {
            // alert('لطفا اطلاعات را با دقت پر کنید');
            warn('لطفا اطلاعات را با دقت پر کنید');
            $("input[name='passenger_custom_fare']").focus();
        } else {
            $(".notif_spinner").css("display", "inline-block");

            $.ajax({
                type: "POST",
                url: "Trips/CreateNotif",
                data: {
                    tripID: ID,
                    UserFare: UserFare,
                    DriverFare: DriverFare,
                    DriverPackage : package
                },
                success: function (data) {
                    if (data.status == 'OK') {
                        toast('اعلام سرویس با موفقیت انجام شد');

                        $(".notif_spinner").hide();
                        $('#PayingFare').modal('toggle');
                        $("input[name='driver_custom_fare']").val('');
                        $("input[name='passenger_custom_fare']").val('');
                        $(".tr_" + ID + " td:nth-child(7)").html('<span class="bg-warning text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block">اطلاع رسانی شده </span>');
                    } else {
                        toast('مشکلی در ثبت اعلام سرویس رخ داده است');
                    }


                }
            });

        }



    });



    $(".ChangeStatus").click(function () {


        var ID = $("#ClickedTripID").val();
        var Status = $("select[name='status']").val();
        var NewStatus = $("select[name='status'] option:selected").text();

        $(".change_status").css("display", "inline-block");

        $.ajax({
            type: "POST",
            url: "Trips/UpdateStatus",
            data: {
                tripID: ID,
                Status: Status
            },
            success: function (data) {
                if (data.status == 'OK') {
                    toast('تغییر وضعیت با موفقیت انجام شد');

                    $(".change_status").hide();
                    $('#updateStatus').modal('hide');

                    $(".tr_" + ID + " td:nth-child(7)").html('<span class="' + data.class + ' text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block">' + NewStatus + ' </span>');
                } else {
                    warn('مشکلی در بروزرسانی وضعیت رخ داده است');
                }
            }
        });
    });




    $(".delete").click(function () {

        var ID = $("#DeleteID").val();

        $.ajax({
            type: "POST",
            url: "Trips/Dwt",
            data: {
                tripID: ID,
            },
            success: function (data) {
                if (data.status == 'OK') {
                    $(".tr_" + ID + "").remove();
                    $('#Delete').modal('hide');

                    toast('حذف مورد با موفقیت انجام شد');

                } else {
                    warn('مشکلی در بروزرسانی وضعیت رخ داده است');
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
    function warn(text) {

        const toastLiveExample = document.getElementById('warnToast')
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




    // ================================= handle Request =======================================

    $('a[data-bs-target="#Request"]').click(function () {
        modal = $("#Request");
        ID = $(this).data("id");

        $("#ViewItem").empty();

        $.ajax({
            type: "POST",
            url: "Request/getTripDrivers",
            data: { tripID: ID },
            success: function (data) {
                $(".driver_list").html(data);
            }
        });

    });

});