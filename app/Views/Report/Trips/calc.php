<h3 style="margin-top: 20px !important;">گزارش سرویس</h3>


<?php
                $user = isset($_GET['user']) ? 1000 + $_GET['user'] : null;
                $driver = isset($_GET['driver']) ? 1000 + $_GET['driver'] : null;
                $loc_start = isset($_GET['loc_start']) ? $_GET['loc_start'] : null;
                $loc_end = isset($_GET['loc_end']) ? $_GET['loc_end'] : null;
                $contact_start_date = isset($_GET['contact_start_date']) ? $_GET['contact_start_date'] : null;
                $contact_end_date = isset($_GET['contact_end_date']) ? $_GET['contact_end_date'] : null;
                $trip_start_date = isset($_GET['trip_start_date']) ? $_GET['trip_start_date'] : null;
                $trip_end_date = isset($_GET['trip_end_date']) ? $_GET['trip_end_date'] : null;
                $guest_name = isset($_GET['guest_name']) ? $_GET['guest_name'] : null;
                $guest_tel = isset($_GET['guest_tel']) ? $_GET['guest_tel'] : null;
                ?>



<table class="table table-bordered">
    <tr class="mini">
        <td>عنوان</td>
        <td>مقدار</td>
    </tr>

    
    <?php if (isset($user)): ?>
        <tr class="mini">
            <td>کد اشتراک</td>
            <td><?= ($user) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($driver)): ?>
        <tr class="mini">
            <td>شناسه راننده</td>
            <td><?= ($driver) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($loc_start)): ?>
        <tr class="mini">
            <td>آدرس شروع</td>
            <td><?= ($loc_start) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($loc_end)): ?>
        <tr class="mini">
            <td>آدرس پایان</td>
            <td><?= ($loc_end) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($contact_start_date)): ?>
        <tr class="mini">
            <td>تاریخ تماس از</td>
            <td><?= ($contact_start_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($contact_end_date)): ?>
        <tr class="mini">
            <td>تاریخ تماس تا</td>
            <td><?= ($contact_end_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($trip_start_date)): ?>
        <tr class="mini">
            <td>تاریخ سفر از</td>
            <td><?= ($trip_start_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($trip_end_date)): ?>
        <tr class="mini">
            <td>تاریخ سفر تا</td>
            <td><?= ($trip_end_date) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($guest_name)): ?>
        <tr class="mini">
            <td>نام مسافر</td>
            <td><?= ($guest_name) ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($guest_tel)): ?>
        <tr class="mini">
            <td>شماره تماس مسافر</td>
            <td><?= ($guest_tel) ?></td>
        </tr>
    <?php endif; ?>
</table>


















<style>
    .mini td {
        height: 8px;
        padding: 1px !important;
    }
</style>