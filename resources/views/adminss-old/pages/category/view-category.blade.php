@extends('admin-index')
@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10 offset-1">
            <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#addRowModal">
                <i class="fa fa-plus"></i> Thêm mới danh mục
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
                <option value="">-- Trạng thái danh mục --</option>
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
                            Danh mục
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
                                <label for="gender-product">Khách hàng</label>
                                <select name="gender-product" id="gender-product" class="form-control">
                                    <option value="0" hidden></option>
                                    <option value="1">Thời trang nam</option>
                                    <option value="2">Thời trang nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="items">Sản phẩm</label>
                                <select name="items" id="items" class="form-control">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name-cate">Tên danh mục</label>
                                <input type="text" id="name-cate" name="name-cate" class="form-control">
                            </div>                      
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    <button type="button" id="insert" class="btn btn-primary" data-dismiss="modal">Thêm mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="category-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thời trang</th>
                            <th>Sản phẩm</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th>Cập nhật</th>
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
<div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý danh mục</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12" id="load-edit">
                         
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger update-category" data-dismiss="modal">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý danh mục</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="font-weight-bold">Bạn có chắc chắn muốn xóa danh mục này không ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Có</button>
            </div>
        </div>
    </div>
</div>
<option value=""></option>

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

        var dataCategory = $('#category-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('category.index') }}',
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
                "sLengthMenu": "Hiển thị _MENU_ danh mục",
                "sZeroRecords": "Không tìm thấy danh mục nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ danh mục",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'gender_product', name: 'gender_product'},
                {data: 'items', name: 'items'},
                {data: 'name_cate', name: 'name_cate'},
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return "Thời gian tạo: "+ row.created_at +" <br> Cập nhật lúc: "+ row.updated_at +"";
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-category" data-url='+ row.id +' data-toggle="modal" data-target="#updateCategory"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger delete-category" data-toggle="modal" data-target="#destroyCategory" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
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
            dataCategory.ajax.reload(null, false);
        });

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-program').on('change', function(){
            var valFilter = $("#status-program").val();
            $('#category-datatables').DataTable().search(valFilter).draw();   
        });

        //* insert category
        $(document).on('change', 'select[name="gender-product"]', function(e){
            var gender = $(this).val();
            var option = '';
            if(gender == 1){
                option = '<option value="1">Áo nam</option>\
                            <option value="3">Quần nam</option>\
                            <option value="5">Giày nam</option>\
                            <option value="7">Phụ kiện nam</option>';
            }else if(gender == 2){
                option = '<option value="2">Áo nữ</option>\
                            <option value="4">Quần nữ</option>\
                            <option value="6">Giày nữ</option>\
                            <option value="8">Phụ kiện nữ</option>';
            }
            $('select[name="items"]').html(option);
        });

        $(document).on('click', '#insert', function(e){
            e.preventDefault();
            var gender = $('select[name="gender-product"]').val();
            var items = $('select[name="items"]').val();
            var name_cate = $('#name-cate').val();
            if(gender != "" && items != "" && name_cate != ""){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('category.insert') }}",
                        data: { gender: gender, items: items, name_cate: name_cate },
                        success: function(data) {
                            var title = '';
                            var icon = '';
                            var className = '';
                            if(data == 1){
                                title = "Tên danh mục đã tồn tại!";
                                icon = "error";
                                className = "btn btn-danger";
                            }else{
                                title = "Thêm mới danh mục thành công!";
                                icon = "success";
                                className = "btn btn-success";
                            }
                            swal({
                                title: title,
                                icon: icon,
                                buttons: {
                                    confirm: {
                                        text: "Close",
                                        value: true,
                                        visible: true,
                                        className: className,
                                        closeModal: true
                                    }
                                },
                                timer: 1200
                            });
                            dataCategory.ajax.reload(null, false);
                        }
                    });
            }else{
            }
        });

        //* delete category
        var arrCategory = [];
        $(document).on('click', '.delete-category', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrCategory.push(id);
            }
        });

        $(document).on('click', '.confirm', function (e){
            e.preventDefault();
            var id = arrCategory.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('category.delete') }}",
                cache: false,
                success: function() {
                    swal({
                        title: "Thương hiệu đã bị xóa!",
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
                        timer: 1200
                    });
                    dataCategory.ajax.reload(null, false);
                }
            });
        });

        //* edit category
        $(document).on('click', '.edit-category', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && Number(id)){
                $.ajax({
                    type: "GET",
                    url: "{{ route('category.edit') }}",
                    data: { id : id },
                    dataType: "json",
                    success: function(data) {
                        var categoryEdit = [];
                        var arr = Object.keys(data).map(key => data[key]);
                        categoryEdit.push(arr[0][0]);
                        var selectedItems1, selectedItems2, selectedItems3, selectedItems4, selectedItems5, selectedItems6, selectedItems7, selectedItems8, selectedStatus1, selectedStatus2;
                        if((categoryEdit[0]['items']) == 1){
                            selectedItems1 = 'selected';
                        }else if(categoryEdit[0]['items'] == 2){
                            selectedItems2 = 'selected'; 
                        }else if(categoryEdit[0]['items'] == 3){
                            selectedItems3 = 'selected'; 
                        }else if(categoryEdit[0]['items'] == 4){
                            selectedItems4 = 'selected'; 
                        }else if(categoryEdit[0]['items'] == 5){
                            selectedItems5 = 'selected'; 
                        }else if(categoryEdit[0]['items'] == 6){
                            selectedItems6 = 'selected'; 
                        }else if(categoryEdit[0]['items'] == 7){
                            selectedItems7 = 'selected'; 
                        }else if(categoryEdit[0]['items'] == 8){
                            selectedItems8 = 'selected'; 
                        }
                        if((categoryEdit[0]['status']) == 1){
                            selectedStatus1 = 'selected';
                        }else if(categoryEdit[0]['status'] == 2){
                            selectedStatus2 = 'selected'; 
                        }
                        var selectedGender = '';
                        if((categoryEdit[0]['gender_product']) == 1){
                            selectedGender = 'selected';
                            var option = '<div class="form-group">\
                                            <label for="update-gender">Khách hàng</label>\
                                            <select name="update-gender" id="update-gender" class="form-control">\
                                                <option value="1" '+ selectedGender +'>Thời trang nam</option>\
                                                <option value="2">Thời trang nữ</option>\
                                            </select>\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="update-items">Sản phẩm</label>\
                                            <select name="update-items" id="update-items" class="form-control">\
                                                <option value="1" '+ selectedItems1 +'>Áo nam</option>\
                                                <option value="3" '+ selectedItems3 +'>Quần nam</option>\
                                                <option value="5" '+ selectedItems5 +'>Giày nam</option>\
                                                <option value="7" '+ selectedItems7 +'>Phụ kiện nam</option>\
                                            </select>\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="update-name">Tên danh mục</label>\
                                            <input type="text" class="form-control" name="update-name" id="update-name" value="'+ categoryEdit[0]['name_cate'] +'">\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="status">Trạng thái</label>\
                                            <select name="status" id="status" class="form-control">\
                                                <option value="1" '+ selectedStatus1 +'>Đang hoạt động</option>\
                                                <option value="2" '+ selectedStatus2 +'>Dừng hoạt động</option>\
                                            </select>\
                                        </div>';
                        }else if(categoryEdit[0]['gender_product'] == 2){
                            selectedGender = 'selected';
                            var option = '<div class="form-group">\
                                            <label for="update-gender">Khách hàng</label>\
                                            <select name="update-gender" id="update-gender" class="form-control">\
                                                <option value="1">Thời trang nam</option>\
                                                <option value="2" '+ selectedGender +'>Thời trang nữ</option>\
                                            </select>\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="update-items">Sản phẩm</label>\
                                            <select name="update-items" id="update-items" class="form-control">\
                                                <option value="2" '+ selectedItems2 +'>Áo nữ</option>\
                                                <option value="4" '+ selectedItems4 +'>Quần nữ</option>\
                                                <option value="6" '+ selectedItems6 +'>Giày nữ</option>\
                                                <option value="8" '+ selectedItems8 +'>Phụ kiện nữ</option>\
                                            </select>\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="update-name">Tên danh mục</label>\
                                            <input type="text" class="form-control" name="update-name" id="update-name" value="'+ categoryEdit[0]['name_cate'] +'">\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="status">Trạng thái</label>\
                                            <select name="status" id="status" class="form-control">\
                                                <option value="1" '+ selectedStatus1 +'>Đang hoạt động</option>\
                                                <option value="2" '+ selectedStatus2 +'>Dừng hoạt động</option>\
                                            </select>\
                                        </div>';
                        }
                        $('#load-edit').html(option);
                        arrCategory.push(categoryEdit[0]['id']);
                    }
                });
            }
        });

         
        $(document).on('change', 'select[name="update-gender"]', function(e){
            var gender = $(this).val();
            var option = '';
            if(gender == 1){
                option = '<option value="1">Áo nam</option>\
                            <option value="3">Quần nam</option>\
                            <option value="5">Giày nam</option>\
                            <option value="7">Phụ kiện nam</option>';
            }else if(gender == 2){
                option = '<option value="2">Áo nữ</option>\
                            <option value="4">Quần nữ</option>\
                            <option value="6">Giày nữ</option>\
                            <option value="8">Phụ kiện nữ</option>';
            }
            $('select[name="update-items"]').html(option);
        });
        
        $(document).on('click', '.update-category', function (e){
            e.preventDefault();
            var id = arrCategory.slice(-1)[0];
            var gender = $('select[name="update-gender"]').val();
            var items = $('select[name="update-items"]').val();
            var name_cate = $('#update-name').val();
            var status = $('select[name="status"]').val();
            
            if(gender != "" && items != "" && name_cate != "" && status != ""){
                var title = '';
                var icon = '';
                var className = '';
                $.ajax({
                    type: "POST",
                    url: "{{ route('category.update') }}",
                    data: { id: id, gender: gender, items: items, name_cate: name_cate, status: status },
                    success: function(data) {
                        if(data == 1){
                            title = "Tên danh mục đã tồn tại!";
                            icon = "error";
                            className = "btn btn-danger";
                        }else{
                            title = "Cập nhật danh mục thành công!";
                            icon = "success";
                            className = "btn btn-success";
                        }
                        swal({
                            title: title,
                            icon: icon,
                            buttons: {
                                confirm: {
                                    text: "Close",
                                    value: true,
                                    visible: true,
                                    className: className,
                                    closeModal: true
                                }
                            },
                            timer: 1200
                        });
                    }
                });
                dataCategory.ajax.reload(null, false);
            }
        });
    });
</script>
@endsection