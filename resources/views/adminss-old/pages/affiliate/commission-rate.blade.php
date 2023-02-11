@extends('admin-index')
@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10 offset-1">
            <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#addRowModal">
                <i class="fa fa-plus"></i> Thêm mới tỉ lệ hoa hồng
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                                    @foreach ($category as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name_cate'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rose-old">Khách hàng cũ</label>
                                <input type="number" class="form-control" id="rose-old" name="">
                            </div>
                            <div class="form-group">
                                <label for="rose-new">Khách hàng mới</label>
                                <input type="number" class="form-control" id="rose-new" name="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="insert" class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="rose-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danh mục</th>
                            <th>Khách hàng cũ</th>
                            <th>Khách hàng mới</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
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
<div class="modal fade" id="updateRose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyRose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý tỉ lệ hoa hồng</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4 class="font-weight-bold">Bạn có chắc chắn muốn xóa tỉ lệ hoa hồng này không ?</h4>
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

        var dataRose = $('#rose-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('rose.index') }}',
                type : 'GET',
                data: function() {
                }
            },
            // "targets": 0,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ tỉ lệ hoa hồng",
                "sZeroRecords": "Không tìm thấy tỉ lệ hoa hồng nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ tỉ lệ hoa hồng",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name_cate', name: 'name_cate'},
                {
                    data: '', render: function (data, type, row) {
                        return row.rose_old +" %";
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return row.rose_new +" %";
                    }
                },
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return "Thời gian tạo: "+ row.created_at +" <br> Cập nhật lúc: "+ row.updated_at +"";
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-rose" data-url='+ row.id +' data-toggle="modal" data-target="#updateRose"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger delete-rose" data-toggle="modal" data-target="#destroyRose" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
                    }
                }
            ]
        });
        
        $('input[type=search]').focus(function() {
            $(this).select();
        });

        //* delete rose
        var arrRose = [];
        $(document).on('click', '.delete-rose', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrRose.push(id);
            }
        });
        $(document).on('click', '.confirm', function (e){
            e.preventDefault();
            var id = arrRose.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('rose.delete') }}",
                success: function() {
                    swal({
                        title: "Tỉ lệ hoa hồng đã bị xóa!",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Close",
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                                closeModal: true
                            }
                        },
                        timer: 1000
                    });
                    dataRose.ajax.reload(null, false);
                }
            });
        });

        // //* Edit record
        $(document).on('click', '.edit-rose', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: "{{ route('rose.edit') }}",
                data: { id : id },
                dataType: "html",
                success: function(data) {
                    $('#load-detail').html(data);
                }
            });
        });

        $(document).on('click', '#insert', function (e) {
            e.preventDefault();
            var category_id = $('#category').val();
            var rose_old = $('#rose-old').val();
            var rose_new = $('#rose-new').val();
            $.ajax({
                type: "POST",
                url: "{{ route('rose.insert') }}",
                data: { category_id: category_id, rose_old: rose_old, rose_new:rose_new },
                success: function(data) {
                    // if(data == 'success'){
                        swal({
                            title: "Thêm mới tỉ lệ hoa hồng thành công!",
                            icon: "success",
                            buttons: {
                                confirm: {
                                    text: "Close",
                                    value: true,
                                    visible: true,
                                    className: "btn btn-success",
                                    closeModal: true
                                }
                            },
                            timer: 1000
                        });
                        dataRose.ajax.reload(null, false);
                    // }
                }
            });
        });
        
    });
</script>
@endsection