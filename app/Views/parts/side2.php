<div class="preloader" id="preloader">
    <div class="preloader">
        <div>
            <img src="<?= base_url() ?>assets/images/loader.gif" />
        </div>
    </div>
</div>
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="index.html" class="d-block text-decoration-none">
            <img src="assets/images/logo-icon.png" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">فارول</span>
        </a>
        <button
            class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-item">
            <a href="chat.html" class="menu-link">
                    <i data-feather="grid" class="menu-icon tf-icons"></i>
                    <span class="title">خانه</span>
                </a>
               
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">برنامه ها</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title">مدیر فایل</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="file-manager.html" class="menu-link"> درایو من </a>
                    </li>
                    <li class="menu-item">
                        <a href="documents.html" class="menu-link"> اسناد </a>
                    </li>
                    <li class="menu-item">
                        <a href="media.html" class="menu-link"> رسانه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="recents.html" class="menu-link"> اخیرا </a>
                    </li>
                    <li class="menu-item">
                        <a href="trash.html" class="menu-link"> زباله ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="assets.html" class="menu-link"> دارایی ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="projects-file.html" class="menu-link"> پروژه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="personal.html" class="menu-link"> شخصی </a>
                    </li>
                    <li class="menu-item">
                        <a href="templates.html" class="menu-link"> قالب ها </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="chat.html" class="menu-link">
                    <i data-feather="message-square" class="menu-icon tf-icons"></i>
                    <span class="title">گفتگو</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="mail" class="menu-icon tf-icons"></i>
                    <span class="title">ایمیل</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="inbox.html" class="menu-link"> صندوق ورودی </a>
                    </li>
                    <li class="menu-item">
                        <a href="read-email.html" class="menu-link"> مشاهده ایمیل </a>
                    </li>
                    <li class="menu-item">
                        <a href="snooozed.html" class="menu-link"> معوق </a>
                    </li>
                    <li class="menu-item">
                        <a href="draft.html" class="menu-link"> پیش نویس </a>
                    </li>
                    <li class="menu-item">
                        <a href="sent-mail.html" class="menu-link"> ارسال ایمیل </a>
                    </li>
                    <li class="menu-item">
                        <a href="trash-email.html" class="menu-link"> زباله ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="spam.html" class="menu-link"> هرزنامه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="starred.html" class="menu-link"> ستاره دار </a>
                    </li>
                    <li class="menu-item">
                        <a href="important.html" class="menu-link"> موارد مهم </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="to-do.html" class="menu-link">
                    <i data-feather="file-text" class="menu-icon tf-icons"></i>
                    <span class="title">لیست ماموریت</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="printer" class="menu-icon tf-icons"></i>
                    <span class="title">صورتحساب</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="invoice-list.html" class="menu-link"> لیست فاکتور </a>
                    </li>
                    <li class="menu-item">
                        <a href="invoice-details.html" class="menu-link"> جزئیات فاکتور </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="calender.html" class="menu-link">
                    <i data-feather="calendar" class="menu-icon tf-icons"></i>
                    <span class="title">تقویم</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="phone" class="menu-icon tf-icons"></i>
                    <span class="title">لیست مخاطبین</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="members-grid.html" class="menu-link"> شبکه اعضا </a>
                    </li>
                    <li class="menu-item">
                        <a href="members-list.html" class="menu-link"> لیست اعضا </a>
                    </li>
                    <li class="menu-item">
                        <a href="profile.html" class="menu-link"> پروفایل </a>
                    </li>
                </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">صفحات</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="life-buoy" class="menu-icon tf-icons"></i>
                    <span class="title">پروژه ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="clients.html" class="menu-link"> مشتریان </a>
                    </li>
                    <li class="menu-item">
                        <a href="team.html" class="menu-link"> تیم </a>
                    </li>
                    <li class="menu-item">
                        <a href="projects.html" class="menu-link"> پروژه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="kanban-board.html" class="menu-link"> هیئت کانبان </a>
                    </li>
                    <li class="menu-item">
                        <a href="task.html" class="menu-link"> وظایف </a>
                    </li>
                    <li class="menu-item">
                        <a href="task-details.html" class="menu-link"> جزئیات وظایف </a>
                    </li>
                    <li class="menu-item">
                        <a href="user.html" class="menu-link"> کاربر </a>
                    </li>
                    <li class="menu-item">
                        <a href="project-create.html" class="menu-link"> ایجاد پروژه </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="book" class="menu-icon tf-icons"></i>
                    <span class="title">آموزش مجازی</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="browse-courses.html" class="menu-link"> مرور دوره ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="course-details.html" class="menu-link"> جزئیات دوره </a>
                    </li>
                    <li class="menu-item">
                        <a href="lesson-preview.html" class="menu-link"> پیش نمایش درس </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="activity" class="menu-icon tf-icons"></i>
                    <span class="title">تجزیه و تحلیل</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="customers.html" class="menu-link"> مشتریان </a>
                    </li>
                    <li class="menu-item">
                        <a href="reports.html" class="menu-link"> گزارش ها </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="shopping-cart" class="menu-icon tf-icons"></i>
                    <span class="title">تجارت الکترونیک</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="products.html" class="menu-link"> محصولات </a>
                    </li>
                    <li class="menu-item">
                        <a href="product-details.html" class="menu-link"> جزئیات محصول </a>
                    </li>
                    <li class="menu-item">
                        <a href="create-product.html" class="menu-link"> ایجاد محصول </a>
                    </li>
                    <li class="menu-item">
                        <a href="orders-list.html" class="menu-link"> لیست سفارشات </a>
                    </li>
                    <li class="menu-item">
                        <a href="order-details.html" class="menu-link"> جزئیات سفارش </a>
                    </li>
                    <li class="menu-item">
                        <a href="customers-2.html" class="menu-link"> مشتریان </a>
                    </li>
                    <li class="menu-item">
                        <a href="cart.html" class="menu-link"> سبد خرید </a>
                    </li>
                    <li class="menu-item">
                        <a href="checkout.html" class="menu-link"> بررسی محصول </a>
                    </li>
                    <li class="menu-item">
                        <a href="sellers.html" class="menu-link"> فروشندگان </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="layers" class="menu-icon tf-icons"></i>
                    <span class="title">صفحات</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="profile-2.html" class="menu-link"> پروفایل </a>
                    </li>
                    <li class="menu-item">
                        <a href="pricing.html" class="menu-link"> قیمت گذاری </a>
                    </li>
                    <li class="menu-item">
                        <a href="timeline.html" class="menu-link"> جدول زمانی </a>
                    </li>
                    <li class="menu-item">
                        <a href="faq.html" class="menu-link"> سوالات متداول </a>
                    </li>
                    <li class="menu-item">
                        <a href="blogs.html" class="menu-link"> وبلاگ ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="blog-details.html" class="menu-link"> جزئیات وبلاگ </a>
                    </li>
                    <li class="menu-item">
                        <a href="gallery.html" class="menu-link"> گالری </a>
                    </li>
                    <li class="menu-item">
                        <a href="contact-us.html" class="menu-link"> تماس با ما </a>
                    </li>
                    <li class="menu-item">
                        <a href="404-error.html" class="menu-link"> خطا 404 </a>
                    </li>
                </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">کیت و عناصر رابط کاربری</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="copy" class="menu-icon tf-icons"></i>
                    <span class="title">عناصر رابط کاربری</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="alerts.html" class="menu-link"> هشدارها </a>
                    </li>
                    <li class="menu-item">
                        <a href="avatar.html" class="menu-link"> آواتار </a>
                    </li>
                    <li class="menu-item">
                        <a href="buttons.html" class="menu-link"> دکمه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="badges.html" class="menu-link"> نشان ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="cards.html" class="menu-link"> کارت ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="carousels.html" class="menu-link"> چرخ فلک ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="dropdowns.html" class="menu-link"> کشویی </a>
                    </li>
                    <li class="menu-item">
                        <a href="grids.html" class="menu-link"> شبکه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="images.html" class="menu-link"> تصاویر </a>
                    </li>
                    <li class="menu-item">
                        <a href="list.html" class="menu-link"> فهرست </a>
                    </li>
                    <li class="menu-item">
                        <a href="modals.html" class="menu-link"> مدال ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="navs.html" class="menu-link"> منو جهت یابی </a>
                    </li>
                    <li class="menu-item">
                        <a href="paginations.html" class="menu-link"> صفحه بندی ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="popover-tooltips.html" class="menu-link"> نکات ابزار </a>
                    </li>
                    <li class="menu-item">
                        <a href="progess.html" class="menu-link"> روند </a>
                    </li>
                    <li class="menu-item">
                        <a href="spinners.html" class="menu-link"> اسپینرها </a>
                    </li>
                    <li class="menu-item">
                        <a href="tabs.html" class="menu-link"> زبانه ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="accoridions.html" class="menu-link"> آکاردئون </a>
                    </li>
                    <li class="menu-item">
                        <a href="date-time-picker.html" class="menu-link"> انتخابگر تاریخ / زمان </a>
                    </li>
                    <li class="menu-item">
                        <a href="videos.html" class="menu-link"> ویدئو </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="clipboard" class="menu-icon tf-icons"></i>
                    <span class="title">رابط کاربری پیشرفته</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="animation.html" class="menu-link"> انیمیشن </a>
                    </li>
                    <li class="menu-item">
                        <a href="clip-board.html" class="menu-link"> تخته کلیپ </a>
                    </li>
                    <li class="menu-item">
                        <a href="drag-and-drop.html" class="menu-link"> کشیدن و رها کردن </a>
                    </li>
                    <li class="menu-item">
                        <a href="range-slider.html" class="menu-link"> لغزنده برد </a>
                    </li>
                    <li class="menu-item">
                        <a href="ratings.html" class="menu-link"> رتبه بندی ها </a>
                    </li>
                    <li class="menu-item">
                        <a href="toasts.html" class="menu-link"> توست </a>
                    </li>
                    <li class="menu-item">
                        <a href="sweet-alarts.html" class="menu-link"> هشدارهای شیرین </a>
                    </li>
                    <li class="menu-item">
                        <a href="scrollbar.html" class="menu-link"> نوارچرخ </a>
                    </li>
                    <li class="menu-item">
                        <a href="highlights.html" class="menu-link"> نکات برجسته </a>
                    </li>
                    <li class="menu-item">
                        <a href="scrollspy.html" class="menu-link"> اسکرول اسپای </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="file-minus" class="menu-icon tf-icons"></i>
                    <span class="title">فرم ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="basic-elements.html" class="menu-link"> عناصر پایه </a>
                    </li>
                    <li class="menu-item">
                        <a href="advanced-elements.html" class="menu-link"> عناصر پیشرفته </a>
                    </li>
                    <li class="menu-item">
                        <a href="validation.html" class="menu-link"> اعتبار سنجی </a>
                    </li>
                    <li class="menu-item">
                        <a href="wizard.html" class="menu-link"> جادوگر </a>
                    </li>
                    <li class="menu-item">
                        <a href="editors.html" class="menu-link"> ویراستاران </a>
                    </li>
                    <li class="menu-item">
                        <a href="file-upload.html" class="menu-link"> آپلود فایل </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="pie-chart" class="menu-icon tf-icons"></i>
                    <span class="title">نمودار</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="apex-charts.html" class="menu-link"> نمودار اوج </a>
                    </li>
                    <li class="menu-item">
                        <a href="amcharts.html" class="menu-link"> آمچارت ها </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="table" class="menu-icon tf-icons"></i>
                    <span class="title">جداول</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="basic-table.html" class="menu-link"> جدول پایه </a>
                    </li>
                    <li class="menu-item">
                        <a href="data-tables.html" class="menu-link"> جدول داده </a>
                    </li>
                    <li class="menu-item">
                        <a href="editable.html" class="menu-link"> جدول قابل ویرایش </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="bookmark" class="menu-icon tf-icons"></i>
                    <span class="title">نمادها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="feathericon.html" class="menu-link"> نماد پر </a>
                    </li>
                    <li class="menu-item">
                        <a href="flaticon.html" class="menu-link"> فلت آیکون </a>
                    </li>
                    <li class="menu-item">
                        <a href="remixicon.html" class="menu-link"> نماد ریمیکس </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="map" class="menu-icon tf-icons"></i>
                    <span class="title">نقشه ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="google-map.html" class="menu-link"> نقشه گوگل </a>
                    </li>
                    <li class="menu-item">
                        <a href="vector-map.html" class="menu-link"> نقشه برداری </a>
                    </li>
                    <li class="menu-item">
                        <a href="leaflet-maps.html" class="menu-link"> نقشه های جزوه </a>
                    </li>
                </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">تنظیمات و سایرین</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="lock" class="menu-icon tf-icons"></i>
                    <span class="title">احراز هویت</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="login.html" class="menu-link"> ورود کاربران </a>
                    </li>
                    <li class="menu-item">
                        <a href="register.html" class="menu-link"> ثبت نام </a>
                    </li>
                    <li class="menu-item">
                        <a href="signin-signup.html" class="menu-link"> ورود - ثبت نام </a>
                    </li>
                    <li class="menu-item">
                        <a href="reset-password.html" class="menu-link"> بازیابی گذرواژه </a>
                    </li>
                    <li class="menu-item">
                        <a href="forget-password.html" class="menu-link"> فراموشی گذرواژه </a>
                    </li>
                    <li class="menu-item">
                        <a href="lock-screen.html" class="menu-link"> صفحه قفل </a>
                    </li>
                    <li class="menu-item">
                        <a href="logout.html" class="menu-link"> خروج </a>
                    </li>
                    <li class="menu-item">
                        <a href="confirm-mail.html" class="menu-link"> تایید ایمیل </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item open">
                <a href="notification.html" class="menu-link active">
                    <i data-feather="bell" class="menu-icon tf-icons"></i>
                    <span class="title">اطلاعات</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="settings" class="menu-icon tf-icons"></i>
                    <span class="title">تنظیمات</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="profile-3.html" class="menu-link"> پروفایل </a>
                    </li>
                    <li class="menu-item">
                        <a href="account.html" class="menu-link"> حساب </a>
                    </li>
                    <li class="menu-item">
                        <a href="security.html" class="menu-link"> امنیت </a>
                    </li>
                    <li class="menu-item">
                        <a href="connections.html" class="menu-link"> اتصالات </a>
                    </li>
                    <li class="menu-item">
                        <a href="privacy-policy.html" class="menu-link"> حریم خصوصی </a>
                    </li>
                    <li class="menu-item">
                        <a href="terms-conditions.html" class="menu-link"> شرایط و ضوابط </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="chevrons-down" class="menu-icon tf-icons"></i>
                    <span class="title">سطح یک</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item after-sub-menu">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <span class="title">سطح یک</span>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="notification.html#" class="menu-link"> سطح سه </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>