@extends('admin-index')
@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-1 mt-3 ml-3 mb-3 text-center" style="padding: 0; line-height: 2">
        </div>
        <div class="col-md-2 m-3">
            <label></label>
            <div id="date_range" class="border border-primary text-center" style="cursor: pointer; width: 100%; height: 50px; line-height: 50px;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
            <input type="hidden" id="start_date" value="" />
            <input type="hidden" id="end_date" value="" />
        </div>
        <div class="col-md-2 m-3 d-flex flex-column justify-content-end">
            <label></label>
            <select name="status-order" id="status-order" class="border border-primary text-center" style="width: 100%; height: 50px; line-height: 50px;">
                <option value="">-- Trạng thái đơn hàng --</option>
                <option value="Chờ xử lý">Đơn hàng chờ xử lý</option>
                <option value="Đã xác nhận">Đơn hàng đã xác nhận</option>
                <option value="Chưa giao hàng">Đơn hàng chưa giao hàng</option>
                <option value="Đang giao hàng">Đơn hàng đang giao hàng</option>
                <option value="Đã giao hàng">Đơn hàng đã giao hàng</option>
                <option value="Đã hoàn tất">Đơn hàng đã hoàn tất</option>
                <option value="Đã hủy">Đơn hàng đã hủy</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="order-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Tổng tiền</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Phê duyệt</th>
                            <th>Hủy đơn</th>
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
            <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý đơn hàng</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4 class="font-weight-bold">Bạn có chắc chắn muốn hủy đơn hàng không</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Có</button>
        </div>
        </div>
    </div>
</div>

@endsection

@section('script-ajax')
<script>
    $(document).ready(function () {
        // Date ranger picker
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

        var dataCart = $('#order-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('manage-cart.index') }}',
                type : 'GET',
                data: function(param) {
                    param.start_date = $('#start_date').val();
                    param.end_date = $('#end_date').val();
                }
            },
            // "targets": 0,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'total_money', name: 'total_money'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-cart" data-url='+ row.id +' data-toggle="modal" data-target="#approvalModalCenter"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger cancel-cart" data-toggle="modal" data-target="#destroyModalCenter" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
                    }
                }
            ]
        });

        // data.on( 'order.dt search.dt', function () {
        //     data.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //         cell.innerHTML = i+1;
        //     } );
        // } ).draw();

        $('#date_range').on('apply.daterangepicker', function(event, picker) {
            dataCart.ajax.reload(null, false);
        });
        
        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-order').on('change', function(){
            var valFilter = $("#status-order").val();
            $('#order-datatables').DataTable().search(valFilter).draw();   
        });

        //* cancel order
        $(document).on('click', '.cancel-cart', function (e){
            var id = $(this).attr('data-url');
            $('.confirm').click(function(){
                $.ajax({
                    type: "GET",
                    data: { id: id },
                    url: "{{ route('manage-cart.delete') }}",
                    success: function() {
                        dataCart.ajax.reload(null, false);
                    }
                });
            });
        });

        // //* Edit record
        $(document).on('click', '.edit-cart', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: "{{ route('manage-cart.edit') }}",
                data: { id : id },
                dataType: "html",
                success: function(data) {
                    $('#load-detailcart').html(data);
                }
            });
        });
        
    });
</script>
@endsection