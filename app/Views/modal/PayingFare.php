
<div class="modal fade" id="PayingFare" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">اعلام سرویس</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-4 col-lg-12">
                    <h3>کرایه سرویس <span class="badge bg-success base_fare">0</span> تومان</h3>

                </div>

                <div class="form-group position-relative">
                    <input type="text" name="passenger_custom_fare" class="form-control text-dark ps-5 h-58" placeholder="مبلغ اعللامی به مسافر">
                    <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                </div>
                <div class="form-group position-relative pt-20">
                    <input type="text" name="driver_custom_fare" class="form-control text-dark ps-5 h-58" placeholder="مبلغ پرداختی به راننده">
                    <i class="ri-exchange-dollar-line position-absolute top-50 start-0 translate-middle-y pt-20 fs-20 text-gray-light ps-20"></i>
                </div>


                <div class="form-group mb-4 col-lg-12 " style="margin-top: 20px;">
                    
                    <select class="form-control" id="packageSelect" name="package">
                        <?php foreach ($Package as $item): ?>
                            <option value="<?= htmlspecialchars($item['name']) ?>"><?= htmlspecialchars($item['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>



            </div>
            <div class="modal-footer">
                <input type="hidden" value="0" name="tripID" />
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary text-white notif"><span role="status">اعلام سرویس</span> <span class="spinner-grow spinner-grow-sm notif_spinner" aria-hidden="true"></span></button>

            </div>
        </div>
    </div>
</div>


