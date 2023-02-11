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
<div class="container-fluid mt-3">
    <div class="row mb-25">
        <div class="col-md-12">
            <div class="col-md-12 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700 mr-5">Quản lý giao diện</h3>
                <h4>Cập nhật giao diện</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4">
                    <label for="category" class="my-input">Ảnh banner</label>
                    <div class="avatar-wrapper">
                        {{-- <img class="profile-pic" src="{{ asset('storage/images/home/' . $data[0]->img_banner) }}" /> --}}
                        <img class="profile-pic" />
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="img_banner" accept="image/*"/>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="rows m-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control w-100" name="" id="name_banner" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control w-100" name="" id="title_banner" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control w-100" name="" id="des_banner" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4">
                    <label for="category" class="my-input">Ảnh nổi bật 1</label>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" />
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="img_bottom_banner_1" accept="image/*"/>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="rows m-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control w-100" name="" id="name_bottom_banner_1" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control w-100" name="" id="title_bottom_banner_1" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4">
                    <label for="category" class="my-input">Ảnh nổi bật 2</label>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" />
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="img_bottom_banner_2" accept="image/*"/>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="rows m-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control w-100" name="" id="name_bottom_banner_2" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control w-100" name="" id="title_bottom_banner_2" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4">
                    <label for="category" class="my-input">Ảnh nổi bật 3</label>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" />
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="img_bottom_banner_3" accept="image/*"/>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="rows m-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control w-100" name="" id="name_bottom_banner_3" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control w-100" name="" id="title_bottom_banner_3" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4">
                    <label for="category" class="my-input">Ảnh Sale</label>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" />
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="img_footer_banner" accept="image/*"/>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="rows m-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control w-100" name="" id="name_footer_banner" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control w-100" name="" id="title_footer_banner" >
                    </div>
                    <div class="rows m-3">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control w-100" name="" id="des_footer_banner" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="col-md-6 text-right mt-25 mb-25">
                    <a href="{{ route('product.index') }}">
                        <button type="button" class="btn btn-secondary font-weight-700" id="cancel" name="cancel" style="height: 40px; width: 191px; border-radius: 25px; font-size: 17px;">Cancel</button>
                    </a>
                </div>
                <div class="col-md-6 mt-25 mb-25">
                    <button type="button" class="btn btn-success font-weight-700" id="update-content-home" name="update-content-home" style="height: 40px; width: 215px; border-radius: 25px; font-size: 17px;">Cập nhật sản phẩm</button>
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
            // CKEDITOR.replace('editor');
            var readURL = function(input,element) {
                console.log($(input).parent());
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(input).siblings(element).attr('src', e.target.result);

                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-upload").on('change', function(){
                readURL(this,'.profile-pic');
            });
            
            $(".upload-button").on('click', function() {
                $(this).siblings('.file-upload').click();
                // $(".file-upload").click();
            });

            $(document).on('click', '#update-content-home', function(){
                let img_banner = $('#img_banner')[0].files[0],
                name_banner = $('#name_banner').val(),
                title_banner = $('#title_banner').val(),
                des_banner = $('#des_banner').val(),

                img_bottom_banner_1 = $('#img_bottom_banner_1')[0].files[0],
                name_bottom_banner_1 = $('#name_bottom_banner_1').val(),
                title_bottom_banner_1 = $('#title_bottom_banner_1').val(),

                img_bottom_banner_2 = $('#img_bottom_banner_2')[0].files[0],
                name_bottom_banner_2 = $('#name_bottom_banner_2').val(),
                title_bottom_banner_2 = $('#title_bottom_banner_2').val(),

                img_bottom_banner_3 = $('#img_bottom_banner_3')[0].files[0],
                name_bottom_banner_3 = $('#name_bottom_banner_3').val(),
                title_bottom_banner_3 = $('#title_bottom_banner_3').val(),

                img_footer_banner = $('#img_footer_banner')[0].files[0],
                name_footer_banner = $('#name_footer_banner').val(),
                title_footer_banner = $('#title_footer_banner').val(),
                des_footer_banner = $('#des_footer_banner').val();
                if(  img_banner == "" || name_banner == "" || title_banner == "" || des_banner == "" || img_bottom_banner_1 == "" || name_bottom_banner_1 == "" || title_bottom_banner_1 == "" || img_bottom_banner_2 == "" || name_bottom_banner_2 == "" || title_bottom_banner_2 == "" || img_bottom_banner_3 == "" || name_bottom_banner_3 == "" || title_bottom_banner_3 == "" || img_footer_banner == "" || name_footer_banner == "" || title_footer_banner == "" || des_footer_banner == ""
                ){
                    notification('center', 'error', 'Chưa đủ thông tin !', 500, false, 1500);
                    return;
                }
                var form_data = new FormData();
                if( true){
                    // if(img_banner != undefined){
                    //     var fileType = main_image['type'];
                    //     var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                    //     if (validImageTypes.includes(fileType)) {
                    //         form_data.append("img_banner", img_banner);
                    //     }
                    // }
                    form_data.append("img_banner", img_banner);
                    form_data.append("name_banner", name_banner);
                    form_data.append("title_banner", title_banner);
                    form_data.append("des_banner", des_banner);
                    form_data.append("img_bottom_banner_1", img_bottom_banner_1);
                    form_data.append("name_bottom_banner_1", name_bottom_banner_1);
                    form_data.append("title_bottom_banner_1", title_bottom_banner_1);
                    form_data.append("img_bottom_banner_2", img_bottom_banner_2);
                    form_data.append("name_bottom_banner_2", name_bottom_banner_2);
                    form_data.append("title_bottom_banner_2", title_bottom_banner_2);
                    form_data.append("img_bottom_banner_3", img_bottom_banner_3);
                    form_data.append("name_bottom_banner_3", name_bottom_banner_3);
                    form_data.append("title_bottom_banner_3", title_bottom_banner_3);
                    form_data.append("img_footer_banner", img_footer_banner);
                    form_data.append("name_footer_banner", name_footer_banner);
                    form_data.append("title_footer_banner", title_footer_banner);
                    form_data.append("des_footer_banner", des_footer_banner);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('home.update') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if(data == 1){
                                notification('center', 'success', 'Cập nhật thành công!', 500, false, 1500);
                                location.reload();
                            }else if(data == 0){
                                notification('center', 'error', 'Thất bại!', 500, false, 1500);
                                // window.location.href = "{{ route('product.index') }}";
                            }
                            // dataProduct.ajax.reload(null, false);
                        }
                    });
                }
            });

        });
    </script>
@endsection
