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
            case 'Reserved':
                return 'رزرو';
            case 'Notifed':
                return 'اعلام به راننده';
            case 'Requested':
                return 'اعلام آمادگی راننده';
            case 'Confirm':
                return 'پذیرش توسط راننده';
            case 'Cancled':
                return 'کنسل شده';
            case 'Done':
                return 'به پایان رسیده';
            case 'Service':
                return 'سرویس درحال انجام';
            default:
                return 'نامشخص';
        }
    }

?>

<div id="invoiceholder">
                    <div id="invoice" class="effect2">
                        <div id="invoice-top">
                            <div class="logo"></div>

                            <div class="info">
                                <h2 style="margin-top: 5px;">


                        <strong></strong> پویش تاکسی<br>سامانه اينترنتي سواري دربستي


                            </h2>
                                    <?php echo $Trip['passenger_tel'] ?></br>
                            </div>

                            <div class="title">
                                <h1>پایان سرویس #<?php echo 1000 + $Trip['id'] ?></h1>
                                <p>تاریخ سفر :                                                                                                                                                                                                                                                                               <?php echo $Trip['trip_date'] . ' ' . $Trip['trip_time'] ?></br>
                                </p>
                            </div>
                        </div>

                        <div id="invoice-mid">
                            <div class="clientlogo"></div>
                            <div class="info">
                                <h2>


                                <?php if ($Trip['isGuest'] > 0): ?>
                                    <strong></strong><?php echo isset($Trip['passenger_name']) ? htmlspecialchars($Trip['passenger_name']) : 'نامشخص' ?><br>
                                    <strong></strong>                                                                                                                                                                                                                                                              <?php echo isset($Trip['passenger_tel']) ? htmlspecialchars($Trip['passenger_tel']) : 'نامشخص' ?><br>

                                <?php else: ?>
                                    <strong></strong><?php echo isset($Trip['guest_name']) ? htmlspecialchars($Trip['guest_name']) : 'نامشخص' ?><br>
                                    <strong></strong>                                                                                                                                                                                                                                                              <?php echo isset($Trip['guest_tel']) ? htmlspecialchars($Trip['guest_tel']) : 'نامشخص' ?><br>

                                <?php endif; ?>

                            </h2>
                                    <?php echo $Trip['passenger_tel'] ?></br>
                            </div>
                            <div id="project">
                                <h2> اطلاعات سفر: </h2>
                                <p>
                                    مبدا :                                                                                                                                                                                                                                       <?php echo $Trip['startAdd'] ?>  <br/>

                                مقصد :                                                                                                                                                                                                                   <?php echo $Trip['endAdd'] ?>
                            </p>
                            </div>
                        </div>












                        <div id="invoice-bot">
                            <div id="table" style="padding-bottom: 150px;">















                            <div class="card-body">



                            <div class="row my-2">
                                <div class="col-md-6">
                                    <strong>تاریخ سفر:</strong> <span><?php echo $Trip['trip_date']?></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>زمان سفر:</strong> <span><?php echo $Trip['trip_time']?></span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6">
                                    <strong>وضعیت هوا:</strong> <span><?php echo getWeather($Trip['weather'])?></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>زمان تقریبی سفر:</strong> <?php echo $Trip['travelTime']?>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6">
                                    <strong>مسافت:</strong> <span><?php echo $Trip['distance']?> کیلومتر</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>کرایه نهایی:</strong> <span>۲<?php echo number_format($Trip['finalFare'])?> تومان</span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6">
                                    <strong>تعداد مسافران:</strong> <span><?php echo $Trip['total_passenger']?> نفر</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>وضعیت سفر:</strong> <span><?php echo getServiceStatus($Trip['status'])?></span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6">
                                    <?php if ($Trip['isGuest'] > 0): ?>
                                        <strong>شماره تماس مسافر:</strong> <span><?php echo $Trip['passenger_tel']?></span>
                                    <?php else: ?>
                                        <strong>شماره تماس مسافر:</strong> <span><?php echo $Trip['guest_tel']?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <strong>بسته:</strong> <span><?php echo $Trip['package']?></span>
                                </div>
                            </div>
                            <hr>
                            <div style="height: 300px;" id="map"></div>
                            </div>























                            <form method="post" target="_top" style="text-align: center;color:#666;">
                                <img width="300" src="<?php echo base_url() ?>assets/images/factor_footer.png"/>
                                <br/><br/>www.Pooyeshtak30.ir
                            </form>
                            <div id="legalcopy">
                                <p class="legal">
                                <ul class="contact-infos">
									                                    <li><i class="fa fa fa-envelope"></i>ایمیل :  PooyeshTak30@gmail.com</li>
									                                    <li><i class="fa fa fa-phone-square"></i>تلفن :  02177901635</li>
									                                    <li><i class="fa fa fa-mobile-alt"></i> موبایل :  09229247081</li>
									                                    <li><i class="fa fa fa-fax"></i> صاپست : 9247081</li>
									                                </ul>
                                </p>
                            </div>

                            </div>
                        </div>





                    </div>
                </div>



                <link href="<?=base_url()?>assets/css/leaflet.css" rel="stylesheet" type="text/css">

                <script src="<?=base_url()?>assets/js/polyline.min.js"></script>
                <script src="<?=base_url()?>assets/js/leaflet.js" type="text/javascript"></script>
