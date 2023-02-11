<div class="list-group flex-row" id="list-tab" role="tablist">
    <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Tất cả</a>
    <a class="list-group-item list-group-item-action" id="list-confirmation-list" data-toggle="list" href="#list-confirmation" role="tab" aria-controls="confirmation">Chờ xử lý</a>
    <a class="list-group-item list-group-item-action" id="list-confirmed-list" data-toggle="list" href="#list-confirmed" role="tab" aria-controls="confirmed">Đã xác nhận</a>
    <a class="list-group-item list-group-item-action" id="list-goods-list" data-toggle="list" href="#list-goods" role="tab" aria-controls="goods">Chờ lấy hàng</a>
    <a class="list-group-item list-group-item-action" id="list-delivering-list" data-toggle="list" href="#list-delivering" role="tab" aria-controls="delivering">Đang giao hàng</a>
    <a class="list-group-item list-group-item-action" id="list-delivered-list" data-toggle="list" href="#list-delivered" role="tab" aria-controls="delivered">Đã giao hàng</a>
    <a class="list-group-item list-group-item-action" id="list-finished-list" data-toggle="list" href="#list-finished" role="tab" aria-controls="finished">Đã hoàn tất</a>
    <a class="list-group-item list-group-item-action" id="list-cancelled-list" data-toggle="list" href="#list-cancelled" role="tab" aria-controls="cancelled">Đã hủy</a>
</div>

<div class="row">
    <div class="col-md-5 m-3">
        <label></label>
        <div id="date_range" class="border border-primary text-center" style="cursor: pointer; width: 100%; height: 50px; line-height: 50px;">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        <input type="hidden" id="start_date" value="" />
        <input type="hidden" id="end_date" value="" />
    </div>
    {{-- <div class="col-md-4 m-3 d-flex flex-column justify-content-end">
        <label></label>
        <select name="status-program" id="status-program" class="form-control border border-primary text-center" style="width: 100%; height: 50px; line-height: 50px;">
            <option value="">-- Trạng thái sản phẩm --</option>
            <option value="Sản phẩm mới">Sản phẩm mới</option>
            <option value="Đang bán">Đang bán</option>
            <option value="Bán chạy nhất">Bán chạy nhất</option>
            <option value="Giảm giá sốc">Giảm giá sốc</option>
            <option value="Đã hết hàng">Đã hết hàng</option>
        </select>
    </div> --}}
</div>

        <!-- Table -->
<div class="row mt-4">
    <div class="col-md-12 mb-5 p-0">
        <div class="table-responsive">
            <table id="product-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        {{-- <th>STT</th> --}}
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Kích cỡ</th>
                        <th>Số lượng</th>
                        <th>Giá bán</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="show-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Chi tiết đơn hàng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="load-detail-order">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
</div>

<script>
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

    var dataProduct = $('#product-datatables').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        searching: true,
        bPaginate: true,
        // "bStateSave": true,
        "order": [[ 0, "DESC" ]],
        ajax: {
            url  : '{{ route('data.manage.order') }}',
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
            {
                data: 'main_image', render: function (data, type, row) {
                    return '<img src="{{ asset('storage/images/product') }}/'+row.main_image+'" alt="" style="width:100px; height: 100px;">';
                }
            },
            {data: 'name', name: 'name'},
            {data: 'name_size', name: 'name_size'},
            {data: 'quantity', name: 'quantity'},
            {
                data: 'price', render: function (data, type, row) {
                    return data.toLocaleString()+' VND';
                }
            },
            {
                data: 'total_money', render: function (data, type, row) {
                    return data.toLocaleString()+' VND';
                }
            },
            {data: 'status', name: 'status'},
            {
                data: '', render: function (data, type, row) {
                    return '<button type="button" class="btn btn-primary show-order" data-url='+ row.order_id +' data-toggle="modal" data-target="#show-order"><i class="fas fa-eye"></i></button>';
                }
            },
        ]
    });

    $('#date_range').on('apply.daterangepicker', function(event, picker) {
        dataProduct.ajax.reload(null, false);
    });

    $('input[type=search]').focus(function() {
        $(this).select();
    });

    $('.list-group-item').on('click', function(){
        var valFilter = $(this).text();
        if(valFilter == 'Tất cả'){
            valFilter = '';
        }
        $('#product-datatables').DataTable().search(valFilter).draw();
    });

    $(document).on('click', '.show-order', function(){
        var order_id = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            url: "{{ route('detail.order') }}",
            data: { order_id: order_id },
            dataType: "html",
            success: function (data) {
                $('#load-detail-order').html(data);
            }
        });
    });


</script>