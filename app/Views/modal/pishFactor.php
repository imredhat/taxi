

                <div id="invoiceholder">
                    <div id="invoice" class="effect2">
                        <div id="invoice-top">
                            <div class="logo"></div>

                            <div class="info">
                                <h2 style="margin-top: 5px;">


                        <strong></strong> پویش تاکسی<br>سامانه اينترنتي سواري دربستي


                            </h2>
                            </div>

                            <div class="title">
                                <h1>پیش فاکتور</h1>
                                
                            </div>
                        </div>

                        <div id="invoice-mid">
                            <div class="clientlogo"></div>
                            <div class="info">

                            <h2 style="margin-top: -28px;">مشتری / مسافر</h2>
                                <h2 style="line-height: 15px;">


                                <?php if ($Trip['isGuest'] > 0): ?>
                                  <?php if($Trip['company_name' ] !== ''): ?>
                                    <?php echo $Trip['company_name']?> (<?php echo $Trip['passenger_name']?>)<br>
                                  <?php else: ?>
                                    <?php echo $Trip['passenger_name']?><br>
                                  <?php endif; ?>

                                  <?php echo $Trip['passenger_tel'] ?><br>

                                  [ مسافر ] <br/>

                                  <?php echo $Trip['guest_name']?><br>
                                  <?php echo $Trip['guest_tel'] ?><br>
                                  <strong></strong> 

                                <?php else: ?>
                                  <?php if($Trip['company_name' ] !== ''): ?>
                                    <?php echo $Trip['company_name']?> (<?php echo $Trip['passenger_name']?>)<br>
                                  <?php else: ?>
                                    <?php echo $Trip['passenger_name']?><br>
                                  <?php endif; ?>
                                  <?php echo isset($Trip['passenger_tel']) ? htmlspecialchars($Trip['passenger_tel']) : 'نامشخص' ?><br>

                                    <strong></strong>

                                <?php endif; ?>

                            </h2>
                            </div>
                            <div id="project">
                            <h2 style="margin-top: -28px;">اطلاعات سرویس</h2>
                                
                                کد سرویس #<?php echo 1000 + $Trip['id'] ?><br/>
                               تاریخ و ساعت سفر : <?php echo $Trip['trip_date'] . ' ' . $Trip['trip_time'] ?></br>
                               
                                    مبدا :  <?php echo $Trip['startAdd'] ?>  <br/>
                                مقصد :  <?php echo $Trip['endAdd'] ?><br/>
                                پکیج سرویس :  <?php echo $Trip['package'] ?>

                                <br/>
                                نوع سفر :  
                                <?php
                                switch ($Trip['trip_type']) {
                                  case 'one_way':
                                    echo 'یک طرفه رفت';
                                    break;
                                  case 'round_trip':
                                    echo 'رفت و برگشت';
                                    break;
                                  case 'round_trip_with_stop':
                                    echo 'رفت ، توقف ، برگشت';
                                    break;
                                  case 'round_trip_with_service':
                                    echo 'رفت ، در اختیار ، برگشت';
                                    break;
                                  default:
                                    echo 'نامشخص';
                                }
                                ?>
                              <br/>
                              <?php echo $Trip['dsc'] ?>


                                
                                
                            </p>
                            </div>
                        </div>







                    









                        <div id="invoice-bot">
                            <div id="table" style="padding-bottom: 150px;">
                                <table>
                                    <tr class="tabletitle">
                                        <td class="item"><h2>عنوان</h2></td>
                                        <td class="Hours"><h2>واحد</h2></td>
                                        <td class="Rate"><h2>هزینه واحد</h2></td>
                                        <td class="subtotal"><h2>جمع کل</h2></td>
                                    </tr>
                                    <tr class="service">
                                        <td class="tableitem"><p class="itemtext">پکیج سرویس</p></td>
                                        <td class="tableitem"><p class="itemtext">1</p></td>
                                        <td class="tableitem"><p class="itemtext"><?php echo $Trip['package'] ?></p></td>
                                        <td class="tableitem"><p class="itemtext">-</p></td>
                                    </tr>


                                    <tr class="service">
                                        <td class="tableitem"><p class="itemtext">کرایه </p></td>
                                        <td class="tableitem"><p class="itemtext">1</p></td>
                                        <td class="tableitem"><p class="itemtext">

                                            <?php
                                            if (isset($Trip['userCustomFare']) && $Trip['userCustomFare'] > 0): echo number_format($Trip['userCustomFare']) . ' تومان';endif; ?>

                                        </p></td>
                                        <td class="tableitem"><p class="itemtext">
                                        <?php
                                        if (isset($Trip['userCustomFare']) && $Trip['userCustomFare'] > 0): echo number_format($Trip['userCustomFare']) . ' تومان';endif; ?>

                                        </p></td>
                                    </tr>



                                    <?php if (isset($transactions) && ! empty($transactions)): foreach ($transactions as $T): ?>
	                                    <tr class="service">
	                                        <td class="tableitem"><p class="itemtext">

	                                            پرداخت توسط	 <?php echo $T['name'] ?> در تاریخ<?php echo $T['date_p'] ?> با شناسه پرداخت <?php echo $T['trans_id'] ?><br/>
	                                            <?php echo $T['desc'] ?>



	                                    </p></td>
	                                        <td class="tableitem"><p class="itemtext">1</p></td>
	                                        <td class="tableitem"><p class="itemtext"><?php echo number_format($T['amount']) ?> تومان</p></td>
	                                        <td class="tableitem"><p class="itemtext"><?php echo number_format($T['amount']) ?> تومان</p></td>
	                                    </tr>

	                                    <?php endforeach;endif; ?>


                                    <tr class="tabletitle">
                                        <td></td>
                                        <td></td>
                                        <td class="Rate"><h2>مجموع</h2></td>
                                        <td class="payment"><h2>  <?php
                                            if (isset($Trip['userCustomFare']) && $Trip['userCustomFare'] > 0): echo number_format($Trip['userCustomFare']) . ' تومان';endif; ?></h2></td>
                                    </tr>
                                </table>



                                <div id="invoice-mid">

