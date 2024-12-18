<div class="modal fade" id="weeklyUpdateViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Weekly Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="employee-details mb-3">
                    <h5 class="mb-3 text-success fs-14">Employee Details</h5>
                    <div class="row mb-2">
                        <div for="colFormLabelSm" class="col-sm-4">Employee
                            Name:</div>
                        <div class="col-sm-8" id="view_emp_name">

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div for="colFormLabelSm" class="col-sm-4">Department:</div>
                        <div class="col-sm-8" id="view_dept_name">

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div for="colFormLabelSm" class="col-sm-4">Date:</div>
                        <div class="col-sm-8" id="view_created_at">

                        </div>
                    </div>
                </div>
                <div class="update-note mb-3">
                    <h5 class="mb-3 text-success fs-14">Note</h5>
                    <div class="employee-note-content mb-3" style="max-height: 300px; overflow-y: auto;">
                        <p id="view_note_content">
                        </p>
                    </div>
                    <div class="employee-note-attachement mb-3">
                        <h5 class="mb-3 text-success fs-14">Attachement</h5>
                        <a id="view_note_attachement" href="" download></a>


                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
