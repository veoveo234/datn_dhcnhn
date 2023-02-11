@extends('index')
@section('content')
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col-md-2 col-sm-2 offset-1">
                <div class="avatar-wrapper" style="width: 100%; height: 250px;">
                    @if(!empty($data))
                        <img class="profile-pic" src="{{ asset('storage/images/avatar/'. $data[0]['avatar']) }}" />
                    @else
                        <img class="profile-pic" src="" />
                    @endif
                    <div class="upload-button">
                        <i class="fa fa-arrow-circle-up" aria-hidden="true" style="font-size: 248px"></i>
                    </div>
                    <input class="file-upload" id="avatar" name="avatar" type="file" accept="image/*"/>
                </div>

                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Tài khoản của tôi</a>
                    <a class="list-group-item list-group-item-action" id="list-manage-order" data-toggle="list" href="#list-manage" role="tab" aria-controls="manage">Quản lý đơn hàng</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Thông báo</a>
                    <a class="list-group-item list-group-item-action" id="list-voucher" data-toggle="list" href="#list-voucher" role="tab" aria-controls="voucher">Kho Voucher</a>
                    <a class="list-group-item list-group-item-action" id="list-shop-xu" data-toggle="list" href="#list-shop" role="tab" aria-controls="shop">Shop xu</a>
                </div>
            </div>
            <div class="col-md-8 col-sm-8" id="load-data">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">...</div>
                    <div class="tab-pane fade" id="list-manage" role="tabpanel" aria-labelledby="list-manage-order">...</div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                    <div class="tab-pane fade" id="list-voucher" role="tabpanel" aria-labelledby="list-voucher">...</div>
                    <div class="tab-pane fade" id="list-shop" role="tabpanel" aria-labelledby="list-shop-xu">...</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ajax')
<script>
    $(document).ready(function() {
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
            var form_data = new FormData();
            var avatar = $('#avatar')[0].files[0];
            if(avatar != undefined){
                var fileType = avatar['type'];
                var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                if (validImageTypes.includes(fileType)) {
                    form_data.append('avatar', avatar);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('upload.avatar') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function() {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cập nhật avatar thành công !',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    });
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ảnh không đúng định dạng !',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        });
        
        $(".upload-button").on('click', function() {
            $(".file-upload").click();
        });

        function load_information(){
            $.ajax({
                type: "GET",
                url: "{{ route('load.information') }}",
                dataType: "html",
                success: function (data) {
                    $('#list-home').html(data);
                }
            });
        }
        load_information();

        $(document).on('click', '#information', function(){
            
        });

        $(document).on('click', '#list-manage-order', function(){
            $.ajax({
                type: "GET",
                url: "{{ route('load.manage-order') }}",
                dataType: "html",
                success: function (data) {
                    $('#list-manage').html(data);
                }
            });
        });
    });
</script>

@endsection