<?php
function getWeather($category)
{
    switch ($category) {
        case 'snowy':
            return 'برفی';
        case 'rainy':
            return 'بارانی';
        default:
            return 'آفتابی';
    }
}


function getServiceStatus($status)
{
    switch ($status) {
        case 'Called':
            return 'استعلام';
        case 'Reserve':
            return 'رزرو';
        case 'Confirm':
            return 'تایید شده';
        case 'Notifed':
            return 'اطلاع رسانی شده';
        case 'Cancled':
            return 'کنسل شده';
        case 'Requested':
            return 'درخواست شده';
        case 'Done':
            return 'به پایان رسیده';
    }
}


?>



<div class="modal-dialog modal-dialog-centered">
    <form action="/updateTrip" method="post">
        <input type="hidden" name="trip_id" value="<?= $Trip['id'] ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            ویرایش استعلام
                        </div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-md-12">
                                    <label for="startAdd"><strong>مبدا:</strong></label>
                                    <input type="text" id="startAdd" name="startAdd" class="form-control" value="<?= $Trip['startAdd'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="endAdd"><strong>مقصد:</strong></label>
                                    <input type="text" id="endAdd" name="endAdd" class="form-control" value="<?= $Trip['endAdd'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="trip_date"><strong>تاریخ سفر:</strong></label>
                                    <input type="text" id="trip_date" name="trip_date" class="form-control"  placeholder="روز/ماه/سال" data-jdp=""  value="<?= $Trip['trip_date'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="trip_time"><strong>زمان سفر:</strong></label>
                                    <input type="text" id="trip_time" name="trip_time" class="form-control"  data-jdp="" data-jdp-only-time="" value="<?= $Trip['trip_time'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="weather"><strong>وضعیت هوا:</strong></label>
                                    <input type="text" id="weather" name="weather" class="form-control" value="<?= $Trip['weather'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="travelTime"><strong>زمان تقریبی سفر:</strong></label>
                                    <input type="text" id="travelTime" name="travelTime" class="form-control" value="<?= $Trip['travelTime'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="distance"><strong>مسافت:</strong></label>
                                    <input type="text" id="distance" name="distance" class="form-control" value="<?= $Trip['distance'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="finalFare"><strong>کرایه نهایی:</strong></label>
                                    <input type="text" id="finalFare" name="finalFare" class="form-control" value="<?= $Trip['finalFare'] ?>">
                                </div>
                            </div>


                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <label class="label">نوع سفر</label>
                                    <select name="trip_type" class="form-control" required>
                                        <option value="one_way" <?= $Trip['trip_type'] == 'one_way' ? 'selected' : '' ?>>یک طرفه رفت</option>
                                        <option value="round_trip_with_stop" <?= $Trip['trip_type'] == 'round_trip_with_stop' ? 'selected' : '' ?>>رفت ، توقف ، برگشت</option>
                                        <option value="round_trip_with_service" <?= $Trip['trip_type'] == 'round_trip_with_service' ? 'selected' : '' ?>>رفت ، در اختیار ، برگشت</option>
                                    </select>
                                </div>
                            </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <label class="label">توقف دارد ؟</label>
                                <select name="isWait" class="form-control" required>
                                    <option value="0" <?= $Trip['isWait'] == '0' ? 'selected' : '' ?>>خیر</option>
                                    <option value="1" <?= $Trip['isWait'] == '1' ? 'selected' : '' ?>>بله</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="label d-block">تعداد ساعت تاخیر</label>
                                <div class="product-quantity">
                                    <div class="add-to-cart-counter gap-3 justify-content-between">
                                        <button type="button" class="minusBtn bg-success text-white" <?= $Trip['isWait'] == '0' ? 'disabled' : '' ?>></button>
                                        <input name="wait_hours" type="text" size="25" value="<?= $Trip['Waithours'] ?>" class="count border-success" <?= $Trip['isWait'] == '0' ? 'disabled' : '' ?>>
                                        <button type="button" class="plusBtn bg-success text-white" <?= $Trip['isWait'] == '0' ? 'disabled' : '' ?>></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                            
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="total_passenger"><strong>تعداد مسافران:</strong></label>
                                    <input type="text" id="total_passenger" name="total_passenger" class="form-control" value="<?= $Trip['total_passenger'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="status"><strong>وضعیت سفر:</strong></label>
                                    <input type="text" id="status" name="status" class="form-control" value="<?= $Trip['status'] ?>">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="passenger_tel"><strong>شماره تماس مسافر:</strong></label>
                                    <input type="text" id="passenger_tel" name="passenger_tel" class="form-control" value="<?= $Trip['passenger_tel'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="Packgae"><strong>بسته:</strong></label>
                                    <input type="text" id="Packgae" name="Packgae" class="form-control" value="<?= $Trip['Packgae'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div style="height: 300px;" id="map"></div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            تاریخ ایجاد: <?= $Trip['created_at'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
            </div>
        </div>
    </form>
