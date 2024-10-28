<div class="modal fade" id="Request" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">لیست درخواست ها</h1> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body driver_list">












            </div>

        </div>
    </div>
</div>


<style>
    .modal-body td {
        padding: 10px 10px;
        border: 1px solid #ccc;
    }


    td,
    th {
        border: 1px solid #ddd;
        text-align: center;
    }

    .driver_list button {
        border: none !important
    }

    .removed {
        z-index: 999999;
        position: absolute;
        width: 465px;
        margin-top: -51px;
        height: 75px;
        background: mistyrose;
        opacity: 0.5;
        right: 16px;
    }

    .hidden {
        display: none;
    }
</style>