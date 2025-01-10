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
                <?= base_url() ?>assets/images/loader.gif" />
        </div>
    </div>
</div>
    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">
            <div class="m-auto mw-510 py-5">
            <form action="<?=base_url()?>auth/verify" method="post">
                    <div class="d-flex align-items-center gap-4 mb-3">
                        <h4 class="fs-3 mb-0">شروع کنید.</h4> <a href="index.html"> <img
                                src="<?=base_url()?>assets/images/logo-icon.png" alt="logo"> </a>
                    </div>
                    <p class="fs-18 mb-5">حساب کاربری ندارید؟ <a href="register.html"
                            class="text-decoration-none text-primary">ثبت نام</a></p>
                    <div class="d-sm-flex gap-3 mb-4" style="width: 400px;"> 
                    
                   
                    <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" style="width: 100%;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
                                
                                 </div> 


                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="form-group mb-4"> <label class="label">ایمیل</label> 
                                <input type="text" name="username" class="form-control h-58" placeholder="johndoe"> 
                            </div>
                            <div class="form-group mb-0"> <label class="label">گذرواژه</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative"> 
                                    <input type="password" id="password" name="password" class="form-control h-58 text-dark" value="@password#"> 
                                        <i style="color: #A9A9C8; font-size: 16px; left: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                



                    <div class="d-sm-flex justify-content-between mb-4">
                        <div class="form-check"> <input class="form-check-input position-relative" style="top: 1.1px;"
                                type="checkbox" value id="flexCheckDefault"> <label
                                class="form-check-label fs-16 text-gray-light" for="flexCheckDefault"> مرا به خاطر بسپار
                            </label> </div> <a href="forget-password.html"
                            class="fs-16 text-primary text-decoration-none mt-2 mt-sm-0 d-block"> فراموشی گذرواژه؟ </a>
                    </div>

                        <button class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">ورود</button>
                </form>
            </div>

            
        </div>
    </div> 
    
    
      <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>

    <script src="<?=base_url()?>assets/js/custom/custom.js"></script>
</body>

</html>