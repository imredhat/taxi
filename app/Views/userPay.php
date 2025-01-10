<!DOCTYPE html><!-- Source code not available ... -->


<!-- saved from url=(0014)about:internet -->
<html lang="fa" class="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="پویش تاکسی">
    <meta name="description" content="پویش تاکسی">
    <meta name="author" content="Saber Ahmadpour">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/logo.png">
    <title>پویش تاکسی</title>

    <noscript>
        <p>To display this page you need a browser that supports JavaScript.</p>
    </noscript>
    <meta http-equiv="imagetoolbar" content="no" />
    <style type="text/css">
        <!-- input,textarea{-webkit-touch-callout:default;-webkit-user-select:auto;-khtml-user-select:auto;-moz-user-select:text;-ms-user-select:text;user-select:text} *{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:-moz-none;-ms-user-select:none;user-select:none}
        -->
    </style>
    <style type="text/css" media="print">
        <!-- body{display:none}
        -->
    </style> <!--[if gte IE 5]><frame></frame><![endif]-->
</head>

<body>
<div class="preloader" id="preloader">
    <div class="preloader">
        <div>
            <img src="
                <?=base_url()?>assets/images/loader.gif" />
        </div>
    </div>
</div>
<div class="main-content d-flex flex-column px-0">
   <div class="m-auto mw-510 py-5">
      <form method="post" action="<?=base_url()?>Pay/UserPayStart">
         <div class="d-flex align-items-center gap-4 mb-3">
            <h4 class="fs-3 mb-0">پرداخت به پویش تاکسی</h4>
            <a href="index.html"> <img src="<?=base_url()?>assets/images/logo.png" alt="logo" width="60"> </a>
         </div>
         <p class="fs-18 mb-5">فرم زیر را با دقت پر کنید و در نهایت دکمه تکمیل خرید رو بعد از پرداخت بزنید</p>
         <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
               <div class="form-group mb-4"> <label class="label">نام و نام خانوادگی</label> <input name="name" type="text" class="form-control h-58" placeholder="نام و نام خانوادگی"> </div>
               <div class="form-group mb-4"> <label class="label">شماره موبایل</label> <input type="text" name="mobile" class="form-control h-58" placeholder="شماره موبایل"> </div>
               <div class="form-group mb-4"> <label class="label">مبلغ (ریال)</label> <input type="text" name="amount" class="form-control h-58" placeholder="مبلغ مورد نظر"> </div>
               <div class="form-group mb-4"> <label class="label">توضیحات</label>

               <textarea name="desc"  class="form-control h-500" placeholder="شماره سفارش یا هر توضیح مورد نیاز" ></textarea>

               </div>


            </div>
         </div>
         <button type="submit" class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100"> پرداخت </button>
      </form>
   </div>
</div>

      <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>assets/js/custom/custom.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[placeholder="مبلغ مورد نظر"]').on('input', function() {
                var value = $(this).val().replace(/,/g, '');
                if (!isNaN(value)) {
                    $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            });
        });
    </script>
</body>

</html>