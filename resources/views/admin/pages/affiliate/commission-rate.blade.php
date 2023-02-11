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
                <h3 class="text-dark font-weight-700">Quản lý tỉ lệ hoa hồng</h3>
            </div>
            <div class="col-md-8 p-0 d-flex justify-content-end">
                <a  href="" class="d-flex justify-content-end align-items-center" style="width: 60px;" data-toggle="modal" data-target="#addRowModal">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row d-flex align-items-center bg-white m-0">
                <div class="col-md-3 mt-25 mb-25">
                    <label class="my-input" for="filter_category">Danh mục</label>
                    <select name="filter_category" id="filter_category" class="form-control">
                        <option value="0">-- Tất cả --</option>
                        @if(isset($category_filter) && !empty($category_filter))
                            @foreach ($category_filter as $value)
                                <option value="{{ $value['id'] }}">{{ $value['name_cate'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>


    <!-- Table -->
    <div class="row mt-4">
        <div class="col-md-12 mb-5 p-0">
            <div class="table-responsive">
                <table id="commission-datatables" class="display table table-striped table-hover" cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Danh mục</th>
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

<!-- Modal -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm mới</span>
                    <span class="text-uppercase font-weight-bold text-info">
                        Tỉ lệ hoa hồng
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="category">Danh mục</label>
                            <select name="category" id="category" class="form-control">
                                @if(isset($category) && !empty($category))
                                    @foreach ($category as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name_cate'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rose-old">Khách hàng cũ (%)</label>
                            <input type="text" class="form-control" id="rose-old" name="" data-type="percent" data-val="Giá trị">
                        </div>
                        <div class="form-group">
                            <label for="rose-new">Khách hàng mới (%)</label>
                            <input type="text" class="form-control" id="rose-new" name="" data-type="percent" data-val="Giá trị">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <button type="button" id="insert" class="btn btn-primary">Thêm mới</button>
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
        var arrCategory = [0];
        var dataCommission = $('#commission-datatables').DataTable({
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
                url  : '{{ route('rose.index') }}',
                type : 'GET',
                data: function(param) {
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
                {data: 'name_cate', name: 'name_cate'},
                {
                    data: 'rose_old', render: function (data, type, row) {
                        return data +" %";
                    }
                },
                {
                    data: 'rose_new', render: function (data, type, row) {
                        return data +" %";
                    }
                },
                {
                    data: 'status', render: function (data, type, row) {
                        if(data == 1){
                            return '<p class="text-success mb-0">Đang hoạt động</p>';
                        }else if(data == 2){
                            return '<p class="text-error mb-0">Dừng hoạt động</p>';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-partner" data-url='+ row.id +' data-toggle="modal" data-target="#updatePartner"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger delete-partner" data-toggle="modal" data-target="#destroyPartner" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                }
            ]
        });

        $(document).on('change', '#filter_category', function(){
            var category = $(this).val();
            if(category != ""){
                arrCategory.push(Number(category));
                dataCommission.ajax.reload(null, false);
            }
        });

        
        $(document).on('click', '#insert', function () {
            var category_id = $('#category').val();
            var rose_old = $('#rose-old').val();
            var rose_new = $('#rose-new').val();
            if(category_id != "" && rose_old != "" && rose_new != ""){
                $.ajax({
                    type: "POST",
                    url: "{{ route('rose.insert') }}",
                    data: { category_id: category_id, rose_old: rose_old, rose_new:rose_new },
                    success: function(data) {
                        console.log(data);
                        if(data == 1){
                            notification('center', 'warning', 'Tỉ lệ hoa hồng đã tồn tại!', 650, false, 1500);
                        }else{
                            $('#addRowModal').modal('hide');
                            notification('center', 'success', 'Thêm mới tỉ lệ hoa hồng thành công!', 650, false, 1500);
                            dataCommission.ajax.reload(null, false);
                        }
                    }
                });
            }else{
                notification('center', 'error', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
            }
        });

    });
</script>
@endsection
