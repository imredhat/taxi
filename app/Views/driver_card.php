
<?php 
    $driver = $driver[0];
    $dc = $car[0];

    if(isset($_GET['car'])){
        $selectedCar = $_GET['car'];
        $cars = array_filter($car, function($c) use ($selectedCar) {
            return $c['cid'] == $selectedCar;
        });
        $dc = reset($cars);
    }
?>
<div class="container" id="print">
    <!------------------------------ First card container --------------------------------------->
    <div class="card-container" id="bg"  style="border:1px solid #ccc">
        <div class="top-box">
            <div class="top-menu">
                <div class="col-sm-12 text-center text-white header bg-primary">کارت عضویت رانندگان</div>

            </div>
        </div>
        <!-------------------------- End of top Box(Menu) ---------------------------------->
        <div class="image-box">
            <img width="100%" height="100%" src="<?= base_url() ?>uploads/drivers/<?=$driver['did']?>/<?= esc($driver['ax']) ?>" alt="user-profile" style="object-fit: cover;">
        </div>
        <!-------------------------- End of Image Box ---------------------------------->
        <div class="main-box">
            <div class="user-info">
                <span class="name"><?= $driver['name'] ?> <?= $driver['lname'] ?></span>
                <span class="job">- <?= $driver['mobile'] ?> -</span>

            </div>
            <!-------------------------- End of user information ---------------------------------->


            <div class="row">
                <div class="col-sm-12 pelak">
                    <div class="col-sm-3"><?= $dc['iran'] ?></div>
                    <div class="col-sm-3"><?= $dc['pelak'] ?></div>
                    <div class="col-sm-3"><?= $dc['harf'] ?></div>
                    <div class="col-sm-3"><?= $dc['pelak_last'] ?></div>
                </div>
            </div>
            <div class="user-info">
                <span class="name"> &ensp;</span>
            </div>

            <div class="car" style="background: url('<?= base_url("uploads/drivers/") ?><?=$driver['did']?>/<?= $dc['pic_front'] ?>' )  no-repeat center center;"></div>

            <div class="stats-box style-four card bg-white border-0 rounded-10 mb-4 mt-1 my-5">
                <div class="card-body p-4">

                    <div class="row">

                  


                        <div class="col-sm-3 icon_glass">
                            <div class="wheel"> <svg style="margin-top: -7px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="#757FEF" data-name="Layer 1" viewBox="0 0 24 24" width="30" height="30">
                                    <path d="M12,0A12,12,0,0,0,0,12v0c.59,15.905,23.416,15.89,24,0v0A12,12,0,0,0,12,0Zm0,2a10.01,10.01,0,0,1,8.878,5.4l-7.049,1.41a9.64,9.64,0,0,1-3.8,0L3.108,7.428A10.01,10.01,0,0,1,12,2ZM9,21.54a10.027,10.027,0,0,1-6.935-8.4l3.9.78a2.994,2.994,0,0,1,2.05,1.515l.624,1.153A3,3,0,0,1,9,18.014Zm6,0V18.014a3,3,0,0,1,.362-1.428l.624-1.154a3,3,0,0,1,2.05-1.514l3.9-.78A10.027,10.027,0,0,1,15,21.54Zm2.644-9.583a4.987,4.987,0,0,0-3.416,2.522L13.6,15.633a5.009,5.009,0,0,0-.6,2.381V21.95a10.126,10.126,0,0,1-2,0V18.014a5.009,5.009,0,0,0-.6-2.381L9.772,14.48a4.985,4.985,0,0,0-3.416-2.523l-4.314-.863a9.82,9.82,0,0,1,.324-1.775l7.272,1.454a11.629,11.629,0,0,0,4.583,0l7.406-1.481a9.845,9.845,0,0,1,.331,1.8Z" />
                                </svg>
                            </div>
                        </div>


                        <div class="col-sm-9 glass">
                            <div class=""> <span style="font-family: monospace !important;">

                            <?php
                            require_once APPPATH.'Libraries/jdf.php'; 
                            $date_created = new DateTime($driver['date_created']);
                            $gregorian_date = explode('-', $date_created->format('Y-m-d'));
                            $persian_date_array = gregorian_to_jalali($gregorian_date[0], $gregorian_date[1], $gregorian_date[2]);
                            $persian_date = implode('', $persian_date_array);

                            $driver_code = $persian_date . '-' . (1000 + $driver['did']);
                            echo $driver_code;
                            ?>

                            </span>
                                <div class="">
                                    <h3 class="text-truncate" style="font-size: calc(1vw + 1vh + 0vmin);"><?= $dc['car_brand'] .' '. $dc['type_name'].' '. $dc['color']?></h3>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>




            <!---------------------------- End of Social icons ------------------------------>

            <div class="bottom">
                <div class="col-sm-12">پویش تاکسی </div>
                <div class="col-sm-12" style="font-size: 8px;">www.PooyeshTak30.ir | 09229247081</div>
            </div>

            <!---------------------------- End of button box ------------------------------>
        </div>
        <!---------------------------- Animated circles ------------------------------>

        <div class="circle-1"></div>
        <div class="circle-2"></div>

        <!---------------------------- End of Animated circles ------------------------------>
    </div>

    <style>
    #print {
        letter-spacing: 0px; /* or specify a value, e.g., 0px */
    }

    .card-container ,.container{
        background: #fff !important;
    }
</style>

<button id="download" onclick="return downloadJPG()" class="btn btn-primary">دانلود کارت</button>

<?php if (count($car) > 1): ?>
    <div class="form-group">
        <select id="carSelect" name="carSelect" class="form-control">
            <?php foreach ($car as $i => $car): ?>
                <option value="<?= $car['cid'] ?>">خودرو #<?= $i + 1 ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<?php endif; ?>


<script>

    if (window.location.search.includes('car=')) {
        const urlParams = new URLSearchParams(window.location.search);
        const selectedCarId = urlParams.get('car');
        const carSelect = document.getElementById('carSelect');
        if (carSelect) {
            carSelect.value = selectedCarId;
        }
    }

    document.getElementById('carSelect').addEventListener('change', function() {
        var selectedCarId = this.value;
        var driverId = <?= $driver['did'] ?>;

        // Redirect to the new URL with the selected car ID
        window.location.href = "<?= base_url('DriverCard/') ?>" + driverId + "?car=" + selectedCarId;
    });

</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
  function downloadJPG() {
  // گرفتن کل محتوای صفحه
  const element = document.body;
  document.getElementById('download').style.display = 'none';
  document.getElementById('carSelect').style.display = 'none';


  // استفاده از html2canvas برای گرفتن اسکرین‌شات
  html2canvas(element, {
    scale: 2, // افزایش کیفیت خروجی
    useCORS: true, // برای رفع مشکلات CORS
    backgroundColor: null // برای شفاف نگه‌داشتن پس‌زمینه
  }).then((canvas) => {
    // تبدیل Canvas به تصویر
    const imgData = canvas.toDataURL('image/jpg', 0.98);

    // ساخت لینک دانلود
    const link = document.createElement('a');
    link.href = imgData;
    link.download = 'driver<?=$driver['did']?>.jpg';
    link.click();
  });
}
    
</script>

    


</div>

<link href="<?= base_url() ?>assets/css/card.css" rel="stylesheet" />