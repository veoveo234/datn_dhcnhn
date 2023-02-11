@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
@endsection

@section('script')

@endsection
@section('content')
<div class="container-fluid mt-3">
    <div class="col-md-12">
        <div class="row mb-25">
            <div class="col-md-4 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700">Quản lý các chương trình</h3>
            </div>
            <div class="col-md-8 p-0 d-flex justify-content-end">
                <a href="{{ route('program.add') }}" target="_blank" class="d-flex justify-content-end align-items-center" style="width: 60px;">
                    <i class="fa fa-plus" aria-hidden="true"></i>
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
                <div class="col-md-3 mt-25 mb-25">
                    <label class="my-input" for="program-filter">Danh mục</label>
                    <select name="program-filter" id="program-filter" class="form-control">
                        <option value="" hidden>Chọn danh mục</option>
                        @if(isset($category) && !empty($category))
                            @foreach ($category as $val)
                                <option value="{{ $val->id }}">{{ $val->name_cate }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3 mt-25 mb-25">
                    <label class="my-input" for="name-program-filter">Tìm kiếm tiêu đề</label>
                    <input class="form-control" type="text" name="name-program-filter" id="name-program-filter" placeholder="Tìm kiếm tiêu đề">
                </div>
                <div class="col-md-3 mt-25 mb-25 custom-search">
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
                <table id="program-datatables" class="display table table-striped table-hover" cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh chương trình</th>
                            <th>Danh mục</th>
                            <th>Tên sản phẩm</th>
                            <th>Tiêu đề</th>
                            <th>Khách hàng cũ</th>
                            <th>Khách hàng mới</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
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
<div class="modal fade" id="updatePartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-uppercase font-weight-700" id="exampleModalCenterTitle">Quản lý cộng tác viên</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6 class="font-weight-600">Bạn có chắc chắn muốn khóa cộng tác viên này không?</h6>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-danger confirm">Xác nhận</button>
        </div>
        </div>
    </div>
</div>
@endsection

@section('after-js')
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
        var arrStatus = [0], arrCategory = [0];
        var dataProgram = $('#program-datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            // "bStateSave": true,
            autofill: true,
            "order": [
                [0, "ASC"]
            ],
            ajax: {
                url  : '{{ route('program.index') }}',
                type : 'GET',
                data: function(param) {
                    param.start_date = $('#start_date').val();
                    param.end_date = $('#end_date').val();
                    param.category = arrCategory.slice(-1)[0];
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
                "sLengthMenu": "Hiển thị _MENU_ cộng tác viên",
                "sZeroRecords": "Không tìm thấy cộng tác viên nào",
                // "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ cộng tác viên",
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
                {
                    data: 'avatar', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/affiliate') }}/'+row.avatar+'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {data: 'name_cate', name: 'name_cate'},
                {data: 'name', name: 'name'},
                {data: 'title', name: 'title'},
                {data: 'rose_old', name: 'rose_old'},
                {data: 'rose_new', name: 'rose_new'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-partner" data-url='+ row.id +' data-toggle="modal" data-target="#updatePartner"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger delete-partner" data-toggle="modal" data-target="#destroyPartner" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
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
            dataProgram.ajax.reload(null, false);
        });

        $(document).on('change', '#program-filter', function(){
            var category = $(this).val();
            if(category != ""){
                arrCategory.push(Number(category));
                dataProgram.ajax.reload(null, false);
            }
        });

        $(document).on('click', '.search-store', function(){
            var filter = $('#name-program-filter').val();
            $('#program-datatables').DataTable().search(filter).draw();
        });


    });
</script>
@endsection
