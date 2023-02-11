$(document).ready(function () {
    function check() {
        let notify = $('.success-change-pass').val();
        if (notify != null) {
            notifyFailed('Thông tin tài khoản hoặc mật khẩu không chính xác');
        }
    }
    check();

})


