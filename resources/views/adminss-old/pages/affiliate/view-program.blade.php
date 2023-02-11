@extends('admin-index')
@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10 offset-1">
            <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#addRowModal">
                <i class="fa fa-plus"></i> Thêm mới chương trình
            </button>
        </div>
    </div>
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
            <select name="status-program" id="status-program" class="border border-primary text-center" style="width: 100%; height: 50px; line-height: 50px;">
                <option value="">-- Trạng thái chương trình --</option>
                <option value="Đang hoạt động">Đang hoạt động</option>
                <option value="Dừng hoạt động">Dừng hoạt động</option>
            </select>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Thêm mới</span>
                        <span class="text-uppercase font-weight-bold text-info">
                            chương trình
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" id="insert-product" action="" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="category">Danh mục</label>
                                    <select name="" id="category" class="form-control selectpicker" data-live-search="true">
                                        <option value="0">-- Chọn danh mục --</option>
                                        @foreach ($category as $value)
                                            <option value="{{ $value->id }}">{{ $value->name_cate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rose_old">Khách hàng cũ</label>
                                    <input type="text" id="rose_old" class="form-control" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="rose_new">Khách hàng mới</label>
                                    <input type="text" id="rose_new" class="form-control" value="" readonly>
                                </div>
                                <div class="form-group load-select">
                                    <label for="product">Sản phẩm muốn tiếp thị</label>
                                    <select name="product" id="product" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="images">Ảnh</label>
                                    <input type="file" class="form-control" id="images" name="images" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor">Mô tả</label>
                                    <textarea name="description" class="form-control ckeditor" id="ckeditor"></textarea>
                                </div>                                 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" id="insert" class="btn btn-primary" data-dismiss="modal">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="program-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh chương trình</th>
                            <th>Danh mục</th>
                            <th>Tên sản phẩm</th>
                            <th>Tiêu đề</th>
                            <th>Khách hàng cũ</th>
                            <th>Khách hàng mới</th>
                            <th>Trạng thái</th>
                            <th>Phê duyệt</th>
                            <th>Xóa</th>
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
<div class="modal fade" id="updateProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý chương trình</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4 class="font-weight-bold">Bạn có chắc chắn muốn xóa chương trình này không ?</h4>
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

        var dataProgram = $('#program-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('program.index') }}',
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
                "sLengthMenu": "Hiển thị _MENU_ chương trình",
                "sZeroRecords": "Không tìm thấy chương trình nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ chương trình",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
                {
                    data: 'image', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/affiliate') }}/'+row.image+'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {data: 'name_cate', name: 'name_cate'},
                {data: 'name', name: 'name'},
                {data: 'title', name: 'title'},
                {data: 'rose_old', name: 'rose_old'},
                {data: 'rose_new', name: 'rose_new'},
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-program" data-url='+ row.id +' data-toggle="modal" data-target="#updateProgram"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger delete-program" data-toggle="modal" data-target="#destroyProgram" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
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

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-program').on('change', function(){
            var valFilter = $("#status-program").val();
            $('#program-datatables').DataTable().search(valFilter).draw();   
        });

        //* insert program
        var arr = [], dataRose = [], dataProduct = [];
        $(document).on('change', '#category', function (){
            var id = $(this).val();
            if(id != "" && id != 0){
                $.ajax({
                    type: "GET",
                    url: "{{ route('program.view') }}",
                    data: { id : id },
                    dataType: "json",
                    success: function(data) {
                        var arr = Object.keys(data).map(key => data[key]);
                        dataRose.push(arr[0][0]);
                        dataProduct.push(arr[1]);
                        $('#rose_old').val(dataRose[0]['rose_old']+' %');
                        $('#rose_new').val(dataRose[0]['rose_new']+' %');
                        var option = '';
                        for(let i = 0; i < dataProduct.length; i++){
                            $.each(dataProduct[i], function(key, val){
                                option += '<option value="' + val['id'] + '">' + val['name'] + '</option>';
                                $('select[name="product"]').html(option);
                            });
                        }
                    }
                });
            }else if(id == 0){
                $('#rose_old').val("");
                $('#rose_new').val("");
                $('.product').html("");
            }
        });
        $(document).on('click', '#insert', function(e){
            e.preventDefault();
            var form_data = new FormData();
            var commission_id = dataRose[0]['id'];
            var product_id = $('select[name="product"]').val();
            var file = $('#images')[0].files[0];
            var fileType = file['type'];
            var title = $('#title').val();
            var rose_old = dataRose[0]['rose_old'];
            var rose_new = dataRose[0]['rose_new'];
            var description = CKEDITOR.instances.ckeditor.getData();
            var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if(product_id != "" && file != "" && title != "" && description != ""){
                if (validImageTypes.includes(fileType)) {
                    form_data.append('commission_id', commission_id);
                    form_data.append('product_id', product_id);
                    form_data.append('file', file);
                    form_data.append('title', title);
                    form_data.append('rose_old', rose_old);
                    form_data.append('rose_new', rose_new);
                    form_data.append('description', description);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('program.insert') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if(data == 0){
                                swal({
                                    title: "Đăng ký chương trình thành công!",
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
                            }else if(data == 1){
                                swal({
                                    title: "Sản phẩm đang đã tồn tại chương trình!",
                                    icon: "error",
                                    buttons: {
                                        confirm: {
                                            text: "Close",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-danger",
                                            closeModal: true
                                        }
                                    },
                                    timer: 1000
                                });
                            }
                            dataProgram.ajax.reload(null, false);
                        }
                    });
                }else{
                }
            }else{
            }
        });

        //* delete program
        var arrProgram = [];
        $(document).on('click', '.delete-program', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrProgram.push(id);
            }
        });

        $(document).on('click', '.confirm', function (e){
            e.preventDefault();
            var id = arrProgram.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('program.delete') }}",
                cache: false,
                success: function() {
                    swal({
                        title: "Chương trình đã bị xóa!",
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
                    dataProgram.ajax.reload(null, false);
                }
            });
        });

        //* edit program
        $(document).on('click', '.edit-program', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: "{{ route('program.edit') }}",
                data: { id : id },
                dataType: "html",
                success: function(data) {
                    $('#load-detail').html(data);
                }
            });
        });
        
    });
</script>
@endsection