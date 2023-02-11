<div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST" id="form-add-user"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name : </label>
                        <input type="text" value="" class="form-control" id="name" name="name"
                               placeholder="Enter name...">
                        <span class="error-name-create"
                              style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div>
                        <label for="avatar">Avatar :
                            <span class="error-image-create"
                                  style="color:red;">{{ $errors->first('avatar') }}</span></label>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" id="avatar" name="avatar">
                        <label class="custom-file-label" for="customFile">Chose image</label>
                    </div>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Enter email...">
                        <span class="error-email-create"
                              style="color:red;">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone : </label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               placeholder="Enter phone...">
                        <span class="error-phone-create"
                              style="color:red;">{{ $errors->first('phone') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password :
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Enter password...">
                        <span class="error-password-create"
                              style="color:red;">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Re-Password : </label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation"
                               autocomplete="password" placeholder="Enter password...">
                        <span class="error-password_confirmation-create"
                              style="color:red;">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="roles">Role: </label>
                        <select class="form-control" id="roles" name="roles[]" multiple="multiple">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" data-url="{{route('user.store')}}" class="btn btn-primary add-user">
                        Create User
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



