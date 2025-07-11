<div class="container border border-2 my-2 rounded-pill p-3 shadow-sm d-flex justify-content-between align-items-center">
    <a class="btn btn-primary rounded-pill" href="./client/add-employee-form.php" role="button">Add new Employee</a>
    <div class="input-group w-25 mx-4">
        <input type="search" id="live-search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">

            </div>
            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="edit-submit" value="submit">Save changes</button>
                </div> -->
        </div>
    </div>
</div>

<div class="employee-data">
</div>

<?php
include('./common/connect_db.php');
?>