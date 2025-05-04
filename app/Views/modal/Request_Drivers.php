<?php if (isset($request) && !empty($request)): 
$vaziat = false;
foreach ($request as $R) {
    if ($R['isAccepted'] == "YES") {
        $vaziat = true;
        break;
    }
}
                ?>
    <table class="align-middle" style="width: 100%;">
        <thead>
            <tr class="text-center">
                <th scope="col">نام </th>
                <th scope="col">خودرو</th>
                <th scope="col">عملیات</th>
            </tr>
        </thead>
        <tbody>


            <?php foreach ($request as $R): ?>

                

                <tr class="text-center">
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 lh-1"> <img src="<?= base_url() ?>uploads/drivers/<?= $R['driverID'] ?>/<?= $R['ax'] ?>" class="wh-44 rounded-circle" alt="user"> </div>
                                <div class="flex-grow-1 ms-10">
                                    <h4 class="fw-semibold fs-16 mb-0"><?= $R['driver_name'] ?>&zwnj;<?= $R['driver_lname'] ?></h4> <span class="text-gray-light"><?= $R['mobile'] ?></span><br/>
                                    <span class="text-gray-light"><?php
                                    
                                        require_once APPPATH.'Libraries/jdf.php'; 
                                        $date_created = new DateTime($R['created_at']);
                                        $gregorian_date = explode('-', $date_created->format('Y-m-d'));
                                        $persian_date_array = gregorian_to_jalali($gregorian_date[0], $gregorian_date[1], $gregorian_date[2]);
                                        $persian_date = implode('/', $persian_date_array);
                                        $time_created = $date_created->format('H:i:s');
                                        echo $persian_date . '-' . $time_created;
                                        
                                    ?></span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="bg-primary  bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block" style="font-size:15px">
                             <?= $R['brand_name'] ?> <?= $R['type_name'] ?> <br />
                        </div>
                        <div class="bg-dark   bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block" style="font-size:10px">
                            ایران <?= $R['iran'] ?> - <?= $R['pelak'] ?> <?= $R['harf'] ?> <?= $R['pelak_last'] ?></div>

                            <div class="bg-warning   bg-opacity-5 text-black py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block" style="font-size:10px">
                            سال ساخت <?= $R['year'] ?> </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">

                        <?php if ($R['isAccepted'] == "W8"): ?>
                            <button  class="bg-success bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 confirm_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                                <span class="spinner-border spinner-border-sm hidden"></span>
                                <span class="checked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                            </button>
                        <?php endif; ?>

                            <!-- <button disabled class="bg-danger bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 reject_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                                <span class="status " role="status">رد کردن</span>
                            </button> -->

                            <?php if ($R['isAccepted'] == "YES"): ?>

                                <button disabled class="bg-success bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 " type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                            
                                    <span class="spinner-border spinner-border-sm hidden"></span>
                                    <span class="checked">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>                                

                                </button>
                            <?php endif; ?>


<!-- 
                            <button class="bg-danger bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 reject_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                                <span class="spinner-border spinner-border-sm hidden"></span>
                                <span class="checked hidden"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20">
                                        <path d="M22.319,4.431,8.5,18.249a1,1,0,0,1-1.417,0L1.739,12.9a1,1,0,0,0-1.417,0h0a1,1,0,0,0,0,1.417l5.346,5.345a3.008,3.008,0,0,0,4.25,0L23.736,5.847a1,1,0,0,0,0-1.416h0A1,1,0,0,0,22.319,4.431Z" />
                                    </svg></span>
                                <span class="status " role="status">رد کردن</span>
                            </button> -->



                        <?php if ($R['isAccepted'] == "NO" ): ?>
                            
                            <button disabled class="bg-danger bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 " type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                            
                                <span class="spinner-border spinner-border-sm hidden"></span>
                                <span class="checked ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </span>

                            </button>
                      
                        <?php endif; ?>


                        </div>
                    </td>



                </tr>

            <?php endforeach; ?>





        </tbody>
    </table>

<?php else: ?>

    موردی یافت نشد


<?php endif ?>




<script>
    $(".confirm_request").click(function() {
        spinner = $(this).children(".spinner-border");
        text = $(this).children(".status");
        checked = $(this).children(".checked");


        spinner.removeClass('hidden');
        text.addClass("visually-hidden");

        RqID = $(this).data("rqid");
        tripID = $(this).data("tripid");
        notifID = $(this).data("notifid");
        driverID = $(this).data("driverid");
        carID = $(this).data("carid");

        

        $.ajax({
            type: "POST",
            url: "Request/ConfirmReq",
            data: {
                tripID: tripID,
                RqID: RqID,
                notifID: notifID,
                driverID: driverID,
                carID: carID,
                isAccepet: "YES"
            },
            success: function(data) {
                spinner.hide();
                checked.removeClass("hidden");

                modal = $("#Request");
                ID = tripID;

                $("#ViewItem").empty();

                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>" + "Request/getTripDrivers",
                    data: { tripID: ID },
                    success: function (data) {
                        $(".driver_list").html(data);
                        $(".tr_" + ID + " td:nth-child(8)").html('<span class="bg-success  bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block">پذیرش توسط راننده </span>');

                    }
                });

            },
            fail: function() {
                alert("faield");
            }
        });

    });

    $(".reject_request").click(function() {

        spinner = $(this).children(".spinner-border");
        text = $(this).children(".status");
        checked = $(this).children(".checked");
        removed = $(this).closest("div").next("div");



        spinner.removeClass('hidden');
        text.addClass("visually-hidden");

        RqID = $(this).data("rqid");
        tripID = $(this).data("tripid");
        notifID = $(this).data("notifid");
        driverID = $(this).data("driverid");
        carID = $(this).data("carid");




        $.ajax({
            type: "POST",
            url: "Request/ConfirmReq",
            data: {
                tripID: tripID,
                RqID: RqID,
                notifID: notifID,
                driverID: driverID,
                carID: carID,
                isAccepet: "NO"
            },
            success: function(data) {
                if (data.final) {
                    $(".tr_" + ID + " td:nth-child(7)").html('<span class="bg-warning text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block">تایید شده </span>');
                    $('.model#Request').modal('toggle');
                    $('.btn-close').trigger('click');
                }
                spinner.hide();
                checked.removeClass("hidden");
                removed.removeClass("hidden");

            },
            fail: function() {
                alert("faield");
            }
        });

    });
</script>