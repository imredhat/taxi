

<div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">تغییر وضعیت</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group position-relative">
                    <select name="status" class="form-select form-control ps-5 h-58">
                    <option value="Called">استعلام</option>
                                        <option value="Reserved">رزرو</option>
                                        <option value="Notifed">اعلام به راننده</option>
                                        <option value="Requested">اعلام آمادگی راننده</option>
                                        <option value="Confirm">پذیرش توسط راننده</option>
                                        <option value="Cancled">کنسل شده</option>
                                        <option value="Done">به پایان رسیده</option>


                    </select>

                </div>
                <input type="hidden" name="StatusClickedTripID" value="" id="StatusClickedTripID" />
                <input type="hidden" name="StatusClickedStatus" value="" id="StatusClickedStatus" />



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary text-white ChangeStatus"><span role="status">ذخیره تغییرات</span> <span class="spinner-grow spinner-grow-sm change_status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>