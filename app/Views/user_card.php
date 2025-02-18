
<style>

body *{
    line-height: 1.5; /* مقدار استاندارد */
    letter-spacing: normal;
    word-spacing: normal;
}
    </style>


<div class="container" id="print">
    <!------------------------------ First card container --------------------------------------->
    <div class="card-container" style="border:1px solid #ccc;">
        <div class="top-box">
            <div class="top-menu">
                <div class="col-sm-12 text-center text-white header" style="background: #31687f;">کارت عضویت مشتری</div>

            </div>
        </div>
        <!-------------------------- End of top Box(Menu) ---------------------------------->
        <div class="image-box">
            <?php if (empty($user['ax'])): ?>
                <?php if ($user['gender'] == "مرد"): ?>
                    <img width="150" height="150" src="<?=base_url()?>assets/images/male.png" alt="user-profile">
                <?php else: ?>
                    <img width="150" height="150" src="<?=base_url()?>assets/images/female.png" alt="user-profile">

                <?php endif;?>
            <?php else: ?>
                <img width="150" height="150" src="<?=base_url()?>uploads/user/<?=esc($user['id'])?>/<?=esc($user['ax'])?>" alt="user-profile">
            <?php endif;?>
        </div>
        <!-------------------------- End of Image Box ---------------------------------->
        <div class="main-box">
        <div style="border:1px solid #ccc;padding: 10px; width: 70%;  margin: auto;  border-radius: 10px;">
                <div class="user-info" style="font-size:10px !important ; text-decoration:underline">

                    <?php if ($user['gender'] == "مرد"): ?>

                        <span  class="name">  جناب آقای</span>
                <?php else: ?>
                    <span  class="name">  سرکار خانم</span>

                <?php endif;?>


                </div>
                <div class="user-info">
                    <span class="name"><?=$user['name']?> <?=$user['lname']?></span>
                </div>
        </div>


      
        <div style="padding: 10px; width: 70%;  margin: auto;  border-radius: 10px;">
            <table style="width: 100%; font-size: 10px;">
                <tr>
                    <td >شناسه اشتراک</td>
                    <td>- <?=$user['id'] + 1000 ?> -</td>
                </tr>

                <?php if (!empty($user['company_name'])): ?>
                    <tr>
                        <td>نام سازمان</td>
                        <td>- <?=esc($user['company_name'])?> -</td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td >تاریخ شروع اشتراک</td>
                    <td>- <?php 
                    
                 

                    echo $user['date_start'];
                                    
                    
                    
                    ?> -</td>
                </tr>

                <tr>
                    <td >شماره همراه</td>
                    <td>- <?=$user['mobile']?>  -</td>
                </tr>

              
            </table>
        </div>



          

            <!---------------------------- End of button box ------------------------------>
        </div>
        <!---------------------------- Animated circles ------------------------------>

        <div class="circle-1"></div>
        <div class="circle-2"></div>

        <!---------------------------- End of Animated circles ------------------------------>
    </div>

    <button id="download" onclick="return downloadJPG()" class="btn btn-primary">دانلود کارت</button>

</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
  function downloadJPG() {
  // گرفتن کل محتوای صفحه
  const element = document.body;
  document.getElementById('download').style.display = 'none';

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
    link.download = 'user<?=$user['id']?>.jpg';
    link.click();
  });
}
    
</script>


<link href="<?=base_url()?>assets/css/user_card.css" rel="stylesheet" />





