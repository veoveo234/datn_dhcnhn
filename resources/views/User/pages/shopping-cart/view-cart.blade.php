@extends('index')
@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Shopping Cart</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->



    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container" id="load-delete">
            @if (isset($data) && !empty($data))
                <div class="cart_inner" id="loadCart">
                    <div class="table-responsive">
                        <div id="reload-table">
                            <table class="table" id="load-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Phân loại hàng</th>
                                        <th scope="col">Giá bán</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="load-total">
                                    @foreach ($data as $key => $value)
                                        <tr id="total">
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="{{ asset('storage/images/product/' . $value['options']['image']) }}"
                                                            alt="" style="width: 100px;">
                                                    </div>
                                                    <div class="media-body">
                                                        <p>{{ $value['name'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    @if (isset($value['options']['size']))
                                                        Size: {{ $value['options']['size'] }} @endif
                                                </div>
                                            </td>
                                            <td>
                                                {{-- weight -> = sale --}}
                                                @if ($value['weight'] != 0)
                                                    <div>
                                                        <del>
                                                            <h6 style="font-size: 13px">
                                                                {{ number_format($value['price'], 0, '', '.') }} VND</h6>
                                                        </del>
                                                        <h5>@php $total = ($value['price']) * ((100 - ($value['weight'])) / 100) @endphp {{ number_format($total, 0, '', '.') }} VND
                                                        </h5>
                                                    </div>
                                                @else
                                                    <div>
                                                        <h5>@php
                                                            $total = $value['price'];
                                                            echo number_format($total, 0, '', '.');
                                                        @endphp VND</h5>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="product_count" style="position: relative; width: 80px;">
                                                    <input type="text" name="qty" id="sst{{ $key }}"
                                                        class="input-text qty update-cart text-left" min="1" maxlength="12"
                                                        value="{{ $value['qty'] }}" title="Quantity:"
                                                        style="width: 100%; padding-left: 0; position: relative;"
                                                        data-url="{{ route('cart.update', $key) }}">
                                                    <div style="position: absolute; right: 0;">
                                                        <button onclick="var result = document.getElementById('sst{{ $key }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button" style="width: 40px"
                                                            data-url="{{ route('cart.update', $key) }}" rowId="{{ $value['rowId'] }}"><i class="lnr lnr-chevron-up"></i></button>
                                                        <button onclick="var result = document.getElementById('sst{{ $key }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;" class="reduced items-count" type="button" style="width: 40px" data-url="{{ route('cart.update', $key) }}" rowId="{{ $value['rowId'] }}"><i class="lnr lnr-chevron-down"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>@php
                                                    $sumTotal = $value['qty'] * $total;
                                                    $arr[] = $sumTotal;
                                                @endphp {{ number_format($sumTotal, 0, '', '.') }} VND</h5>
                                            </td>
                                            <td>
                                                <button type="button" class="btn trash-cart"
                                                    data-url="{{ route('cart.destroy', $key) }}"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container">
                            <div class="row bottom_button justify-content-around">
                                <div>
                                    <button type="button" class="btn btn-info reload-cart" style="height: 40px"><i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật giỏ hàng</button>
                                </div>
                                <div>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" id="discount-code" placeholder="Mã giảm giá">
                                        <button class="primary-btn" id="apply-discount" style="border: none">Áp dụng</button>
                                        <a class="button" href="#">Có phiếu giảm giá?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center" id="load-into">
                                <div class="d-flex justify-content-center align-items-center" id="load-money">
                                    <h5 class="pr-3">Thành tiền: </h5>
                                    <h3 id="total-money">@php
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
                                    @endphp VND</h3>
                                </div>
                            </div>
                            <div class="row out_button_area justify-content-center">
                                <div class="checkout_btn_inner d-flex justify-content-around align-items-center" style="width: 100%;">
                                    <a class="gray_btn" href="{{ route('index') }}">Tiếp tục mua sắm</a>
                                    <a class="primary-btn ml-2" href="{{ route('checkout.index') }}">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('assets/img/emtycart.png') }}" alt="">
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!--================End Cart Area =================-->

@endsection
@section('ajax')
    <script>
        //* reload cart
        $(document).on('click', '.reload-cart', function() {
            $('#load-delete').load(' #loadCart');
        });

        $(document).on('click', '.increase', function(){
            var quantity = 1;
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                type: "PUT",
                data: { quantity: quantity },
                success: function() {
                    $('#load-delete').load(' #loadCart');
                }
            });
        });

        $(document).on('click', '.reduced', function(){
            var quantity = 0;
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                type: "PUT",
                data: { quantity: quantity },
                success: function() {
                    $('#load-delete').load(' #loadCart');
                }
            });
        });

        //* update cart
        $(document).on('change', '.update-cart', function() {
            var quantity = $(this).val();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    quantity: quantity
                },
                success: function() {
                    $('#load-delete').load(' #loadCart');
                }
            });
        });


        //* delete cart 
        $(document).on('click', '.trash-cart', function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                type: "DELETE",
                url: url,
                success: function() {
                    $('#load-delete').load(' #loadCart');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Xóa sản phẩm khỏi giỏ hàng thành công !',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        });

        //* apply discount
        $(document).on('click', '#apply-discount', function(e) {
            e.preventDefault();
            var discount = $('#discount-code').val();
            if(discount != ""){
                $.ajax({
                type: "GET",
                url: "{{ route('discount.product') }}",
                data: { discount: discount },
                success: function() {
                    $('#load-delete').load(' #loadCart');
                }
            });
            }
        });

    </script>
@endsection
