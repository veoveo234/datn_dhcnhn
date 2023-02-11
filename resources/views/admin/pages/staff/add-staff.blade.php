@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')

@endsection

@section('script')
{{-- Ckeditor 4 --}}
<script src="{{ asset('admin_assets/ckd/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row mb-25">
        <div class="col-md-12">
            <div class="col-md-12 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700 mr-5">Quản lý nhân viên</h3>
                <h4>Thêm mới nhân viên</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="staff-name" class="my-input">Tên nhân viên</label>
                    <input type="text" class="form-control" id="staff-name" name="staff-name">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="image" class="my-input">Ảnh nhân viên</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="email" class="my-input">Email nhân viên</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="image" class="my-input">Phone nhân viên</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="password" class="my-input">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="col-md-6 text-right mt-25 mb-25">
                    <a href="{{ route('staff.index') }}">
                        <button type="button" class="btn btn-secondary font-weight-700" id="cancel" name="cancel" style="height: 40px; width: 191px; border-radius: 25px; font-size: 17px;">Cancel</button>
                    </a>
                </div>
                <div class="col-md-6 mt-25 mb-25">
                    <button type="button" class="btn btn-success font-weight-700" id="insert-staff" name="insert-staff" style="height: 40px; width: 215px; border-radius: 25px; font-size: 17px;">Thêm mới nhân viên</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('library-js')

@endsection
@section('after-js')

<script>
    $(document).ready(function() {
        $(document).on('click', '#insert-staff', function(e){
            e.preventDefault();
            var 
                name = $('#staff-name').val(),
                password = $('#password').val(),
                email = $('#email').val(),
                main_image = $('#image')[0].files[0],
                phone = $('#phone').val();

            var temp = document.getElementById("image");
           
            if(name != "" && password != "" && email != "" && phone != ""){
                if(temp.files.length == 0){
                    notification('center', 'warning', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
                }else{
                    var form_data = new FormData();
                    var fileType = main_image['type'];
                    var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                    if (validImageTypes.includes(fileType)) {
                        form_data.append("password", password);
                        form_data.append("email", email);
                        form_data.append("name", name);
                        form_data.append("main_image", main_image);
                        form_data.append("phone", phone);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('staff.store') }}",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                if(data == 1){
                                    notification('center', 'success', 'Thêm mới nhân viên thành công!', 500, false, 1500);
                                    location.reload();
                                }else{
                                    notification('center', 'error', 'Thông tin không hợp lệ!', 500, false, 1500);
                                }
                            }
                        });
                    }else{
                        notification('center', 'warning', 'Ảnh không đúng định dạng!', 500, false, 1500);
                    }
                }
            }else{
                notification('center', 'warning', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
            }
        });
    });
</script>
@endsection
