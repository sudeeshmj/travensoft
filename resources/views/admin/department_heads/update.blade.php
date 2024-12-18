<div class="modal fade" id="departmentHeadEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Department Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="departmentHeadEditForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_department" class="col-form-label">Department:</label>
                        <select name="department" id="edit_department" required class="form-control">
                            <option value="">--Select--</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_employee_name" class="col-form-label">Employee Name:</label>
                        <input type="text" required class="form-control" name="employee_name"
                            id="edit_employee_name">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="col-form-label">Email:</label>
                        <input type="email" required class="form-control" name="email" id="edit_email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
