<div class="container" id="print">
    <!------------------------------ First card container --------------------------------------->
    <div class="card-container">
        <div class="top-box">
            <div class="top-menu">
                <div class="col-sm-12 text-center text-white header" style="background: #31687f;">کارت عضویت مشترک</div>

            </div>
        </div>
        <!-------------------------- End of top Box(Menu) ---------------------------------->
        <div class="image-box">
            <?php if (empty($user['ax'])): ?>
                <?php if ($user['gender'] == "مرد"): ?>
                    <img width="150" height="150" src="<?= base_url() ?>assets/images/male.svg" alt="user-profile">
                <?php else: ?>
                    <img width="150" height="150" src="<?= base_url() ?>assets/images/female.svg" alt="user-profile">

                <?php endif; ?>
            <?php else: ?>
                <img width="150" height="150" src="<?= base_url() ?>uploads/users/ax/<?= esc($user['ax']) ?>" alt="user-profile">
            <?php endif; ?>
        </div>
        <!-------------------------- End of Image Box ---------------------------------->
        <div class="main-box">
            <div class="user-info">
                <span class="name"><?= $user['name'] ?> <?= $user['lname'] ?></span>
                <span class="job">- <?= $user['mobile'] ?> -</span>

            </div>
            <!-------------------------- End of user information ---------------------------------->



            <div class="user-info mb-5">
                <span class="name"> جنسیت : <?= $user['gender'] ?> </span>
            </div>


            <!---------------------------- End of Social icons ------------------------------>

            <div class="bottom">
                <div class="col-sm-12">پویش تاکسی </div>
                <div class="col-sm-12" style="font-size: 8px;">www.PoyeshTak30.ir | 09655484545</div>
            </div>

            <!---------------------------- End of button box ------------------------------>
        </div>
        <!---------------------------- Animated circles ------------------------------>

        <div class="circle-1"></div>
        <div class="circle-2"></div>

        <!---------------------------- End of Animated circles ------------------------------>
    </div>


</div>

<link href="<?= base_url() ?>assets/css/user_card.css" rel="stylesheet" />



