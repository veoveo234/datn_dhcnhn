@extends('index')
@section('content')
<div class="container-fluid">
    <div class="row" style="display: flex; align-items: center; height: 180px; background-color: #000;">
        <div class="col-md-12">
            <h3 style="text-align: center; color: #fff; font-weight: 500;">Chương trình Tiếp thị Liên kết dành cho Người bán</h3>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="margin: 50px 0 30px 0;">
        <div class="col-md-12">
            <img src="{{ asset('images/affiliate/Banner-affiliate.png') }}" alt="" width="100%">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="title-text">Tiếp thị liên kết dành cho người bán cho Shop là gì?</h4>
            <p>Tiếp thị liên kết (Affiliate) là chương trình giúp người bán của Shop dễ dàng gia tăng doanh thu bằng cách chia sẻ link tiếp thị các sản phẩm và dịch vụ của Shop trên mạng xã hội.</p>
            <p>Hay nói cách khác, bạn sẽ đóng vai trò trung gian, giới thiệu người mua hàng tiềm năng đến với Shop và nhận ngay mức hoa hồng cực kì hấp dẫn hoặc tăng thêm truy cập, đơn hàng cho chính Shop mà không tốn bất kỳ chi phí nào.</p>
            <h5 class="title-text">Quy trình tham gia vô cùng đơn giản với 4 bước:</h5>
            <img src="{{ asset('images/affiliate/affiliate.jpg') }}" alt="" width="100%">
        </div>
    </div>
    <div class="row d-flex flex-column">
        <h4 class="title-text">bảng tỉ lệ hoa hồng?</h4>
        <div class="d-flex">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background: #8DC43B;">
                            <tr style="text-align: center">
                                <th>Danh mục</th>
                                <th>Khách hàng mới (*)</th>
                                <th>Khách hàng cũ (**)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data))
                                @foreach ($data as $value)
                                    <tr>
                                        <td>{{ $value->name_cate }}</td>
                                        <td class="text-center">{{ $value->rose_new }} %</td>
                                        <td class="text-center">{{ $value->rose_old }} %</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <p>(*) Khách hàng mới: Khách hàng mới là khách hàng chưa đăng ký tài khoản Shop hoặc đã có tài khoản Shop nhưng chưa phát sinh giao dịch mua sắm, lần đầu tiên bấm vào link Tiếp thị liên kết và có phát sinh đơn hàng đầu tiên thành công. </p>
                    <p>(**) Khách hàng cũ: Khách hàng đã có tài khoản Shop và đã từng có đơn hàng thành công trên Shop</p>
                </div>
            </div>
            <div class="col-md-6">
                <ul style="font-size: 20px;">
                    <li> - Mức hoa hồng tối đa cho một đơn hàng là: <span class="title-text">70.000 VND/ sản phẩm </span></li>
                    <li> - Quy định về mức hoa hồng tối đa cho mỗi tài khoản: Hạn mức hoa hồng của mỗi tài khoản khi mới bắt đầu tham gia chương trình Tiếp thị liên kết dành cho người bán hàng Shop là <span class="title-text">16.100.000VND/tháng</span>. Chúng tôi sẽ dựa vào kết quả thực chạy để xét tăng/giảm hạn mức phù hợp với từng người bán.</li>
                    <li> - Người bán sẽ nhận được thông báo chính thức từ chương trình thông qua email đăng ký tài khoản nếu có thay đổi về hạn mức.</li>
                    <li> - Các ngành hàng khác không nằm trong bảng sẽ có mức hoa hồng bằng: <span class="title-text">0VND</span></li>
                    <li> - Hoa hồng do Shop chi trả, bạn hoàn toàn không tốn bất kỳ chi phí nào khi tham gia chương trình</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="title-text">Công thức tính hoa hồng?</h4>
        </div>
        <div class="col-md-12" style="display: flex; justify-content: center; align-items: center;">
            <div class="col-md-3 offset-1">
                <img src="{{ asset('images/affiliate/calculor.png') }}" alt="" style="width: 100%">
            </div>
            <div class="col-md-8" style="display: flex; align-items: center; font-weight: bold; border: 1px solid #000; justify-content: space-between; padding: 15px">
                <p class="text-center mb-0">Hoa hồng người bán nhận được</p>=
                <p class="text-center mb-0">Giá trị ròng của đơn hàng</p>x
                <p class="text-center mb-0">Tỉ lệ hoa hồng</p>
            </div>
        </div>
        <div class="col-md-12">
            <div style="display: flex; justify-content: center;">
                <p style="text-align: center; color: #000; font-weight: 600; font-size: 18px; border-style: dashed; width: 73%; padding: 12px 0;">* <span style="color: tomato;">Giá trị ròng của đơn hàng</span> = [Tiền khách trả - (Phí vận chuyển + khoản giảm giá nếu có)]</p>
            </div>
        </div>
        <div class="col-md-12">
            <h4 class="title-text">Làm thế nào để ghi nhận hoa hồng?</h4>
            <p>Khi người mua truy cập vào link tiếp thị bạn chia sẻ thành công trên mạng xã hội, thực hiện mua hàng trên Shop thì bạn sẽ nhận được hoa hồng.</p>
            <p>Hoa hồng chỉ áp dụng cho các <span>đơn hàng họp lệ</span> không vi phạm chính sách của Shop và chương trình. Hoa hồng được ghi nhận khi <span>đơn hàng thành công</span> (tức ở trạng thái chấp nhận, người mua không đổi trả)</p>
            <div style="padding-top: 100px;">
                <a href="{{ route('affiliate.directional') }}"><img src="{{ asset('images/affiliate/ĐKy.jpg') }}" alt="" width="100%"></a>
            </div>
        </div>
    </div>
</div>
@endsection