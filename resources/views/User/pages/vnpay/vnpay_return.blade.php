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
        <title>Thanh toán thành công qua VNPAY</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/vnpay/jumbotron-narrow.css') }}" rel="stylesheet">  
        <script src="{{ asset('assets/vnpay/jquery-1.11.3.min.js') }}"></script>
    </head>
    <body>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-center btn-success">Thanh toán thành công VNPAY</h3>
            </div>
            <div class="table-responsive">                                                  
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label>{{ $data['order_id'] }}</label>
                </div>
                <div class="form-group">
                    <label >Mã khách hàng:</label>

                    <label>{{ $data['member_id'] }}</label>
                </div>
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label>{{ number_format($data['total_money'], 0, '', '.') }}</label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label>{{ $data['note'] }}</label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi:</label>
                    <label>{{ $data['responseCode'] }}</label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label>{{ $data['transactionNo'] }}</label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label>{{ $data['bankCode'] }}</label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label>{{ $data['time'] }}</label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                            if ($data['responseCode'] == '00') {
                                echo "GD Thanh cong";
                            } else {
                                echo "GD Khong thanh cong";
                            }
                        ?>

                    </label>
                </div> 
            </div>
            <a href="{{ route('index') }}" class="btn-info text-center">Quay lại trang chủ</a>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY 2015</p>
            </footer>
        </div>  
    </body>
</html>
