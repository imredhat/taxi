<!DOCTYPE html><!-- Source code not available ... -->


<!-- saved from url=(0014)about:internet -->
<html lang="fa" class="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="پویش تاکسی">
    <meta name="description" content="پویش تاکسی">
    <meta name="author" content="Barat Hadian">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/remixicon.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/flaticon.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/simplebar.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/apexcharts.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/prism.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/rangeslider.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/sweetalert.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/quill.snow.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/favicon.png">
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
            <div class="waviy position-relative"> <span class="d-inline-block">F</span> <span
                    class="d-inline-block">A</span> <span class="d-inline-block">R</span> <span
                    class="d-inline-block">O</span> <span class="d-inline-block">L</span> </div>
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
    </div> <button class="btn btn-danger theme-settings-btn p-0 position-fixed z-2 text-center"
        style="bottom: 30px; right: 30px; width: 40px; height: 40px;" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"> <i data-feather="settings"
            class="wh-20 text-white position-relative" style="top: -1px; outline: none;" data-bs-toggle="tooltip"
            data-bs-placement="left" data-bs-title="Click On Theme Settings"></i> </button>
    <div class="offcanvas offcanvas-end bg-white" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel"
        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <div class="offcanvas-header bg-body-bg py-3 px-4 mb-4">
            <h5 class="offcanvas-title fs-18" id="offcanvasScrollingLabel">تنظیمات پوسته</h5> <button type="button"
                class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-4">
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">راست چین / چپ چین</h4>
            <div class="settings-btn rtl-btn"> <label id="switch" class="switch"> <input type="checkbox"
                        onchange="toggleTheme()" id="slider"> <span class="slider round"></span> </label> </div>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">روشن / تاریک</h4> <button
                class="switch-toggle settings-btn dark-btn" id="switch-toggle"> کلیک روی <span class="dark">تاریک</span>
                <span class="light">روشن</span> </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">فقط نوار کناری روشن / تاریک</h4> <button
                class="sidebar-light-dark settings-btn sidebar-dark-btn" id="sidebar-light-dark"> کلیک روی <span
                    class="dark1">تاریک</span> <span class="light1">روشن</span> </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">فقط هدر روشن / تاریک</h4> <button
                class="header-light-dark settings-btn header-dark-btn" id="header-light-dark"> کلیک روی <span
                    class="dark2">تاریک</span> <span class="light2">روشن</span> </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">فقط پاورقی روشن / تاریک</h4> <button
                class="footer-light-dark settings-btn footer-dark-btn" id="footer-light-dark"> کلیک روی <span
                    class="dark3">تاریک</span> <span class="light3">روشن</span> </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">شعاع / مربع سبک کارت</h4> <button
                class="card-radius-square settings-btn card-style-btn" id="card-radius-square"> کلیک روی <span
                    class="square">مربع</span> <span class="radius">شعاع</span> </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">سبک کارت پشت زمینه سفید / خاکستری</h4> <button
                class="card-bg settings-btn card-bg-style-btn" id="card-bg"> کلیک روی <span class="white">سفید</span>
                <span class="gray">خاکستری</span> </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">محتوای سبک کانتینری / جعبه دار</h4> <button
                class="boxed-style settings-btn fluid-boxed-btn" id="boxed-style"> کلیک روی <span
                    class="fluid">کانتینری</span> <span class="boxed">جعبه ای</span> </button>
        </div>
    </div>
    <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>assets/js/sidebar-menu.js"></script>
    <script src="<?=base_url()?>assets/js/dragdrop.js"></script>
    <script src="<?=base_url()?>assets/js/rangeslider.min.js"></script>
    <script src="<?=base_url()?>assets/js/sweetalert.js"></script>
    <script src="<?=base_url()?>assets/js/quill.min.js"></script>
    <script src="<?=base_url()?>assets/js/data-table.js"></script>
    <script src="<?=base_url()?>assets/js/prism.js"></script>
    <script src="<?=base_url()?>assets/js/clipboard.min.js"></script>
    <script src="<?=base_url()?>assets/js/feather.min.js"></script>
    <script src="<?=base_url()?>assets/js/simplebar.min.js"></script>
    <script src="<?=base_url()?>assets/js/fslightbox.js"></script>
    <script src="<?=base_url()?>assets/js/custom/custom.js"></script>
    <script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'8b8284780acc08e4',t:'MTcyNDQ5Mzg1OC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>
</body>

</html>