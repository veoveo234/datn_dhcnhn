@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')
    <style>
        #datatables-detail-order_wrapper{
            padding: 0;
        }
    </style>
@endsection

@section('script')

@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="col-md-12">
        <div class="row mb-25">
            <div class="col-md-4 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700">Quản lý đơn hàng</h3>
            </div>
            <div class="col-md-8 p-0 d-flex justify-content-end">
                <a class="d-flex justify-content-end align-items-center excel-export" style="width: 60px;">
                    <i class="fa fa-file-excel-o" aria-hidden="true" style="color: #fff; background: #2ecc71; width: 50px; height: 50px; text-align: center; line-height: 54px; font-size: 35px; border-radius: 100%; cursor: pointer;"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row d-flex align-items-center bg-white m-0">
                <div class="col-md-3">
                    <label class="my-input">Từ ngày <i class="fa fa-arrow-right" aria-hidden="true"></i> đến ngày</label>
                    <div id="date_range" class="form-control d-flex align-items-center justify-content-around text-center" style="cursor: pointer;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                    <input type="hidden" id="start_date" value="" />
                    <input type="hidden" id="end_date" value="" />
                </div>
                <div class="col-md-2 mt-25 mb-25">
                    <label class="my-input" for="status-order">Trạng thái đơn hàng</label>
                    <select class="form-control" id="status-order" name="status-order">
                        <option value="0">-- Tất cả --</option>
                        <option value="1">Đơn hàng chờ xử lý</option>
                        <option value="2">Đơn hàng đã xác nhận</option>
                        <option value="3">Đơn hàng chưa giao hàng</option>
                        <option value="4">Đơn hàng đang giao hàng</option>
                        <option value="5">Đơn hàng đã giao hàng</option>
                        <option value="6">Đơn hàng đã hoàn tất</option>
                        <option value="7">Đơn hàng đã hủy</option>
                    </select>
                </div>
                <div class="col-md-2 mt-25 mb-25">
                    <label class="my-input" for="payment-order">Hình thức thanh toán</label>
                    <select class="form-control" id="payment-order" name="payment-order">
                        <option value="0">-- Tất cả --</option>
                        <option value="1">Thanh toán tiền mặt</option>
                        <option value="2">Thanh toán qua Vnpay</option>
                    </select>
                </div>
                <div class="col-md-4 mt-25 mb-25">
                    <label class="my-input" for="filter-search">Tìm kiếm khách hàng\SĐT</label>
                    <input class="form-control" type="text" name="filter-search" id="filter-search" placeholder="Tìm kiếm tên khách hàng\SĐT">
                </div>
                <div class="col-md-1 mt-25 mb-25 custom-search">
                    <div class="input-group">
                        <button class="btn btn-info search-store" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Table -->
    <div class="row mt-4">
        <div class="col-md-12 mb-5 p-0">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal approval -->
<div class="modal fade" id="approvalModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content" id="load-detailcart">
            
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý đơn hàng</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6 class="font-weight-600">Bạn có chắc chắn muốn hủy đơn hàng không?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger confirm-cancel" data-dismiss="modal">Hủy đơn hàng</button>
        </div>
        </div>
    </div>
</div>

@endsection
@section('library-js')

