@extends('index')
@section('content')

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Product Checkout</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  
  <!--================Checkout Area =================-->
  @if(isset($count) && !empty($count))
  <section class="checkout_area section-margin--small">
    <div class="container" id="col-checkout">
        <div class="billing_details">
            <div class="row justify-content-center mb-5">
                <div class="col-md-12" id="load-alert">
                    
                </div>
            </div>
            <div class="row justify-content-center">
                <form class="row contact_form" action="{{ route('checkout.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <h3>Thông tin khách hàng</h3>
                        <div class="col-md-12 form-group">
                            <label for="">Họ tên khách hàng</label>
                            <input type="text" class="form-control" id="first" name="name" value="{{ $account['name'] }}" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $account['phone'] }}" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control" id="company" name="company" value="{{ $account['address'] }}" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $account['email'] }}" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <a href="{{ route('information') }}">Thay đổi thông tin</a>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Ghi chú</label>
                            <textarea class="form-control" rows="10" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="order_box">
                            <h2>Đơn hàng của bạn</h2>
                            <ul class="list">
                                <li>
                                    <h4 class="d-flex justify-content-between">
                                        <span>Sản phẩm </span>
                                        <span>Tổng tiền</span>
                                    </h4>
                                </li>
                                @foreach ($data as $key => $value)
                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <p style="width: 60%;">{{ $value['name'] }}</p>
                                            <span class=" ml-0">x{{ $value['qty'] }}</span> 

                                            @if ($value['weight'] != 0)
                                                <span class="last text-center">@php 
                                                    $total = ($value['price']) * ((100 - ($value['weight'])) / 100);
                                                    $sumTotal = $value['qty'] * $total;
                                                    $arr[] = $sumTotal;
                                                    @endphp {{ number_format($sumTotal, 0, '', '.') }} VND
                                                </span>
                                                <input type="hidden" id="" name="price[]" value="{{ $sumTotal }}">
                                            @else
                                                <span class="last text-center">@php
                                                    $total = $value['price'];
                                                    $sumTotal = $value['qty'] * $total;
                                                    $arr[] = $sumTotal;
                                                    @endphp {{ number_format($sumTotal, 0, '', '.') }} VND</span>
                                                <input type="hidden" id="" name="price[]" value="{{ $sumTotal }}">
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="col-md-12 form-group mt-3 mb-3">
                                <div class="row shipping_area d-flex flex-column">
                                    <h5 class="mb-3">Phương thức giao hàng</h5>
                                    <div class="shipping_box" id="shipper">
                                        <ul class="list d-flex flex-column align-items-start" id="load-shipper">
                                            <li>
                                                <input type="radio" class="check-ship" id="saving" name="shipper_cart" value="2">
                                                <label for="saving">Giao hàng tiết kiệm (25.000 VND)</label>
                                            </li>
                                            <li>
                                                <input type="radio" class="check-ship" id="fast" name="shipper_cart" value="3">
                                                <label for="fast">Giao hàng nhanh (35.000 VND)</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <ul class="list list_2">
                                <li>
                                    <div style="color: #000; font-weight: bold;">Mã giảm giá <span>
                                        @php
                                        if(session()->has('arrDiscount')){
                                            $arrDiscount = session('arrDiscount');
                                            if($arrDiscount['type_discount'] == 1){
                                                echo $arrDiscount['discount'].' %';
                                            }elseif($arrDiscount['type_discount'] == 2){
                                                echo '-'.number_format($arrDiscount['discount'], 0, '', '.').' VND';
                                            }elseif($arrDiscount['type_discount'] == 3){
                                                echo '-'.number_format($arrDiscount['discount'], 0, '', '.').' VND';
                                            }
                                        }
                                        @endphp
                                    </span></div>
                                </li>
                                <li>
                                    <div style="color: #000; font-weight: bold;">Tổng phụ <span>
                                        @php
                                            if (isset($arr)) {
                                                $into_money = array_sum($arr);
                                                if(session()->has('arrDiscount')){
                                                    $arrDiscount = session('arrDiscount');
                                                    if($arrDiscount['type_discount'] == 1){
                                                        $into_money = ($into_money) * ((100 - ($arrDiscount['discount'])) / 100);
                                                    }elseif($arrDiscount['type_discount'] == 2){
                                                        $into_money = $into_money - ($arrDiscount['discount']);
                                                    }elseif($arrDiscount['type_discount'] == 3){
                                                        $into_money = $into_money - ($arrDiscount['discount']);
                                                    }
                                                }
                                                echo number_format($into_money, 0, '', '.');
                                            }
                                        @endphp VND
                                    </span></div>
                                </li>
                                <li>
                                    <div style="color: #000; font-weight: bold;">Phí vận chuyển <span id="shipping">+35.000 VND</span></div>
                                </li>
                                <li>
                                    <div style="color: #000; font-weight: bold;">Thành tiền <input id="into-money" type="text" value="@php 
                                        if (isset($arr)) {
                                            $into_money = array_sum($arr);
                                            if(session()->has('arrDiscount')){
                                                $arrDiscount = session('arrDiscount');
                                                if($arrDiscount['type_discount'] == 1){
                                                    $into_money = ($into_money) * ((100 - ($arrDiscount['discount'])) / 100);
                                                }elseif($arrDiscount['type_discount'] == 2){
                                                    $into_money = $into_money - ($arrDiscount['discount']);
                                                }elseif($arrDiscount['type_discount'] == 3){
                                                    $into_money = $into_money - ($arrDiscount['discount']);
                                                }
                                            }
                                            echo number_format($into_money, 0, '', '.');
                                        }
                                        @endphp VND" readonly></div>
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option1" name="payment" value="1" checked>
                                    <label for="f-option1">Thanh toán tiền mặt khi nhận hàng</label>
                                    <div class="check"></div>
                                </div>
                            </div>
                            <div class="payment_item" style="width: 100%">
                                <div class="radion_btn d-inline-block" style="width: 76%">
                                    <input type="radio" id="f-option2" name="payment" value="2">
                                    <label for="f-option2"> Thanh toán qua VNPAY </label>
                                    <div class="check"></div>
                                </div>
                                <img src="https://vidientu.vnpay.vn/imgs/vivnpay.svg" alt="" style="width: 85px; height: 30px; background: #fff; padding: 0 8px;">
                            </div>
                            <div class="text-center mt-4">
                            <button class="button button-paypal text-uppercase" type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </section>
  @endif
  <!--================End Checkout Area =================-->
