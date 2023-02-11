<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="https://bom.to/EXko8AIARIAsu" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Thanh toán qua VNPAY</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/vnpay/jumbotron-narrow.css') }}" rel="stylesheet">  
        <script src="{{ asset('assets/vnpay/jquery-1.11.3.min.js') }}"></script>
    </head>

    <body>

        <div class="container">
            <div class="row">
                {{-- <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Thông báo!</strong> Tất cả đơn hàng từ 2 triệu đồng trở lên phải đặt cọc trước 25% / tổng tiền
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Thông báo!</strong> Tất cả đơn hàng từ 2 triệu đồng trở lên phải đặt cọc trước 25% / tổng tiền
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-6 offset-3 header clearfix text-center">
                    <img src="https://bom.to/EXko8AIARIAsu" alt="" style="width: 100%; height: 150px;">
                </div>
            </div>
            <h3 class="mb-3">Thanh toán đơn hàng</h3>
            <div class="table-responsive">
                <form action="{{ route('checkout.payment') }}" id="create_form" method="POST">       
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="language">Loại hàng hóa </label>
                        <select name="order_type" id="order_type" class="form-control">
                            <option value="fashion">Thời trang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ number_format($data['total_money'], 0, '', '.') }}">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Noi dung thanh toan</textarea>
                    </div>
                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>

                    <a class="btn btn-default" href="{{ route('checkout.index') }}">Quay lại</a>
                    <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán</button>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY 2021</p>
            </footer>
        </div>  
        <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
        <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
        {{-- <script type="text/javascript">
            $("#btnPopup").click(function () {
                var postData = $("#create_form").serialize();
                var submitUrl = $("#create_form").attr("action");
                $.ajax({
                    type: "POST",
                    url: submitUrl,
                    data: postData,
                    success: function () {
                        window.location.href('submitUrl');
                    }
                });
            });
        </script> --}}


    </body>
</html>
