<div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
    <form action="/updatetransaction" method="post">
        <div class="modal-content" style="width: 1000px !important">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            تراکنش ها
                        </div>
                            <div class="card-body">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>مبلغ</th>
                                            <th>پرداخت کننده</th>
                                            <th>دریافت کننده</th>
                                            <th>نوع تراکنش</th>

                                            <th>نام</th>
                                            <th>تلفن</th>
                                            <th>توضیحات</th>
                                            <th>شناسه تراکنش</th>
                                            <th>کد پیگیری</th>
                                            <th>تاریخ</th>
                                            <th>وضعیت</th>
                                            <th>اسکن</th>
                                            <th>شناسه سفر</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $transaction): ?>
                                            <tr>
                                                <td><?php echo $transaction['amount'] ?></td>
                                                <td><?php echo $transaction['_from'] ?></td>
                                                <td><?php echo $transaction['_to'] ?></td>
                                                <td><?php echo $transaction['_for'] ?></td>
                                                <td><?php echo $transaction['name'] ?></td>
                                                <td><?php echo $transaction['tel'] ?></td>
                                                <td><?php echo $transaction['desc'] ?></td>
                                                <td><?php echo $transaction['trans_id'] ?></td>
                                                <td><?php echo $transaction['refid'] ?></td>
                                                <td><?php echo $transaction['date_p'] ?></td>
                                                <td><?php echo $transaction['status'] ?></td>
                                                <td><?php echo $transaction['scan'] ?></td>
                                                <td><?php echo $transaction['id'] ?></td>

                                                <td>
                                                    <form action="/deletetransaction" method="post" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                        <input type="hidden" name="transaction_id" value="<?php echo $transaction['id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>


                            </div>
                    </div>
                </div>
          

        </div>
    </form>
</div>










<script src="<?php echo base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/chosen/chosen.min.css" />

<script>  var base = "<?php echo base_url() ?>";</script>
<script>


</script>


<style>
    .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        height: 40px;
    }

    .chosen-container.chosen-container-single {
        width: 100% !important;
    }



    a.chosen-single {
        padding: 20px !important;
        height: 60px !important;
        font-size: 15px;
    }

    li.active-result {
        font-size: 16px;
        padding: 10px !important;
    }

    b {
        margin-top: 20px;
        margin-right: -1px;
    }
</style>