</div>






<script>


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
		}
		else if (event.target.className.match(/\bplusBtn\b/)) {
			countEl.value = Number(countEl.value) + 1;
		}
		triggerEvent(countEl, "change");
	};
	// function changeHandler(event) {
	// 	resultEl.value = 0;
	// 	for (var i = 0; i < plusMinusWidgets.length; i++) {
	// 		resultEl.value = Number(resultEl.value) + Number(plusMinusWidgets[i].querySelector('.count').value);
	// 	}
	// };
	function triggerEvent(el, type) {
		if ('createEvent' in document) {
			var e = document.createEvent('HTMLEvents');
			e.initEvent(type, false, true);
			el.dispatchEvent(e);
		}
		else {
			var e = document.createEventObject();
			e.eventType = type;
			el.fireEvent('on' + e.eventType, e);
		}
	}
} catch { }



     gregorianDate = "<?= $Trip['created_at'] ?>";
     jalaliDateTime = convertToJalali(gregorianDate);

    $(".card-footer").html('تاریخ ایجاد:' + jalaliDateTime);


    startPoint = [<?= explode(',', $Trip['startPoint'])[0] ?>, <?= explode(',', $Trip['startPoint'])[1] ?>];
    endPoint = [<?= explode(',', $Trip['endPoint'])[0] ?>, <?= explode(',', $Trip['endPoint'])[1] ?>];

    // ایجاد نقشه و تنظیمات اولیه
    map = new L.Map('map', {
        key: 'web.840318dd773d4122a1d07e932344af55', // اینجا API Key خود را قرار دهید
        center: startPoint,
        zoom: 10,
        maptype: 'neshan'
    });

    startIcon = L.icon({
        iconUrl: '../assets/images/start.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });


    endIcon = L.icon({
        iconUrl: '../assets/images/end.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });



    // تابع برای رسم مسیر
    async function drawRoute(startLat, startLng, endLat, endLng) {
        // پاک کردن نشانگرهای قبلی
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                map.removeLayer(layer);
            }
        });


        // افزودن نشان برای مبدا
        startMarker = L.marker(startPoint, {
            icon: startIcon
        }).addTo(map);

        // افزودن نشان برای مقصد
        endMarker = L.marker(endPoint, {
            icon: endIcon
        }).addTo(map);

        response = await fetch(`https://api.neshan.org/v4/direction?type=car&origin=${startLat},${startLng}&destination=${endLat},${endLng}`, {
            headers: {
                'Api-Key': 'service.89629a97053c4dd3bd06adb146db6886'
            }
        });

        if (!response.ok) {
            console.error('خطا در دریافت مسیر:', response.statusText);
            return;
        }

        data = await response.json();

        polylinePoints = data.routes[0].overview_polyline.points;
        routeCoordinates = polyline.decode(polylinePoints).map(coord => [coord[0], coord[1]]);


        L.polyline(routeCoordinates, {
            color: 'blue',
            weight: 5
        }).addTo(map);

        map.fitBounds(routeCoordinates);
    }

    drawRoute(startPoint[0], startPoint[1], endPoint[0], endPoint[1]);








    //==========================================================

    function convertToJalali(gregorianDate) {
        var [date, time] = gregorianDate.split(" ");
        var [year, month, day] = date.split("-").map(Number);
        var [hour, minute, second] = time.split(":").map(Number);
        var jalaliDate = jalaali.toJalaali(year, month, day);

        return ` ${jalaliDate.jy}/${jalaliDate.jm}/${jalaliDate.jd} ساعت : ${hour}:${minute}:${second}`;
    }

    //==========================================================
</script>