<div class="modal-header">
    <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý đơn hàng</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
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
                    <h5 class="d-flex align-items-baseline">Ghi chú: <label class="ml-2 text-dark" style="width: 90%; white-space: break-spaces !important;">{{ $order['note'] }}</label></h5>
                </div>
                <div class="form-group">
                    <h5>Phương thức vận chuyển: <label class="ml-2 text-info">@if(($order['ship_method']) == 1) Giao hàng miễn phí @elseif(($order['ship_method']) == 2) Giao hàng tiết kiệm (25.000 VND) @elseif(($order['ship_method']) == 3) Giao hàng nhanh (35.000 VND) @endif</label></h5>
                </div>
                <div class="form-group">
                    <h5>Phương thức thanh toán: <label class="ml-2 text-info">@if(($order['payment_method']) == 1) Thanh toán tiền mặt khi nhận hàng @elseif(($order['payment_method']) == 2) Thanh toán qua thẻ ngân hàng (Đã thanh toán) @endif</label></h5>
                </div>
                <div class="form-group">
                    <h5>Đặt hàng lúc: <label class="ml-2 text-info">{{ $order['created_at'] }}</label></h5>
                </div>
                <div class="form-group">
                    <h5>Cập nhật lúc: <label class="ml-2 text-info">{{ $order['updated_at'] }}</label></h5>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label class="mb-0">Trạng thái đơn hàng:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" @if(($order['status']) == 1) selected @endif>Đơn hàng chờ xử lý</option>
                        <option value="2" @if(($order['status']) == 2) selected @endif>Đơn hàng đã xác nhận</option>
                        <option value="3" @if(($order['status']) == 3) selected @endif>Đơn hàng chưa giao hàng</option>
                        <option value="4" @if(($order['status']) == 4) selected @endif>Đơn hàng đang giao hàng</option>
                        <option value="5" @if(($order['status']) == 5) selected @endif>Đơn hàng đã giao hàng</option>
                        <option value="6" @if(($order['status']) == 6) selected @endif>Đơn hàng đã hoàn tất</option>
                        <option value="7" @if(($order['status']) == 7) selected @endif>Đơn hàng đã hủy</option>
                    </select>
                    @if(($order['status']) != 7)
                    <button type="button" class="ml-2 btn btn-warning update-cart" data-url="{{ $order['id'] }}" data-dismiss="modal">Cập nhật</button>
                    @endif
                </div>
                <div class="form-group">
                    <h5>Tổng tiền đơn hàng: <label class="ml-2 text-success" style="font-size: 30px !important">{{ number_format($order['total_money'], 0, '', '.') }} VND</label></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    @if(($order['status']) == 1 || ($order['status']) == 2 || ($order['status']) == 3 || ($order['status']) == 4 || ($order['status']) == 5)
        <button type="button" class="btn btn-primary approval-cart" data-url="{{ $order['id'] }}" data-dismiss="modal">Phê duyệt</button>
    @endif
</div>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var dataCart = $('#order-datatables').DataTable();

        $('.approval-cart').click(function(){
            var id = $(this).attr('data-url');
            var check = 1;
            $.ajax({
                type: "GET",
                url: "{{ route('manage-cart.update') }}",
                data: { id: id, check: check },
                success: function() {
                    dataCart.ajax.reload(null, false);
                }
            });
        });

        $('.update-cart').click(function(){
            var id = $(this).attr('data-url');
            var status = $('#status').val();
            var check = 2;
            $.ajax({
                type: "GET",
                url: "{{ route('manage-cart.update') }}",
                data: { id: id, check: check, status: status },
                success: function() {
                    dataCart.ajax.reload(null, false);
                }
            });
        });
    });
    
 </script>