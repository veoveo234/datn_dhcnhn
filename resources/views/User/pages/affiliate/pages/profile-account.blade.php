@extends('User/pages/affiliate.index-affiliate')
@section('content-affiliate')
    <div class="container-fluid mt-5 mb-5">
        <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3 offset-1">
                    <div class="card mb-4">
                        <div class="avatar-wrapper">
                            @if(($data->avatar) == null)
                            <img class="profile-pic" src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png"/>
                            @else
                            <img class="profile-pic" src="{{ asset('storage/images/affiliate/'. $data->avatar) }}"/>
                            @endif
                            <div class="upload-button">
                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </div>
                            <input class="file-upload" type="file" id="avatar" name="avatar" accept="image/*"/>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{ $data->firstname }}  {{ $data->lastname }}</h5>
                          <p class="card-text">Tổng tiền: {{ number_format($total_money[0]['total_rose'], 0, '', '.') }} VND</p>
                        </div>
                    </div>
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Thông tin tài khoản</a>
                        <a class="list-group-item list-group-item-action" type="button" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Quản lý chương trình</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Quản lý doanh thu</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Đổi mã</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{ route('partner.logout') }}">Thoát tài khoản</a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Thông tin tài khoản của tôi</h4>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="firstname" class="col-4 col-form-label">First Name</label>
                                            <div class="col-8">
                                                <input id="firstname" name="firstname" class="form-control here" type="text" required="required" value="{{ $data->firstname }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="lastname" class="col-4 col-form-label">Last Name</label>
                                            <div class="col-8">
                                                <input id="lastname" name="lastname" class="form-control here" type="text" required="required" value="{{ $data->lastname }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profession" class="col-4 col-form-label">Nghề nghiệp</label>
                                            <div class="col-8">
                                                <input id="profession" name="profession" class="form-control here" required="required" type="text" value="{{ $data->profession }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-4 col-form-label">Địa chỉ</label>
                                            <div class="col-8">
                                                <input id="address" name="address" class="form-control here" required="required" type="text" value="{{ $data->address }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-4 col-form-label">Số điện thoại</label>
                                            <div class="col-8">
                                                <input id="phone" name="phone" class="form-control here" required="required" type="text" value="{{ $data->phone }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-4 col-form-label">Email</label>
                                            <div class="col-8">
                                                <input id="email" name="email" class="form-control here" required="required" type="email" value="{{ $data->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#changePasswordModal">Đổi mật khẩu</button>
                                            <button type="submit" class="btn btn-warning">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"></div>
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list"></div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="password_old" class="col-4 col-form-label">Nhập mật khẩu cũ</label>
                        <div class="col-8">
                            <input id="password_old" name="password_old" class="form-control here" required="required" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_new" class="col-4 col-form-label">Mật khẩu mới</label>
                        <div class="col-8">
                            <input id="password_new" name="password_new" class="form-control here" required="required" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confim_password" class="col-4 col-form-label">Xác thực lại mật khẩu mới</label>
                        <div class="col-8">
                            <input id="confim_password" name="confim_password" class="form-control here" required="required" type="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="change-pass" class="btn btn-primary" data-dismiss="modal">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ajax')
<script>
    const deg = 6;
    const hr = document.querySelector('#hr');
    const mn = document.querySelector('#mn');
    const sc = document.querySelector('#sc');

    setInterval(() => {
        let day = new Date();
        let hh = day.getHours() * 30;
        let mm = day.getMinutes() * deg;
        let ss = day.getSeconds() * deg;

        hr.style.transform = `rotateZ(${(hh)+(mm/12)}deg)`;
        mn.style.transform = `rotateZ(${(mm)}deg)`;
        sc.style.transform = `rotateZ(${(ss)}deg)`;
    })

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
        });
        $(".upload-button").on('click', function() {
            $(".file-upload").click();
        });
        // $("#view-avatar").on('click', function() {
        //     var avatar = $('#avatar').val();
        //     console.log(avatar);
        // });

        // $(document).on('click', '#change-pass', function(e){
        $("#change-pass").on('click', function(e) {
            e.preventDefault();
            var pass_old = $('#password_old').val();
            var password = $('#password_new').val();
            var password_confirm = $('#confim_password').val();
            if(pass_old != '' && password != '' && password_confirm != ''){
                $.ajax({
                    type: "POST",
                    url: "{{ route('affiliate.changepass') }}",
                    data: { pass_old: pass_old, password: password, password_confirm: password_confirm },
                    cache: false,
                    success: function (data) {
                        if(data == 'success'){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Mật khẩu đã được cập nhật thành công !',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $('#password_old').val('');
                            $('#password_new').val('');
                            $('#confim_password').val('');
                        }else if(data == 'error'){
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Mật khẩu cũ không đúng !',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    }
                });
            }
        });
        @if(Session::has('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Cập nhật tài khoản thành công!',
            showConfirmButton: false,
            timer: 1000
        });
        @endif
        @if(Session::has('error'))
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Email hoặc số điện thoại đã tồn tại!',
            showConfirmButton: false,
            timer: 1000
        });
        @endif

        $(document).on('click', '#list-profile-list', function(e){
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{ route('affiliate.manage') }}",
                cache: false,
                success: function (data) {
                    $('#list-profile').html(data);
                }
            });
        });

        $(document).on('click', '#list-messages-list', function(e){
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{ route('manage.revenue') }}",
                cache: false,
                success: function (data) {
                    $('#list-messages').html(data);
                }
            });
        });

        $(document).on('click', '.view-qrcode', function(e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != '' && id > 0){
                $.ajax({
                    type: "POST",
                    url: "{{ route('view.linkqr') }}",
                    data: { id: id },
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        $('#load-detail').html(data);
                    }
                });
            }
        });
        
    });
</script>
@endsection
