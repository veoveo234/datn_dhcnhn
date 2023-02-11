<div class="modal fade" id="modal-add-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('role.store') }}" method="POST" id="form-add-product"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name : <span style="color:red;font-weight: bold"
                                                       id="errorName"></span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name...">
                    </div>
                    <div class="form-group">
                        <label for="description">Description : <span style="color:red;font-weight: bold"
                                                                     id="errorName"></span></label>
                        <input type="text" class="form-control" id="description" name="description"
                               placeholder="Enter email...">
                    </div>
                    <label for="roles">Permission: </label>
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="{{ $permission->id }}"
                                   id="permission" name="permissions[]">{{ $permission->description }}
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary add-product">
                        Create Role
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
