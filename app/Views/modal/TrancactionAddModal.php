<div class="modal fade" id="TrancactionAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 850px;">
        <div class="modal-content"  >
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">افزودن تراکنش </h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                    <form enctype="multipart/form-data" action="transaction/create" method="post" id="transform">

                                <div class="container">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white text-center">
                                            افزودن تراکنش
                                        </div>
                                        <div class="card-body">

                                        <div class="row my-2">
                                            <div class="col-md-6">
                                                <label for="amount"><strong>مبلغ (ریال):</strong></label>
                                                <input type="text" id="amount" name="amount" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="trans_type"><strong>نوع تراکنش:</strong></label>
                                                <select id="trans_type" name="trans_type" class="form-control">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    <option value="in">دریافتی از مشتری</option>
                                                    <option value="out">پرداختی به راننده</option>
                                                </select>
                                            </div>
                                           
                                        </div>




                                        <div class="row my-2">
                                            <div class="col-md-6">
                                                <label for="amount"><strong> پرداخت کننده / دریافت کننده:</strong></label>
                                                <select id="userID" name="userID" class="form-control">
                                                    <option value="" disabled selected>انتخاب کنید</option>

                                                </select>
                                            </div>
                                         
                                            <div class="col-md-6">
                                                <label for="date_p"><strong>تاریخ پرداخت:</strong></label>
                                                <input type="text" id="date_p" name="date_p" class="form-control"  placeholder="روز/ماه/سال" data-jdp="">
                                            </div>
                             
                                         
                                           
                                        </div>



                                        <div class="row my-2">
                                            <div class="col-md-6">
                                                <label for="trans_id"><strong>شناسه پرداخت:</strong></label>
                                                <input type="text" id="trans_id" name="trans_id" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="refid"><strong>شماره پیگیری:</strong></label>
                                                <input type="text" id="refid" name="refid" class="form-control">
                                            </div>
                                        </div>


                                        <div class="row my-2">

                                        <div class="col-md-6">
                                                <label for="scan"><strong>اسکن فیش واریزی:</strong></label>
                                                <input type="file" id="scan" name="scan" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="bank_id"><strong>بانک:</strong></label>
                                                <select id="bank_id" name="bank_id" class="form-control">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    <?php foreach ($bnks as $bank): ?>
                                                        <option value="<?php echo $bank['id']; ?>"><?php echo $bank['title'] . ' - ' . $bank['bank_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                          
                                          
                                           
                                            
                                        </div>


                                        <div class="row my-2">
                                        <div class="col-md-12">
                                                <label for="desc"><strong>توضیحات:</strong></label>
                                                <input type="text" id="desc" name="desc" class="form-control">
                                            </div>
                                        </div>
                            
                                





                                        <input type="hidden" name="name"value="">
                                        <input type="hidden" name="lname"value="">
                                        <input type="hidden" name="code"value="">
                                        <input type="hidden" id="trip_id" name="trip_id" class="form-control">





                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary addTransaction"> ثبت تراکنش</button>
                                        </div>

                                    </div>
                                </div>

                        </div>
                    </form>
                </div>









                <script src="<?php echo base_url()?>assets/chosen/chosen.jquery.min.js"></script>
                <link rel="stylesheet" href="<?php echo base_url()?>assets/chosen/chosen.min.css" />

                <script>
                    var base = "<?php echo base_url()?>";

                    $('#userID').chosen('destroy');

                    $(document).ready(function() {
                        $('#trans_type').change(function() {
                            var transType = $(this).val();
                            var url = '';

                            $('#userID').chosen('destroy');

                            if (transType === 'in') {
                                url = base + 'user/getAllUser';

                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    success: function(data) {
                                        // Handle the response data
                                        $('#userID').empty(); 
                                        $.each(data, function(key, value) {
                                            $('#userID').append($('<option>', {
                                                value: value.id,
                                                text: 1000 + value.id + ' - ' + value.name+' '+value.lname
                                            }));
                                        });

                                        $('#userID').chosen('destroy').chosen({
                                            no_results_text: "موردی پیدا نشد",
                                            width: "100%"
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('AJAX Error: ' + status + error);
                                    }
                                });


                            } else if (transType === 'out') {
                                url = base + 'driver/getAllDriver';

                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    success: function(data) {
                                        // Handle the response data
                                        $('#userID').empty(); 
                                        $.each(data, function(key, value) {
                                            $('#userID').append($('<option>', {
                                                value: value.did,
                                                text: value.code + ' - ' + value.name+' '+value.lname
                                            }));
                                        });

                                        $('#userID').chosen('destroy').chosen({
                                            no_results_text: "موردی پیدا نشد",
                                            width: "100%"
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('AJAX Error: ' + status + error);
                                    }
                                });
                            }

                        
                        });
                    });

                    $('#amount').on('input', function() {
                        var value = $(this).val();
                        value = value.replace(/\D/g, ''); // Remove non-numeric characters
                        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add commas every three digits
                        $(this).val(value);
                    });

         
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






















            </div>
        </div>
    </div>
</div>