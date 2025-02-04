<?php if (isset($request) && !empty($request)): ?>

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
                                    <h4 class="fw-semibold fs-16 mb-0"><?= $R['driver_name'] ?>&zwnj;<?= $R['driver_lname'] ?></h4> <span class="text-gray-light"><?= $R['mobile'] ?></span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="bg-primary  bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block" style="font-size:15px">
                            <?= $R['type'] ?> <?= $R['brand_name'] ?> <br />
                        </div>
                        <div class="bg-dark   bg-opacity-5 text-white py-1 px-2 rounded-1 fs-13 fw-semibold w-100 d-block" style="font-size:10px">
                            ایران <?= $R['iran'] ?> - <?= $R['pelak'] ?> <?= $R['harf'] ?> <?= $R['pelak_last'] ?></div>
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">

                        <?php if ($R['isAccepted'] == "YES"): ?>
                            <button disabled class="bg-success bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 confirm_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                                <span class="checked"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M22.319,4.431,8.5,18.249a1,1,0,0,1-1.417,0L1.739,12.9a1,1,0,0,0-1.417,0h0a1,1,0,0,0,0,1.417l5.346,5.345a3.008,3.008,0,0,0,4.25,0L23.736,5.847a1,1,0,0,0,0-1.416h0A1,1,0,0,0,22.319,4.431Z" /></svg></span>
                            </button>


                            <button disabled class="bg-danger bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 reject_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                                <span class="status " role="status">رد کردن</span>
                            </button>

                            <?php else:?>

                                <button class="bg-success bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 confirm_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                            
                                <span class="spinner-border spinner-border-sm hidden"></span>
                                <span class="checked hidden"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M22.319,4.431,8.5,18.249a1,1,0,0,1-1.417,0L1.739,12.9a1,1,0,0,0-1.417,0h0a1,1,0,0,0,0,1.417l5.346,5.345a3.008,3.008,0,0,0,4.25,0L23.736,5.847a1,1,0,0,0,0-1.416h0A1,1,0,0,0,22.319,4.431Z" /></svg></span>
                                <span class="status " role="status">تایید راننده</span>

                            </button>



                            <button class="bg-danger bg-opacity-5 text-white fs-13 fw-semibold py-1 px-2 rounded-1 reject_request" type="button" data-tripID="<?= $R['tripID'] ?>" data-RqID="<?= $R['id'] ?>" data-notifID="<?= $R['notifID'] ?>" data-driverID="<?= $R['driverID'] ?>" data-carID="<?= $R['carID'] ?>">
                                <span class="spinner-border spinner-border-sm hidden"></span>
                                <span class="checked hidden"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20">
                                        <path d="M22.319,4.431,8.5,18.249a1,1,0,0,1-1.417,0L1.739,12.9a1,1,0,0,0-1.417,0h0a1,1,0,0,0,0,1.417l5.346,5.345a3.008,3.008,0,0,0,4.25,0L23.736,5.847a1,1,0,0,0,0-1.416h0A1,1,0,0,0,22.319,4.431Z" />
                                    </svg></span>
                                <span class="status " role="status">رد کردن</span>
                            </button>


                            <?php endif; ?>


                           

                            


                        </div>

                        <?php if ($R['isAccepted'] == "NO"): ?>
                            <div class="removed "></div>
                        <?php else: ?>
                            <div class="removed hidden"></div>
                        <?php endif; ?>
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