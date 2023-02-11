<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center font-weight-bold">Thông tin đơn hàng</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <h5>Mã khách hàng: <label class="ml-2 text-success">{{ $member[0]['id'] }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Tên khách hàng: <label class="ml-2 text-success">{{ $member[0]['name'] }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Số điện thoại: <label class="ml-2 text-success">{{ $member[0]['phone'] }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Email: <label class="ml-2 text-success">{{ $member[0]['email'] }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Địa chỉ: <label class="ml-2 text-success">{{ $member[0]['address'] }}</label></h5>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Kích cỡ</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($orderDetail as $value)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td><img src="{{ asset('storage/images/product/' . $value->main_image) }}"
                                    style="width:100px; height: 100px;" alt=""></td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->name_size }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>{{ number_format($value->price, 0, '', '.') }} VND</td>
                                <td>{{ number_format($value->total_money, 0, '', '.') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <h5 class="d-flex align-items-baseline">Ghi chú: <label class="ml-2 text-dark" style="width: 90%; white-space: break-spaces !important;">{{ $order[0]['note'] }}</label></h5>
                </div>
                <div class="form-group">
                    <h5>Phương thức vận chuyển: <label class="ml-2 text-info">@if(($order[0]['ship_method']) == 1) Giao hàng miễn phí @elseif(($order[0]['ship_method']) == 2) Giao hàng tiết kiệm (25.000 VND) @elseif(($order[0]['ship_method']) == 3) Giao hàng nhanh (35.000 VND) @endif</label></h5>
                </div>
                <div class="form-group">
                    <h5>Phương thức thanh toán: <label class="ml-2 text-info">@if(($order[0]['payment_method']) == 1) Thanh toán tiền mặt khi nhận hàng @elseif(($order[0]['payment_method']) == 2) Thanh toán qua thẻ ngân hàng (Đã thanh toán) @endif</label></h5>
                </div>
                <div class="form-group">
                    <h5>Đặt hàng lúc: <label class="ml-2 text-info">{{ $order[0]['created_at'] }}</label></h5>
                </div>
                <div class="form-group">
                    <h5>Cập nhật lúc: <label class="ml-2 text-info">{{ $order[0]['updated_at'] }}</label></h5>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <h5>Trạng thái đơn hàng: 
                        <label class="ml-2 text-info">
                            @if(($order[0]['status']) == 1)
                                Chờ xử lý
                            @elseif(($order[0]['status']) == 2)
                                Đã xác nhận
                            @elseif(($order[0]['status']) == 3)
                                Chờ lấy hàng
                            @elseif(($order[0]['status']) == 4)
                                Đang giao hàng
                            @elseif(($order[0]['status']) == 5)
                                Đã giao hàng
                            @elseif(($order[0]['status']) == 6)
                                Đã hoàn tất
                            @elseif(($order[0]['status']) == 7)
                                Đã hủy
                            @endif
                        </label>
                    </h5>
                    @if(($order[0]['status']) == 1)
                        <button type="button" class="btn btn-danger cancel-order" data-dismiss="modal">Hủy đơn hàng</button>
                    @endif
                </div>
                <div class="form-group">
                    <h5>Tổng tiền đơn hàng: <label class="ml-2 text-success" style="font-size: 30px !important">{{ number_format($order[0]['total_money'], 0, '', '.') }} VND</label></h5>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var dataCart = $('#product-datatables').DataTable();

        $('.cancel-order').click(function(){
            var order_id = "{{ $order[0]['id'] }}";
            filter = /^([1-9][0-9]*?)$/;
            if (filter.test(order_id)) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('cancel.order') }}",
                    data: { order_id: order_id },
                    success: function() {
                        dataCart.ajax.reload(null, false);
                    }
                });
            }
        });
    });
    
 </script>