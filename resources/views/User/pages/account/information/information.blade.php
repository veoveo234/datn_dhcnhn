<div class="card" style="width: 80%">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <h4>Hồ Sơ Của Tôi</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form>
                <div class="form-group row">
                    <label for="username" class="col-4 col-form-label">Họ tên</label> 
                    <div class="col-8">
                    <input id="username" name="username" class="form-control here" required="required" type="text" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-4 col-form-label">Số điện thoại</label> 
                    <div class="col-8">
                        <input id="phone" name="phone" class="form-control here" type="text" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-4 col-form-label">Địa chỉ</label> 
                    <div class="col-8">
                        <input id="address" name="address" class="form-control here" type="text" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-4 col-form-label">Email</label> 
                    <div class="col-8">
                        <input id="email" name="email" class="form-control here" required="required" type="email" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4 col-form-label">
                        <button name="change-password" id="change-password" type="button" class="btn btn-warning" data-toggle="modal" data-target="#changePassword">Đổi mật khẩu</button>
                    </div> 
                    <div class="col-8 col-form-label">
                        <button name="update-profile" id="update-profile" type="button" class="btn btn-primary">Cập nhật hồ sơ</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Đổi mật khẩu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Mật khẩu cũ</label>
                <input class="form-control" type="password" name="pass-old" id="pass-old">
            </div>
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input class="form-control" type="password" name="pass-new" id="pass-new">
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input class="form-control" type="password" name="confim-password" id="confim-password">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" id="change-pass" data-dismiss="modal">Lưu mật khẩu</button>
        </div>
      </div>
    </div>
</div>

<script>
$(document).ready(function() {

    function load_information(){
        var loadData = [];
        $.ajax({
            type: "GET",
            url: "{{ route('data.information') }}",
            dataType: "json",
            success: function (data) {
                var arr = Object.keys(data).map(key => data[key]);
                loadData.push(arr[0][0]);
                $('#username').val(loadData[0]['name']);
                $('#phone').val(loadData[0]['phone']);
                $('#address').val(loadData[0]['address']);
                $('#email').val(loadData[0]['email']);
            }
        });
    }
    load_information();

    $("#update-profile").on('click', function(e) {
        e.preventDefault();
        var name = $('#username').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var email = $('#email').val();
        var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if(name != "" && phone != "" && address != "" && email != ""){
            if(email.match(mailformat)){
                $.ajax({
                    type: "POST",
                    url: "{{ route('update.information') }}",
                    data: { name: name, phone: phone, address: address, email: email },
                    success: function(data) {
                        var icon = "";
                        var title = "";
                        if(data == 'error mail'){
                            icon = 'error';
                            title = 'Địa chỉ Email đã tồn tại !';
                        }else if(data == 'error phone'){
                            icon = 'error';
                            title = 'Số điện thoại đã tồn tại !';
                        }else if(data == 'error all'){
                            icon = 'error';
                            title = 'Số điện thoại và Email đã tồn tại !';
                        }else{
                            icon = 'success';
                            title = 'Cập nhật thông tin thành công!';
                        }
                        Swal.fire({
                            position: 'center',
                            icon: icon,
                            title: title,
                            showConfirmButton: false,
                            timer: 1200
                        });
                        load_information();
                    }
                });
            }
        }
    });

    $("#change-pass").on('click', function(e) {
        e.preventDefault();
        var pass_old = $('#pass-old').val();
        var password = $('#pass-new').val();
        var password_confirm = $('#confim-password').val();
        if(pass_old != '' && password != '' && password_confirm != ''){
            $.ajax({
                type: "POST",
                url: "{{ route('account.changepass') }}",
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
                        $('#pass-old').val('');
                        $('#pass-new').val('');
                        $('#confim-password').val('');
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
});
</script>