<script>
  


    startPoint = [<?php echo explode(',', $Trip['startPoint'])[0] ?>,<?php echo explode(',', $Trip['startPoint'])[1] ?>];
    endPoint = [<?php echo explode(',', $Trip['endPoint'])[0] ?>,<?php echo explode(',', $Trip['endPoint'])[1] ?>];

    // ایجاد نقشه و تنظیمات اولیه
    map = new L.Map('map', {
        key: 'web.840318dd773d4122a1d07e932344af55', // اینجا API Key خود را قرار دهید
        center: startPoint,
        zoom: 8,
        maptype: 'neshan'
    });

    startIcon = L.icon({
        iconUrl: '../../assets/images/start.png',
        iconSize: [50, 50],
        iconAnchor: [20, 40],
        popupAnchor: [0, -60]
    });


    endIcon = L.icon({
        iconUrl: '../../assets/images/end.png',
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


<style>
    .main-content{
        margin: auto !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-right: 0 !important;
    }
.paymentLogo{
    float: right;
	height: 60px;
	width: 60px;
	background: url('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>') no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
  background-color: #666;
  padding: 17px;
  color: white;
}

@import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;

}
body{
  background: #E0E0E0;
  font-family: 'Roboto', sans-serif;
  background-image: url('');
  background-repeat: repeat-y;
  background-size: 100%;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}

#invoiceholder{
  width:100%;
  hieght: 100%;
  padding-top: 50px;
}
#headerimage{
  z-index:-1;
  position:relative;
  top: -50px;
  height: 350px;
  background-image: url('http://michaeltruong.ca/images/invoicebg.jpg');

  -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
	-moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
	box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
  overflow:hidden;
  background-attachment: fixed;
  background-size: 1920px 80%;
  background-position: 50% -90%;
}
#invoice{
  position: relative;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*='invoice-']{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
  padding: 30px;
}

.tableitem{
    padding:3px 5px ;
}
#invoice-top{min-height: 120px;}
#invoice-mid{min-height: 120px;}
#invoice-bot{ min-height: 250px;}

.logo{
  float: right;
	height: 60px;
	width: 60px;
	background: url('<?php echo base_url() ?>assets/images/logo.png') no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: right;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  float:right;
  margin-left: 20px;
  padding: 10px;
}
.title{
  float: left;
}
.title p{text-align: right;}
#project{margin-right: 52%;}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 50%;}
.itemtext{font-size: .9em;}

#legalcopy{
  margin-top: 30px;
  float: right;
}
form{
  float:right;
  margin-top: 30px;
  text-align: right;
}


.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}

form{
  float:left;
}

.legal{
  width:70%;
}

</style>