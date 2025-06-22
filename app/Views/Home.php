<?php
$All = $Report['totalIn'] - $Report['totalOut'];
$LastMonthAll = $lastMonth['totalIn'] - $lastMonth['totalOut'];

?>
<div class="row justify-content-center">

<?php if ($BestDriver !="") : ?>
    <div class="col-xxl-4 col-sm-12">
        <div class="stats-box style-six style-five bg-white card border-0 rounded-10 mb-4 overflow-hidden">
            <div class="card-body p-4">



                <div class="d-flex justify-content-between align-items-center">
                    <div> <img src="<?= base_url() ?>uploads/drivers/<?= $BestDriver['did'] ?>/<?= $BestDriver['ax'] ?>"
                            class="rounded-circle border wh-57 mb-4" alt="user">
                        <h4 class="fs-16 fw-semibold mb-1"><?= $BestDriver['name'] . ' ' . $BestDriver['lname'] ?></h4> <span class="fs-14">بهترین راننده</span>
                    </div>
                    <div class="text-end">
                        <div id="impression_share"></div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-xxl-4 col-sm-6">
        <div class="stats-box style-five style-five bg-white card border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-4"> <i
                        class="ri-money-dollar-circle-line bg-primary twxt-white"></i>
                    <div class="text-end">
                        <h4 class="mb-1 body-font fs-24"><?= number_format($Report['totalIn']); ?> تومان</h4> <span>مجموع دریافتی</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2"> <span class="fw-semibold">هدف درآمد</span>
                    <span><?= number_format(1000000000); ?> تومان</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Example 5px high" aria-valuenow="
                            
                            <?php
                            if ($All == 0) {
                                echo 0;
                            } else {
                                echo $Precent = ($Report['totalIn'] / 1000000000) * 100;
                            }
                            ?>
                            
                            "
                    aria-valuemin="0" aria-valuemax="100" style="height: 5px; background-color: #E9EFFC;">
                    <div class="progress-bar rounded-pill" style="width: <?php
                                                                            if ($All == 0) {
                                                                                echo 0;
                                                                            } else {
                                                                                echo $Precent = ($Report['totalIn'] / 1000000000) * 100;
                                                                            }

                                                                            ?>%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-6">
        <div class="stats-box style-five style-five bg-white card border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-4"> <i
                        class="ri-bar-chart-fill bg-primary twxt-white"></i>
                    <div class="text-end">
                        <h4 class="mb-1 body-font fs-24"><?= number_format($Report['totalOut']); ?> تومان</h4> <span>مجموع پرداختی</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2"> <span class="fw-semibold">سفارش هدف</span>
                    <span><?= number_format(1000000000); ?> تومان</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Example 5px high" aria-valuenow="
                            
                            <?php
                            if ($All == 0) {
                                echo 0;
                            } else {
                                echo $Precent = ($Report['totalOut'] / 1000000000) * 100;
                            }
                            ?>
                            
                            "
                    aria-valuemin="0" aria-valuemax="100" style="height: 5px; background-color: #E9EFFC;">
                    <div class="progress-bar rounded-pill" style="width: <?php
                                                                            if ($All == 0) {
                                                                                echo 0;
                                                                            } else {
                                                                                echo $Precent = ($Report['totalOut'] / 1000000000) * 100;
                                                                            }

                                                                            ?>%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-xl-3 col-sm-6">
        <div class="stats-box style-seven card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <div> <span class="fw-semibold"> سفارشات</span> <span
                            class="d-block fw-bold text-dark fs-24 mt-2"><?= number_format($Report['AllType']) ?></span> </div>
                    <div class="icons"> <i class="ri-stack-line"></i> </div>
                </div>



                <?php
                if ($Report['AllType'] > $lastMonth['AllType']) : ?>

                    <p class="fs-14"> <span class="bg-success bg-opacity-10 px-2 py-1 fs-13 fw-semibold">%<?= round(($Report['AllType'] / $lastMonth['AllType']) * 100) ?>
                            <i class="ri-arrow-up-s-line"></i></span> آمار این ماه </p>
                <?php else: ?>
                    <p class="fs-14"> <span class="bg-danger text-danger bg-opacity-10 px-2 py-1 fs-13 fw-semibold">%<?= round(($Report['AllType'] / $lastMonth['AllType']) * 100) ?>
                        <?php endif; ?>




            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stats-box style-seven card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <div> <span class="fw-semibold">درآمد کلی</span> <span
                            class="d-block fw-bold text-dark fs-24 mt-2"><?= number_format($Report['totalIn'] - $Report['totalOut']) ?> تومان</span> </div>
                    <div class="icons"> <i class="ri-pie-chart-line"></i> </div>
                </div>
                <p class="fs-14"> <span


                        <?php if ($All > $LastMonthAll) { ?>
                        class="bg-success bg-opacity-10 px-2 py-1 fs-13 fw-semibold">%<?= (round($All / $LastMonthAll) * 100) ?> <i
                            class="ri-arrow-up-s-line"></i></span> آمار این ماه </p>
            <?php } else { ?>
                class="bg-danger text-danger bg-opacity-10 px-2 py-1 fs-13 fw-semibold">%<?= round(($All / $LastMonthAll) * 100) ?> <i
                    class="ri-arrow-down-s-line"></i></span> آمار این ماه </p>
            <?php } ?>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stats-box style-seven card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <div> <span class="fw-semibold">میانگین کرایه</span> <span
                            class="d-block fw-bold text-dark fs-24 mt-2"><?= number_format($UserCustomFare) ?> تومان</span> </div>
                    <div class="icons"> <i class="ri-money-cny-box-line"></i> </div>
                </div>

                <?php if($Report['averageUserCustomFare'] > $lastMonth['averageUserCustomFare'] ) :?>
                <p class="fs-14"> <span class="bg-success bg-opacity-10 px-2 py-1 fs-13 fw-semibold">%<?= round(($Report['averageUserCustomFare'] / $lastMonth['averageUserCustomFare']) * 100) ?>
                        <i class="ri-arrow-up-s-line"></i></span> آمار این ماه </p>
                <?php else: ?>

                <p class="fs-14"> <span class="bg-danger text-danger bg-opacity-10 px-2 py-1 fs-13 fw-semibold">%<?= round(($Report['averageUserCustomFare'] / $lastMonth['averageUserCustomFare']) * 100) ?>
                        <i class="ri-arrow-down-s-line"></i></span> آمار این ماه </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stats-box style-seven card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <div> <span class="fw-semibold">کل مشتریان</span> <span
                            class="d-block fw-bold text-dark fs-24 mt-2"><?= number_format($TotalUsers) ?></span> </div>
                    <div class="icons"> <i class="ri-user-follow-line"></i> </div>
                </div>
                <p class="fs-14"> <br/> </p>
            </div>
        </div>
    </div>
