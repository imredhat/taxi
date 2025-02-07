<?php


$session = service('session');
$name =  $session -> user_name;;


        ?>
<!DOCTYPE html>
<html class="rtl">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" href="<?=base_url()?>assets/images/logo.png">

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


<style>

.h1, .h2, .h3, h1, h2, h3 {
    margin-top: auto !important;
    
}

</style>
<title>پویش تاکسی </title>
</head>
<body>







<div class="container-fluid">
        <div class="main-content d-flex flex-column">
            <header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-6 col-md-4">
                        <div class="left-header-content">
                            <ul
                                class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                <li> <button class="header-burger-menu bg-transparent p-0 border-0"
                                        id="header-burger-menu"> <i data-feather="menu"></i> </button> </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-6 col-md-8">
                        <div class="right-header-content mt-2 mt-sm-0">
                            <ul
                                class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                           
                               
                                <li class="header-right-item">
                                    <div class="dropdown notifications noti"> <button
                                            class="btn btn-secondary border-0 p-0 position-relative badge" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"> <i data-feather="bell"></i>
                                        </button>
                                        <!-- <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                            <h5
                                                class="m-0 p-0 fw-bold d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                                                <span>اطلاعیه </span> <button
                                                    class="p-0 m-0 bg-transparent border-0">حذف همه</button> </h5>
                                            <div class="notification-menu"> <a href="notification.html"
                                                    class="dropdown-item p-0">
                                                    <h4>8 فاکتور پرداخت شده است</h4>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0"> <img src="<?=base_url()?>assets/images/pdf.svg"
                                                                alt="pdf"> </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <p>فاکتورها به شرکت پرداخت شده است.</p>
                                                        </div>
                                                    </div> <span>ساعت 23:47 چهارشنبه</span>
                                                </a> </div>
                                            <div class="notification-menu mb-0"> <a href="notification.html"
                                                    class="dropdown-item p-0">
                                                    <h4>ایجاد یک پروژه جدید</h4>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0"> <img
                                                                src="<?=base_url()?>assets/images/notifications-1.jpg"
                                                                alt="notifications"> </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <p>به کاربران اجازه دهید محصولات موجود در ووکامرس شما را
                                                                دنبال کنند</p>
                                                        </div>
                                                    </div> <span>21 دی 1402</span>
                                                </a> </div> <a href="notification.html"
                                                class="dropdown-item text-center text-primary d-block view-all pt-3 pb-0 fw-semibold">
                                                مشاهده همه <i data-feather="chevron-left"></i> </a>
                                        </div> -->
                                    </div>
                                </li>
                                <!-- <li class="header-right-item d-none d-md-block">
                                    <div class="today-date"> <span id="digitalDate"></span> <i
                                            data-feather="calendar"></i> </div>
                                </li> -->
                                <li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor"
                                            data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0"> <img class="rounded-circle wh-54"
                                                    src="<?=base_url()?>assets/images/admin.jpg" alt="admin"> </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-xxl-block"> <span
                                                            class="degeneration">مدیر</span>
                                                        <div class="d-flex align-content-center">
                                                            <h3><?= $name; ?></h3>
                                                            <div class="down"> <i data-feather="chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                            <li> <a class="dropdown-item d-flex align-items-center text-body"
                                                    href="profile.html"> <i data-feather="user"></i> <span
                                                        class="ms-2">پروفایل</span> </a> </li>
                                            <li> <a class="dropdown-item d-flex align-items-center text-body"
                                                    href="account.html"> <i data-feather="settings"></i> <span
                                                        class="ms-2">تنظیمات</span> </a> </li>
                                            <li> <a class="dropdown-item d-flex align-items-center text-body"
                                                    href="logout.html"> <i data-feather="log-out"></i> <span
                                                        class="ms-2">خروج</span> </a> </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>