@endsection
@section('ajax')

@if(isset($count) && !empty($count))
<script>
    $(document).ready(function(){
        var moneyTo = '@php if (isset($arr)) { $into_money = array_sum($arr); if(session()->has('arrDiscount')){ $arrDiscount = session('arrDiscount'); if($arrDiscount['type_discount'] == 1){ $into_money = ($into_money) * ((100 - ($arrDiscount['discount'])) / 100); }elseif($arrDiscount['type_discount'] == 2){ $into_money = $into_money - ($arrDiscount['discount']); }elseif($arrDiscount['type_discount'] == 3){ $into_money = $into_money - ($arrDiscount['discount']); } } echo $into_money; } @endphp';
        if(moneyTo >= 2000000){
            var option = '<div class="alert alert-warning alert-dismissible fade show">\
                        <button type="button" class="close" data-dismiss="alert">&times;</button>\
                        <strong>Thông báo!</strong> Tất cả đơn hàng từ 2 triệu đồng trở lên đều được miễn phí giao hàng và khách hàng phải đặt cọc trước 25% / tổng tiền </div>';
            $('#load-alert').html(option);
            var noteShip = '<li>\
                                <input type="radio" class="check-ship" id="free" name="shipper_cart" value="1" checked>\
                                <label for="free">Giao hàng miễn phí</label>\
                            </li>';
            $('#load-shipper').append(noteShip);
            $('#shipping').html('Miễn phí');
        }else{
            $('#fast').attr('checked', true);
            function formatCash(str) {
                return str.split('').reverse().reduce((prev, next, index) => {
                    return ((index % 3) ? next : (next + '.')) + prev
                })
            }
            moneyTo = Number(moneyTo) + Number(35000);
            var into = formatCash(String(moneyTo));
            $('#into-money').val(into+" VND");

        }
        
        $(document).on('click', '.check-ship', function(){
            var money = '@php if (isset($arr)) { $into_money = array_sum($arr); if(session()->has('arrDiscount')){ $arrDiscount = session('arrDiscount'); if($arrDiscount['type_discount'] == 1){ $into_money = ($into_money) * ((100 - ($arrDiscount['discount'])) / 100); }elseif($arrDiscount['type_discount'] == 2){ $into_money = $into_money - ($arrDiscount['discount']); }elseif($arrDiscount['type_discount'] == 3){ $into_money = $into_money - ($arrDiscount['discount']); } } echo $into_money; } @endphp';
            var ship = $(this).val();
            if(ship == 1){
                $('#shipping').html('Miễn phí');
                total = Number(money);
            }else if(ship == 2){
                $('#shipping').html('25.000 VND');
                total = Number(money) + 25000;
            }else if(ship == 3){                
                $('#shipping').html('35.000 VND');
                total = Number(money) + 35000;
            }
            console.log(total);
            money = Math.round(total);
            function formatCash(str) {
                return str.split('').reverse().reduce((prev, next, index) => {
                    return ((index % 3) ? next : (next + '.')) + prev
                })
            }
            var into = formatCash(String(money));
            $('#into-money').val(into+" VND");
        });
    });
</script>
@endsection

@endif