</div>



<div class="flex-grow-1"></div>
<footer class="footer-area bg-white text-center rounded-top-10">
    <p class="fs-14">© <span class="text-primary">رزم</span>. تمام حقوق قالب محفوظ است. طراحی و توسعه
        توسط <a href="https://www.razem.ir" target="_blank">رزم</>
    </p>
</footer>
</div>
</div>



<script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>

<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/sidebar-menu.js"></script>
<script src="<?= base_url() ?>assets/js/dragdrop.js"></script>
<script src="<?= base_url() ?>assets/js/rangeslider.min.js"></script>
<script src="<?= base_url() ?>assets/js/sweetalert.js"></script>
<script src="<?= base_url() ?>assets/js/quill.min.js"></script>
<script src="<?= base_url() ?>assets/js/data-table.js"></script>
<script src="<?= base_url() ?>assets/js/prism.js"></script>
<script src="<?= base_url() ?>assets/js/clipboard.min.js"></script>
<script src="<?= base_url() ?>assets/js/feather.min.js"></script>
<script src="<?= base_url() ?>assets/js/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets/js/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/js/sass-app.js"></script>
<script src="<?= base_url() ?>assets/js/custom/custom.js"></script>

<script>
    // Impression Share

    var count = "<?php $count ?? 0 ?>";
    var total = "<?= $TotalPackageTrip ?? 0 ?>";
    var percent = Math.round((count / total) * 100);

    var options = {
        series: [percent],
        chart: {
            height: 205,
            type: 'radialBar',
            offsetY: -10,
            offsetX: 85
        },
        colors: ['#2DB6F5'],
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                offsetY: -10,
                dataLabels: {
                    name: {
                        fontSize: '12px',
                        offsetY: 60,
                        color: '#2DB6F5',
                        offsetY: 40,
                    },
                    value: {
                        offsetY: 76,
                        fontSize: '15px',
                        fontWeight: 600,
                        color: '#5B5B98',
                        offsetY: -10,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                },
                hollow: {
                    margin: 0,
                    size: "40%",
                    background: "#ffffff"
                },
            }
        },
        labels: ['<?= $Package ?? "" ?>'],
        responsive: [{
            breakpoint: 475,
            options: {
                chart: {
                    offsetY: -15,
                    offsetX: 25
                },
            },
        }]
    };
    var chart = new ApexCharts(document.querySelector("#impression_share"), options);
    chart.render();
</script>


<script>
    (function() {
        function c() {
            var b = a.contentDocument || a.contentWindow.document;
            if (b) {
                var d = b.createElement('script');
                d.innerHTML = "window.__CF$cv$params={r:'8b8282f87e387e7c',t:'MTcyNDQ5Mzc5Ny4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                b.getElementsByTagName('head')[0].appendChild(d)
            }
        }
        if (document.body) {
            var a = document.createElement('iframe');
            a.height = 1;
            a.width = 1;
            a.style.position = 'absolute';
            a.style.top = 0;
            a.style.left = 0;
            a.style.border = 'none';
            a.style.visibility = 'hidden';
            document.body.appendChild(a);
            if ('loading' !== document.readyState) c();
            else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
            else {
                var e = document.onreadystatechange || function() {};
                document.onreadystatechange = function(b) {
                    e(b);
                    'loading' !== document.readyState && (document.onreadystatechange = e, c())
                }
            }
        }
    })();
</script>
</body>

</html>