<style>
    .overflow-auto{
        overflow:inherit !important ;
    }
</style>

<div class="preloader" id="preloader">
    <div class="preloader">
        <div>
            <img src="
                <?php echo base_url()?>assets/images/loader.gif" />
        </div>
    </div>
</div>
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="<?php echo base_url()?>" class="d-block text-decoration-none">
            <img src="<?php echo base_url()?>assets/images/logo.png" alt="logo-icon" width="50">
            <span class="logo-text fw-bold text-dark">پویش تاکسی</span>
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
                <a href="<?php echo base_url()?>" class="menu-link">
                    <i data-feather="grid" class="menu-icon tf-icons"></i>
                    <span class="title">خانه</span>
                </a>

            </li>


            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">مدیریت سفارشات</span>
            </li>

            <li class="menu-item">
                <a href="<?php echo base_url()?>Trips/New" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                        <path d="m12,13c0,1.657-2.686,3-6,3S0,14.657,0,13s2.686-3,6-3,6,1.343,6,3Zm0,5.5v2c0,1.995-2.579,3.5-6,3.5s-6-1.505-6-3.5v-2c0,1.971,2.5,3.5,6,3.5s6-1.529,6-3.5Zm0-4v2c0,1.995-2.579,3.5-6,3.5s-6-1.505-6-3.5v-2c0,1.971,2.5,3.5,6,3.5s6-1.529,6-3.5Zm6-8.5h-8v2h8v-2Zm1-6h-10c-2.757,0-5,2.243-5,5v3.139c.633-.091,1.302-.139,2-.139s1.367.048,2,.139v-2.139c0-1.103.897-2,2-2h8c1.103,0,2,.897,2,2v2c0,1.103-.897,2-2,2h-5.469c.655.574,1.112,1.25,1.328,2h1.14c.553,0,1,.448,1,1v1c0,.552-.447,1-1,1h-1v2h5c.553,0,1,.448,1,1s-.447,1-1,1h-5v1.5c0,1.365-.617,2.569-1.687,3.5h6.687c2.757,0,5-2.243,5-5V5c0-2.757-2.243-5-5-5Zm1,14c0,.552-.447,1-1,1s-1-.448-1-1v-1c0-.552.447-1,1-1s1,.448,1,1v1Z" />
                    </svg>





                    <span class="title">استعلام کرایه </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo base_url()?>Trips" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 10px;" class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2a7 7 0 0 0-7 7 3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V9a5 5 0 1 1 10 0v7.083A2.919 2.919 0 0 1 14.083 19H14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a2 2 0 0 0 1.732-1h.351a4.917 4.917 0 0 0 4.83-4H19a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3 7 7 0 0 0-7-7Zm1.45 3.275a4 4 0 0 0-4.352.976 1 1 0 0 0 1.452 1.376 2.001 2.001 0 0 1 2.836-.067 1 1 0 1 0 1.386-1.442 4 4 0 0 0-1.321-.843Z" clip-rule="evenodd" />
                    </svg>



                    <span class="title">استعلام ها و سرویس ها</span>
                </a>
            </li>





            <li class="menu-item">
                <a href="<?php echo base_url()?>Service" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 10px;" class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2a7 7 0 0 0-7 7 3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V9a5 5 0 1 1 10 0v7.083A2.919 2.919 0 0 1 14.083 19H14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a2 2 0 0 0 1.732-1h.351a4.917 4.917 0 0 0 4.83-4H19a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3 7 7 0 0 0-7-7Zm1.45 3.275a4 4 0 0 0-4.352.976 1 1 0 0 0 1.452 1.376 2.001 2.001 0 0 1 2.836-.067 1 1 0 1 0 1.386-1.442 4 4 0 0 0-1.321-.843Z" clip-rule="evenodd" />
                    </svg>



                    <span class="title">سرویس های جاری</span>
                </a>
            </li>



            <li class="menu-item">
                <a href="<?php echo base_url()?>Search/Trips" class="menu-link">



                    <svg class="feather feather-dollar-sign menu-icon tf-icons"  style="margin-left: 10px;" class="w-[30px] h-[30px] text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>



                    <span class="title">جستجوی سرویس</span>
                </a>
            </li>




            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">گزارشات</span>
            </li>



            <li class="menu-item">
                <a href="<?php echo base_url()?>Report/All" class="menu-link">



                    <svg class="feather feather-dollar-sign menu-icon tf-icons" width="800px" height="800px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>report-barchart</title>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="add" fill="#000000" transform="translate(42.666667, 85.333333)">
                                <path d="M341.333333,1.42108547e-14 L426.666667,85.3333333 L426.666667,341.333333 L3.55271368e-14,341.333333 L3.55271368e-14,1.42108547e-14 L341.333333,1.42108547e-14 Z M330.666667,42.6666667 L42.6666667,42.6666667 L42.6666667,298.666667 L384,298.666667 L384,96 L330.666667,42.6666667 Z M106.666667,85.3333333 L106.666,234.666 L341.333333,234.666667 L341.333333,256 L85.3333333,256 L85.3333333,85.3333333 L106.666667,85.3333333 Z M170.666667,149.333333 L170.666667,213.333333 L128,213.333333 L128,149.333333 L170.666667,149.333333 Z M234.666667,106.666667 L234.666667,213.333333 L192,213.333333 L192,106.666667 L234.666667,106.666667 Z M298.666667,170.666667 L298.666667,213.333333 L256,213.333333 L256,170.666667 L298.666667,170.666667 Z" id="Combined-Shape"></path>
                            </g>
                        </g>
                    </svg>



                    <span class="title">گزارش کلی</span>
                </a>
            </li>


            <li class="menu-item">
                <a href="<?php echo base_url()?>Report/Drivers" class="menu-link">


                    <svg class="feather feather-dollar-sign menu-icon tf-icons"  width="800px" height="800px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
 
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Dribbble-Light-Preview" transform="translate(-340.000000, -2399.000000)" fill="#000000">
                    <g id="icons" transform="translate(56.000000, 160.000000)">
                        <path d="M300.232,2253.984 L295.883,2249.627 C295.948,2249.429 295.965,2249.22 295.965,2249 C295.965,2248.287 296,2247.666 295,2247.311 L295,2241.079 C299,2241.601 301.969,2244.95 301.969,2249 C301.969,2250.884 301.326,2252.615 300.232,2253.984 M294,2257 C289.929,2257 286.565,2253.94 286.07,2250 L292.278,2250 C292.702,2250.729 293.533,2251.133 294.395,2250.96 L298.812,2255.376 C297.471,2256.391 295.807,2257 294,2257 M293,2241.06 L293,2247.244 C293,2247.419 292.464,2247.68 292.278,2248 L286.07,2248 C286.526,2244.368 289,2241.488 293,2241.06 M294,2239 C288.478,2239 284,2243.477 284,2249 C284,2254.523 288.478,2259 294,2259 C299.523,2259 304,2254.523 304,2249 C304,2243.477 299.523,2239 294,2239" id="wheel-[#1295]">

        </path>
                    </g>
                </g>
            </g>
        </svg>


                    <span class="title"> کارکرد راننده ها</span>
                </a>
            </li>




            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">مدیریت وسایل نقلیه</span>
            </li>




            <li class="menu-item">
                <a href="<?php echo base_url()?>all-drivers" class="menu-link">
                    <svg style="opacity:0.8" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-dollar-sign menu-icon tf-icons">
                        <g id="steering-wheel" transform="translate(-2 -2)">
                            <path id="secondary" fill="#2ca9bc"
                                d="M21,12a7.56,7.56,0,0,1,0,.83l-2.1-.29A4.38,4.38,0,0,0,14,16.89v3.89a9.2,9.2,0,0,1-4,0V16.89a4.38,4.38,0,0,0-4.86-4.35L3,12.83A7.56,7.56,0,0,1,3,12a8.84,8.84,0,0,1,.46-2.83,31.75,31.75,0,0,1,17.08,0A8.84,8.84,0,0,1,21,12Z" />
                            <path id="primary" d="M14,20.62V16.89a4.38,4.38,0,0,1,4.86-4.35l2,.23" fill="none"
                                stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            <path id="primary-2" data-name="primary" d="M3.16,12.77l2-.23A4.38,4.38,0,0,1,10,16.89v3.73"
                                fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" />
                            <path id="primary-3" data-name="primary"
                                d="M20.37,9.17A29.38,29.38,0,0,0,12,8,29,29,0,0,0,3.51,9.21" fill="none"
                                stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            <circle id="primary-4" data-name="primary" cx="9" cy="9" r="9" transform="translate(3 3)"
                                fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" />
                        </g>
                    </svg>
                    <span class="title">رانندگان</span>
                </a>

            </li>


            <li class="menu-item">
                <a href="<?php echo base_url()?>add-driver" class="menu-link">
                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 15px;" height="30" width="30" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 508 508" xml:space="preserve">
                        <circle style="fill:#324A5E;" cx="254" cy="254" r="254" />
                        <path style="fill:#2C9984;"
                            d="M438,428.8c-45.6,48-110,78.4-181.6,79.2l0,0c-0.8,0-1.6,0-2.4,0c-72.4,0-138-30.4-184-79.2l0,0
                c17.2-59.6,54.8-63.6,54.8-63.6c49.2-23.6,78.8-57.2,80.4-59.2h97.2c1.6,2,31.2,35.6,80.8,59.2C383.2,365.2,421.2,369.2,438,428.8z" />
                        <path style="fill:#FFD05B;" d="M307.2,437.2v-126c-3.6-2.4-6.8-6-8.4-10c-1.2-2.4-2-5.2-2.4-8.4l-4-53.6h-76.8l-2.8,40.4l0,0
                l-0.8,13.2c-0.4,8-5.2,14.8-11.6,18.8v125.2l53.6,60.4L307.2,437.2z" />
                        <path style="fill:#F9B54C;" d="M298.8,301.2L298.8,301.2c-64.4,50.8-85.6-19.2-86-21.6l0,0l2.8-40.4h77.2l4,53.6
                C296.8,296,297.2,298.8,298.8,301.2z" />
                        <polygon style="fill:#E6E9EE;" points="312,432.4 312,338 196,338 196,432.4 254,500 " />
                        <polygon style="fill:#F1543F;" points="264.8,355.2 270.4,338 237.6,338 243.2,355.2 " />
                        <polygon style="fill:#FF7058;"
                            points="291.2,450.8 264.8,355.2 243.2,355.2 216.8,450.8 254,494.8 " />
                        <path style="fill:#4CDBC4;" d="M329.2,436l-14.4-33.2h39.6c-10-46-36.8-80-49.6-94.4c-1.2-1.6-2.4-2.4-2.4-2.8H300
                                                    c4,10.4,10.8,39.6-8.8,82c0,0-20.4,58.8-37.6,106.4C236.4,446.4,216,387.6,216,387.6c-19.6-42.4-12.4-71.6-8.8-82h-2.4
                                                    c-0.4,0.4-1.2,1.2-2.4,2.8c-12.4,14-39.2,48.4-49.6,94.4h39.6L178,436c25.2,13.6,67.2,66.4,71.6,72c1.2,0,2.4,0,4,0
                                                    c0.8,0,1.6,0,2.4,0l0,0c0.4,0,0.8,0,1.2,0C262.4,502,304,449.6,329.2,436z" />
                        <path style="fill:#2B3B4E;" d="M334.8,200.8c2.8-8.4,4.4-17.2,4.4-26.4c0-46.4-38.4-84-85.2-84c-47.2,0-85.2,37.6-85.2,84
                c0,9.2,1.6,18,4.4,26.4H334.8z" />
                        <path style="fill:#FFD05B;" d="M338.8,185.6c-3.2-1.6-7.2-0.8-10.8,2c-0.8-49.6-33.6-67.6-74-67.6s-73.2,18-73.6,67.6
                c-4-2.8-7.6-3.6-10.8-2c-6.4,3.6-7.2,15.6-2,27.6c4.8,10.8,12.8,17.2,18.8,16c11.2,38.8,37.2,73.6,67.6,73.6s56.4-35.2,67.6-73.6
                c6,1.2,14.4-5.2,18.8-16C346,201.2,344.8,188.8,338.8,185.6z" />
                        <ellipse style="fill:#2B3B4E;" cx="254" cy="139.6" rx="70.4" ry="34.4" />
                        <path style="fill:#4CDBC4;" d="M176,119.2h156.4c15.6-6,27.6-14.4,32.4-24C378,68,330,40.8,254,40.8S130,68.4,143.6,95.2
                C148.4,104.8,160.4,113.2,176,119.2z" />
                        <g>
                            <path style="fill:#2C9984;" d="M176,119.2c50-16.4,106.4-16.4,156.4,0c0,7.2,0,14.4,0,21.6c-52,0-104.4,0-156.4,0
                    C176,133.6,176,126.4,176,119.2z" />
                            <circle style="fill:#2C9984;" cx="254" cy="77.6" r="17.6" />
                        </g>
                        <g>
                            <path style="fill:#FFFFFF;"
                                d="M298.8,301.6c0,0-3.2,18-44.8,36.4c0,0,30.8,19.2,36.4,34.8C290.4,372.8,318.8,334,298.8,301.6z" />
                            <path style="fill:#FFFFFF;"
                                d="M209.6,301.6c0,0,3.2,18,44.4,36.4c0,0-30.8,19.2-36.4,34.8C217.6,372.8,189.2,334,209.6,301.6z" />
                        </g>
                        <path style="fill:#324A5E;" d="M254,250.4c-14-7.2-19.6,14.4-42,2c0,0,8.8,24.4,42,9.6c33.2,14.4,42-9.6,42-9.6
                C273.6,264.8,268,243.2,254,250.4z" />
                    </svg>
                    <span class="title">افزودن راننده</span>
                </a>

            </li>


            <li class="menu-item" style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle active"> <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 10px;;" class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4" />
                    </svg>

                    <span class="title">تنظیمات</span> </a>
                <ul class="menu-sub">
                    <li class="menu-item"> <a href="<?php echo base_url()?>Brands" class="menu-link"> برند خودرو </a> </li>
                    <li class="menu-item"> <a href="<?php echo base_url()?>Type" class="menu-link"> تیپ خودرو </a> </li>
                    <li class="menu-item"> <a href="<?php echo base_url()?>Company" class="menu-link"> لیست شرکت ها </a> </li>
                    <li class="menu-item"> <a href="<?php echo base_url()?>Option/Packages" class="menu-link">  پکیج ها </a> </li>
                    <li class="menu-item"> <a href="<?php echo base_url()?>Option/Other" class="menu-link">  ضرایب اضافه  </a> </li>
                    <li class="menu-item"> <a href="<?php echo base_url()?>Option/Banks" class="menu-link">  حساب بانکی  </a> </li>
                    <li class="menu-item"> <a href="<?php echo base_url()?>Option/App" class="menu-link">  اپلیکیشن  </a> </li>
                </ul>
            </li>





            <li class="menu-item">
                <a href="<?php echo base_url()?>Cars" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 15px;" fill="#000000" height="800px" width="800px" version="1.1"
                        id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 229.98 229.98" xml:space="preserve">
                        <path
                            d="M223.211,127.002c-0.717,0-1.451,0.102-2.185,0.304l-8.301,2.286l-8.618-20.995c-2.441-5.948-9.659-10.787-16.089-10.787
                    h-27.84V81.719c0-5.972-1.846-15.328-4.114-20.855l-1.391-3.388h1.054c4.819,0,8.74-3.921,8.74-8.74v-4.894
                    c0-4.128-2.847-7.125-6.769-7.125c-0.717,0-1.451,0.103-2.185,0.304l-8.3,2.286l-8.619-20.995
                    c-2.441-5.948-9.659-10.787-16.089-10.787H41.846c-6.429,0-13.646,4.839-16.089,10.787l-8.607,20.967l-8.195-2.257
                    c-0.733-0.202-1.469-0.305-2.185-0.305C2.847,36.717,0,39.713,0,43.842v4.894c0,4.819,3.921,8.74,8.74,8.74h0.939l-1.391,3.388
                    c-2.269,5.525-4.114,14.88-4.114,20.855v41.71c0,4.819,3.921,8.74,8.74,8.74h11.417c4.819,0,8.74-3.921,8.74-8.74v-10.416h56.384
                    l-6.794,16.55l-8.196-2.258c-0.733-0.202-1.468-0.304-2.185-0.304c-3.922,0-6.769,2.997-6.769,7.125v4.894
                    c0,4.819,3.921,8.74,8.74,8.74h0.939l-1.392,3.389c-2.268,5.525-4.114,14.88-4.114,20.855v41.71c0,4.819,3.921,8.74,8.74,8.74
                    h11.416c4.819,0,8.74-3.921,8.74-8.74v-10.416h98.212v10.416c0,4.819,3.921,8.74,8.74,8.74h11.415c4.819,0,8.74-3.921,8.74-8.74
                    v-41.71c0-5.975-1.846-15.33-4.114-20.855l-1.391-3.389h1.055c4.819,0,8.74-3.921,8.74-8.74v-4.894
                    C229.98,129.998,227.133,127.002,223.211,127.002z M143.357,81.011v11.886c0,1.923-1.573,3.496-3.496,3.496h-24.767
                    c-1.923,0-3.496-1.573-3.496-3.496V81.011c0-1.923,1.573-3.496,3.496-3.496h24.767C141.784,77.515,143.357,79.088,143.357,81.011z
                    M52.521,92.897c0,1.923-1.573,3.496-3.496,3.496H24.259c-1.923,0-3.496-1.573-3.496-3.496V81.011c0-1.923,1.573-3.496,3.496-3.496
                    h24.767c1.923,0,3.496,1.573,3.496,3.496V92.897z M27.755,59.197c-3.846,0-5.797-2.911-4.337-6.469l13.036-31.757
                    c1.461-3.558,5.802-6.469,9.647-6.469h72.149c3.846,0,8.188,2.911,9.647,6.469l13.038,31.757c1.46,3.558-0.491,6.469-4.337,6.469
                    H27.755z M88.929,143.013l13.037-31.757c1.46-3.558,5.802-6.469,9.647-6.469h72.149c3.846,0,8.188,2.911,9.648,6.469l13.036,31.757
                    c1.461,3.558-0.491,6.469-4.337,6.469H93.266C89.42,149.482,87.469,146.571,88.929,143.013z M118.033,183.182
                    c0,1.923-1.573,3.496-3.496,3.496H89.77c-1.923,0-3.496-1.573-3.496-3.496v-11.886c0-1.923,1.573-3.496,3.496-3.496h24.768
                    c1.923,0,3.496,1.573,3.496,3.496V183.182z M208.867,183.182c0,1.923-1.573,3.496-3.496,3.496h-24.766
                    c-1.923,0-3.496-1.573-3.496-3.496v-11.886c0-1.923,1.573-3.496,3.496-3.496h24.766c1.923,0,3.496,1.573,3.496,3.496V183.182z" />
                    </svg>
                    <span class="title">خودرو ها</span>
                </a>
            </li>



          







            <li class="menu-item">
                <a href="<?php echo base_url()?>Contacts" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 10px;" class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                    </svg>


                    <span class="title">مشترکین</span>
                </a>
            </li>




            <li class="menu-item">
                <a href="<?php echo base_url()?>Transactions" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 10px;" class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <line x1="12" y1="1" x2="12" y2="23"></line><path  stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"   d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>


                    <span class="title">تراکنش ها</span>
                </a>
            </li>


            <li class="menu-item">
                <a href="<?php echo base_url()?>auth/logout" class="menu-link">
                    <svg class="feather feather-dollar-sign menu-icon tf-icons" style="margin-left: 10px;" width="1024px"  height="1024px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                        <path d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 0 1-112.7 75.9A352.8 352.8 0 0 1 512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 0 1-112.7-75.9 353.28 353.28 0 0 1-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 0 0 0-12.6z" />
                    </svg>


                    <span class="title">خروج</span>
                </a>
            </li>







        </ul>
    </aside>
</div>