<h2 style="font-size: 12px;text-align: center;padding: 10px;text-decoration: underline;">
    لطفا مبلغ فاكتور را به حساب بانكي با مشخصات ذيل واريز و فيش واريزي را براي پشتيباني سامانه ارسال نمائيد
</h2>


    <div class="paymentLogo"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
    <div class="info">
        <h2><?=$Bank['bank_name']?></h2>
        <h2>صاحب حساب : <?=$Bank['holder_name']?> </h2>
    </div>
    <div id="project" style="margin-top: 10px;">
        <h2> اطلاعات حساب : </h2>
          <span style="direction:ltr !important;"> <?= substr($Bank['card_number'], 0, 4) . '-' . substr($Bank['card_number'], 4, 4) . '-' . substr($Bank['card_number'], 8, 4) . '-' . substr($Bank['card_number'], 12, 4) ?> </span>
        
        <p><?=$Bank['shaba']?></p>
    </div>
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

                <div style="text-align: center; margin-top: 20px;">
                  <button id="savePdfButton" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    ذخیره به صورت PDF
                  </button>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                <script>
                  document.getElementById('savePdfButton').addEventListener('click', function () {
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF('p', 'pt', 'a4', true); // Set UTF-8 encoding and A4 size for higher quality

                    // Load a custom font for Persian text
                    const fontUrl = '<?php echo base_url() ?>assets/fonts/IRANSansWeb.ttf';
                    fetch(fontUrl)
                      .then(response => response.arrayBuffer())
                      .then(font => {
                        pdf.addFileToVFS('IRANSansWeb.ttf', font);
                        pdf.addFont('IRANSansWeb.ttf', 'IRANSans', 'normal');
                        pdf.setFont('IRANSans');

                        // Select the invoiceholder element
                        const invoiceHolderElement = document.getElementById('invoiceholder');

                        // Use html2canvas to render the invoiceholder into the PDF
                        html2canvas(invoiceHolderElement, { useCORS: true, scale: 3 }).then(canvas => {
                          const imgData = canvas.toDataURL('image/png');
                          const imgWidth = 595.28; // A4 width in points
                          const pageHeight = 841.89; // A4 height in points
                          const imgHeight = (canvas.height * imgWidth) / canvas.width;
                          let heightLeft = imgHeight;

                          let position = 0;

                          // Add the image to the PDF
                          pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight, undefined, 'FAST');
                          heightLeft -= pageHeight;

                          while (heightLeft >= 0) {
                            position = heightLeft - imgHeight;
                            pdf.addPage();
                            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight, undefined, 'FAST');
                            heightLeft -= pageHeight;
                          }

                          pdf.save('invoice.pdf');
                        });
                      });
                  });
                </script>




<script>
     gregorianDate = "<?php echo $Trip['created_at'] ?>";
     jalaliDateTime = convertToJalali(gregorianDate);

    $(".card-footer").html('تاریخ ایجاد:' + jalaliDateTime);


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


<style>
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




<style type="text/css" media="print">
    .page
    {
     -webkit-transform: rotate(-90deg); 
     -moz-transform:rotate(-90deg);
     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }

    body{
      background-color: white;

    }

    #invoice {
    position: absolute;
    margin: auto;
    width: 700px;
    background: #FFF;
    margin-right: -300px;
}

#toolbarContainer{
  display: none !important;
}
</style>