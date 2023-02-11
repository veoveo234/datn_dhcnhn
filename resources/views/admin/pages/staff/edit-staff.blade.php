@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')
    <style>
        .avatar-wrapper{
            position: relative;
            height: 200px;
            width: 200px;
            /* margin: 50px auto; */
            border-radius: 0%;
            overflow: hidden;
            box-shadow: 1px 1px 15px -5px black;
            transition: all .3s ease;
        }
        .avatar-wrapper:hover{
            transform: scale(1.05);
            cursor: pointer;
        }
        .avatar-wrapper:hover .profile-pic{
            opacity: .5;
        }
        .avatar-wrapper .profile-pic {
            height: 100%;
            width: 100%;
            transition: all .3s ease;
        }
        .avatar-wrapper .profile-pic:after{
            font-family: FontAwesome;
            content: "\f007";
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            font-size: 190px;
            background: #ecf0f1;
            color: #34495e;
            text-align: center;
        }
        .avatar-wrapper .upload-button {
            position: absolute;
            top: 0; left: 0;
            height: 100%;
            width: 100%;
        }
        .avatar-wrapper .upload-button .fa-arrow-circle-up{
            position: absolute;
            font-size: 234px;
            top: -17px;
            left: 0;
            text-align: center;
            opacity: 0;
            transition: all .3s ease;
            color: #34495e;
        }
        .avatar-wrapper .upload-button:hover .fa-arrow-circle-up{
            opacity: .9;
        }
    </style>
@endsection

@section('script')
{{-- Ckeditor 4 --}}
<script src="{{ asset('admin_assets/ckd/ckeditor.js') }}"></script>

@endsection

@section('content')
@if(isset($data) && !empty($data))
<div class="container-fluid mt-3">
    <div class="row mb-25">
        <div class="col-md-12">
            <div class="col-md-12 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700 mr-5">Quản lý nhân viên</h3>
                <h4>Cập nhật nhân viên</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-12 mb-0 mt-25 d-flex flex-column justify-content-center align-items-center">
                    <label for="category" class="my-input">Ảnh nhân viên</label>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" src="{{ asset('storage/images/avatar/' . $data[0]->avatar) }}" />
                        {{-- <img class="profile-pic" src="http://media.doisongphapluat.com/695/2021/3/27/hot-girl-so-huu-vong-1-108cm-khang-dinh-ban-sexy-chu-khong-hu-03.jpg" /> --}}
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="image-update" accept="image/*"/>
                    </div>
                </div>
            </div>
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="name-staff" class="my-input">Tên nhân viên</label>
                    <input type="text" class="form-control" id="name-staff" name="name-staff" value="{{ $data[0]->name }}">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="email-staff" class="my-input">Email</label>
                    <input type="text" class="form-control" id="email-staff" name="email-staff" value="{{ $data[0]->email }}">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="phone-staff" class="my-input">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone-staff" name="phone-staff" value="{{ $data[0]->phone }}">
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
                    <button type="button" class="btn btn-success font-weight-700" id="update-staff" name="update-staff" style="height: 40px; width: 215px; border-radius: 25px; font-size: 17px;">Cập nhật nhân viên</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('library-js')

@endsection
@section('after-js')
@if(isset($data) && !empty($data))
    <script>
        $(document).ready(function() {
            // CKEDITOR.replace('editor');
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }
        
            $(".file-upload").on('change', function(){
                readURL(this);
            });
            
            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });

            $(document).on('click', '#update-staff', function(){
                // console.log(123);
            // $('#update-staff').click(function() {
                var id = "{{ $data[0]->id }}",
                    // category = $('select[name=category-update] option').filter(':selected').val(),
                    // brand = $('select[name=brand-update] option').filter(':selected').val(),
                    name_staff = $('#name-staff').val(),
                    phone_staff = $('#phone-staff').val(),
                    email_staff = $('#email-staff').val(),
                    address_staff = $('#address-staff').val(),
                    main_image = $('#image-update')[0].files[0];

                // console.log(price);
                
                // console.log(quantity);
                var form_data = new FormData();
                
                
                if(id != "" && name_staff != "" && phone_staff != "" && email_staff != "" && address_staff != ""){
                    form_data.append("id", id);
                    form_data.append("name_staff", name_staff);
                    form_data.append("phone_staff", phone_staff);
                    form_data.append("email_staff", email_staff);
                    if(main_image != undefined){
                        var fileType = main_image['type'];
                        var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                        if (validImageTypes.includes(fileType)) {
                            form_data.append("main_image", main_image);
                        }
                    }else{
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('staff.update') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if(data == 1){
                                notification('center', 'success', 'Cập nhật nhân viênthành công!', 500, false, 1500);
                                location.reload();
                            }else if(data == 0){
                                notification('center', 'error', 'Lỗi!', 500, false, 1500);
                                window.location.href = "{{ route('staff.index') }}";
                            }
                            // dataProduct.ajax.reload(null, false);
                        }
                    });
                }
            });

        });
    </script>
@endif
@endsection
