<div class="modal-dialog modal-dialog-centered" style="max-width: 1200px;">
        <div class="modal-content" style="width: 1200px !important">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center transheader">
                            تراکنش ها
                        </div>
                            <div class="card-body">


                        <?php if (isset($transactions) && !empty($transactions)): ?>

                                <table class="table table-bordered tr_list">
                                    <thead>
                                        <tr>
                                            <th>مبلغ</th>
                                            <th>نوع تراکنش</th>
                                            <th>نام</th>
                                            <th>تلفن</th>
                                            <th>توضیحات</th>
                                            <th>شناسه تراکنش</th>
                                            <th>کد پیگیری</th>
                                            <th>تاریخ</th>
                                            <th>اسکن</th>
                                            <th>بانک</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $transaction): ?>
                                            <tr class="tr_<?=$transaction['id'] ?>">
                                                <td><?php echo number_format($transaction['amount']) ?> ریال</td>
                                                <td>
                                                    <?php if ($transaction['type'] == 'in'): ?>
                                                        دریافتی از مشتری
                                                    <?php endif; if ($transaction['type'] == 'out'): ?>
                                                        پرداختی به راننده

                                                   <?php endif; if ($transaction['type'] == 'refund'): ?>
                                                    استرداد به مشتری

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $transaction['name'] ?></td>
                                                <td><?php echo $transaction['tel'] ?></td>
                                                <td><?php echo $transaction['desc'] ?></td>
                                                <td><?php echo $transaction['trans_id'] ?></td>
                                                <td><?php echo $transaction['refid'] ?></td>
                                                <td><?php echo $transaction['date_p'] ?></td>
                                                <td><?php if(!empty($transaction['scan'])):?> <a target="_blank" href="<?=base_url()?>uploads/transaction/<?=$transaction['tripID']?>/<?php echo $transaction['scan'] ?>" > نمایش </a> </td>

                                                    <?php endif;?>
                                                    <td><?php echo $transaction['bank_name'] ?></td>
                                                <td>
                                                        <button data-id="<?php echo $transaction['id'] ?>" onclick="return removeTR('<?php echo $transaction['id'] ?>')" type="button" class="btn btn-danger btn-sm " id="delete_tr">حذف</button>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>

                                <?php else : ?>

                                    <div class="alert alert-warning">
                                        هیچ تراکنشی

                                     یافت نشد
                                    </div>

                                    <?php endif;?>


                            </div>
                    </div>
                </div>
          

        </div>
</div>










<script src="<?php echo base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/chosen/chosen.min.css" />

<script>  var base = "<?php echo base_url() ?>";


function removeTR(transactionID){


confirm('آیا از حذف این تراکنش مطمئن هستید ؟');


$.ajax({
    type: "POST",
    url: "transaction/remove",
    data: {
        id: transactionID
    },
    success: function (data) {
        if (data.status == 'OK') {
            // toast('تراکنش با موفقیت حذف شد');
            $("body .tr_list .tr_" + transactionID).remove();
        } else {
            // warn('مشکلی در حذف تراکنش رخ داده است');
        }
    }
});
}


</script>
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