@endsection
@section('after-js')
<script>
    $(document).ready(function() {
        //* Date ranger picker
        var start = moment().subtract(29, 'days');
        var end = moment().subtract(-1, 'days');

        function callbackDateRange(start, end) {
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));

            $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#date_range').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, callbackDateRange);

        callbackDateRange(start, end);
        var arrStatus = [0], arrPayment = [0];
        var dataCart = $('#datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            // "bStateSave": true,
            "order": [
                [0, "ASC"]
            ],
            ajax: {
                url  : '{{ route('manage.cart.index') }}',
                type : 'GET',
                data: function(param) {
                    param.start_date = $('#start_date').val();
                    param.end_date = $('#end_date').val();
                    param.status = arrStatus.slice(-1)[0]
                    param.payment = arrPayment.slice(-1)[0];
                }
            },
            // "targets": 0,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ đơn hàng",
                "sZeroRecords": "Không tìm thấy đơn hàng nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ đơn hàng",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {
                    data: 'total_money', render: function (data, type, row) {
                        return formatDollar(Number(data))+' VND';
                    }
                },
                {data: 'created_at', name: 'created_at'},
                // {data: 'status', name: 'status'},
                {
                    data: 'status', render: function (data, type, row) {
                        if(data == 1){
                            return '<p class="font-weight-600 mb-0 text-warning">Chờ xử lý</p>';
                        }else if(data == 2){
                            return '<p class="font-weight-600 mb-0 text-info">Đã xác nhận</p>';
                        }else if(data == 3){
                            return '<p class="font-weight-600 mb-0 text-warning">Chờ lấy hàng</p>';
                        }else if(data == 4){
                            return '<p class="font-weight-600 mb-0 text-warning">Đang giao hàng</p>';
                        }else if(data == 5){
                            return '<p class="font-weight-600 mb-0 text-info">Đã giao hàng</p>';
                        }else if(data == 6){
                            return '<p class="font-weight-600 mb-0 text-success>Đã hoàn tất</p>';
                        }else if(data == 7){
                            return '<p class="font-weight-600 mb-0 text-danger">Đã hủy</p>';
                        }
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-cart" data-url='+ row.id +' data-toggle="modal" data-target="#approvalModalCenter"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger cancel-cart" data-toggle="modal" data-target="#destroyModalCenter" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                }
            ]
        });

        $('#date_range').on('apply.daterangepicker', function(event, picker) {
            dataCart.ajax.reload(null, false);
        });

        $(document).on('click', '.search-store', function(){
            var filter_search = $('#filter-search').val();
            $('#datatables').DataTable().search(filter_search).draw();
        });

        $(document).on('change', '#status-order', function(){
            var status = $(this).val();
            if(status != ""){
                arrStatus.push(Number(status));
                dataCart.ajax.reload(null, false);
            }
        });

        $(document).on('change', '#payment-order', function(){
            var payment = $(this).val();
            if(payment != ""){
                arrPayment.push(Number(payment));
                dataCart.ajax.reload(null, false);
            }
        });

        $(document).on('click', '.excel-export', function(){
            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type: "POST",
                url: "{{ route('product.export.excel') }}",
                data: { },
                success: function (result, status, xhr) {
                    // window.location.href = ;
                    requestSent = false;
                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : 'salary.xlsx');

                    // The actual download
                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);

                    swal.close(); 
                    notification('center', 'success', 'Đã tải xuống !', 500, false, 1000);
                    swal.close(); 
                }
            });
        });

        $(document).on('click', '.edit-cart', function (){
            var id = $(this).attr('data-url');
            if(id != ""){
                $.ajax({
                    type: "GET",
                    url: "{{ route('manage-cart.edit') }}",
                    data: { id : id },
                    dataType: "html",
                    success: function(data) {
                        $('#load-detailcart').html(data);
                        $('#datatables-detail-order').DataTable({
                            dom: 'rtp',
                            processing: true,
                            // serverSide: true,
                            responsive: true,
                            searching: true,
                            bPaginate: true,
                            lengthMenu: [
                                [5, 10, 25, 50, 100, -1],
                                [5, 10, 25, 50, 100, "All"]
                            ],
                        });
                    }
                });
            }
        });

        $(document).on('click', '.approval-cart', function (){
            var id = $(this).attr('data-url');
            if(id != ""){
                var check = 1;
                $.ajax({
                    type: "GET",
                    url: "{{ route('manage-cart.update') }}",
                    data: { id: id, check: check },
                    success: function() {
                        notification('center', 'success', 'Cập nhật đơn hàng thành công!', 500, false, 1500);
                        dataCart.ajax.reload(null, false);
                    }
                });
            }
        });

        $(document).on('click', '.update-cart', function (){
            var id = $(this).attr('data-url');
            var status = $('#status').val();
            var check = 2;
            if(id != "" && status != ""){
                $.ajax({
                    type: "GET",
                    url: "{{ route('manage-cart.update') }}",
                    data: { id: id, check: check, status: status },
                    success: function() {
                        notification('center', 'success', 'Cập nhật đơn hàng thành công!', 500, false, 1500);
                        dataCart.ajax.reload(null, false);
                    }
                });
            }
        });
        var arrCancel = [];
        $(document).on('click', '.cancel-cart', function (){
            var id = $(this).attr('data-url');
            if(id != ""){
                arrCancel.push(Number(id));
            }
        });
        $(document).on('click', '.confirm-cancel', function (){
            var id = arrCancel.slice(-1)[0];
            if(id != ""){
                $.ajax({
                    type: "GET",
                    data: { id: id },
                    url: "{{ route('manage-cart.delete') }}",
                    success: function() {
                        notification('center', 'error', 'Đơn hàng đã bị hủy!', 500, false, 1500);
                        dataCart.ajax.reload(null, false);
                    }
                });
            }
        });

    });
</script>
@endsection
