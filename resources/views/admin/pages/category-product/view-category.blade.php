@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')

@endsection

@section('script')

@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="col-md-12">
        <div class="row mb-25">
            <div class="col-md-4 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700">Quản lý danh mục sản phẩm</h3>
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
                <div class="col-md-2 mt-25 mb-25">
                    <label class="my-input" for="category-fashion">Thời trang</label>
                    <select class="form-control" id="category-fashion" name="category-fashion">
                        <option value="0">Tất cả</option>
                        <option value="1">Nam</option>
                        <option value="2">Nữ</option>
                    </select>
                </div>
                <div class="col-md-2 mt-25 mb-25">
                    <label class="my-input" for="product">Sản phẩm</label>
                    <select class="form-control" id="product" name="product">
                        <option value="0">Tất cả</option>
                        <option value="1">Áo nam</option>
                        <option value="2">Áo nữ</option>
                        <option value="3">Quần nam</option>
                        <option value="4">Quần nữ</option>
                        <option value="5">Giày nam</option>
                        <option value="6">Giày nữ</option>
                        <option value="7">Phụ kiện nam</option>
                        <option value="8">Phụ kiện nữ</option>
                    </select>
                </div>
                <div class="col-md-3 mt-25 mb-25">
                    <label class="my-input" for="name-category">Tìm kiếm tên danh mục</label>
                    <input class="form-control" type="text" name="name-category" id="name-category" placeholder="Tên danh mục">
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
                <table id="datatables" class="display table table-striped table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Thời trang</th>
                            <th>Sản phẩm</th>
                            <th>Tên danh mục</th>
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


<!-- Modal add new -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title font-weight-700">
                    Thêm mới danh mục sản phẩm
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="gender-product" class="my-input">Khách hàng</label>
                            <select name="gender-product" id="gender-product" class="form-control">
                                <option value="0" hidden></option>
                                <option value="1">Thời trang nam</option>
                                <option value="2">Thời trang nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="items" class="my-input">Sản phẩm</label>
                            <select name="items" id="items" class="form-control">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name-cate" class="my-input">Tên danh mục</label>
                            <input type="text" id="name-cate" name="name-cate" class="form-control">
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

<!-- Modal edit  -->
<div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-700" id="exampleModalCenterTitle">Quản lý danh mục sản phẩm</h4>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-info update-category" data-dismiss="modal">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-700" id="exampleModalCenterTitle">Quản lý danh mục sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc chắn muốn xóa danh mục này không ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Xác nhận</button>
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
        var arrCategory = [0], arrProduct = [0];
        var dataCategory = $('#datatables').DataTable({
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
                url: '{{ route('category.index') }}',
                type: 'GET',
                data: function(param) {
                    param.category = arrCategory.slice(-1)[0];
                    param.product = arrProduct.slice(-1)[0];
                }
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ thương hiệu",
                "sZeroRecords": "Không tìm thấy thương hiệu nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ thương hiệu",
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
                    data: 'gender_product', render: function (data, type, row) {
                        if(data == 1){
                            return "Nam";
                        }else if(data == 2){
                            return "Nữ";
                        }
                    }
                },
                {
                    data: 'items', render: function (data, type, row) {
                        if(data == 1){
                            return "Áo nam";
                        }else if(data == 2){
                            return "Áo nữ";
                        }else if(data == 3){
                            return "Quần nam";
                        }else if(data == 4){
                            return "Quần nữ";
                        }else if(data == 5){
                            return "Giày nam";
                        }else if(data == 6){
                            return "Giày nữ";
                        }else if(data == 7){
                            return "Phụ kiện nam";
                        }else if(data == 8){
                            return "Phụ kiện nữ";
                        }
                    }
                },
                {data: 'name_cate', name: 'name_cate'},
                {
                    data: 'status', render: function (data, type, row) {
                        if(data == 1){
                            return "Đang hoạt động";
                        }else if(data == 2){
                            return "Dừng hoạt động";
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {
                    data: '',
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-category" data-url='+ row.id +' data-toggle="modal" data-target="#updateCategory"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger delete-category" data-toggle="modal" data-target="#destroyCategory" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                }
            ]
        });

        $(document).on('change', '#category-fashion', function(){
            var category = $(this).val();
            if(category == 0 || category == 1 || category == 2){
                arrCategory.push(Number(category));
                dataCategory.ajax.reload(null, false);
            }
        });

        $(document).on('change', '#product', function(){
            var product = $(this).val();
            if(product == 0 || product == 1 || product == 2 || product == 3 || product == 4 || product == 5 || product == 6 || product == 7 || product == 8){
                arrProduct.push(Number(product));
                dataCategory.ajax.reload(null, false);
            }
        });

        $(document).on('click', '.search-store', function(){
            var name_category = $('#name-category').val();
            $('#datatables').DataTable().search(name_category).draw();
        });

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

        //* insert
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
                        if(data == 1){
                            notification('center', 'error', 'Tên danh mục đã tồn tại!', 500, false, 1500);
                        }else{
                            notification('center', 'success', 'Thêm mới danh mục thành công!', 500, false, 1500);
                        }
                        $('#addRowModal').modal('hide');
                        $('select[name="gender-product"]').val('');
                        $('select[name="items"]').val('');
                        $('#name-cate').val('');
                        dataCategory.ajax.reload(null, false);
                    }
                });
            }else{
                notification('center', 'warning', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
            }
        });

        //* edit
        var arrCategoryEdit = [];
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
                        arrCategoryEdit.push(categoryEdit[0]['id']);
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
            var id = arrCategoryEdit.slice(-1)[0];
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
                            notification('center', 'error', 'Tên danh mục đã tồn tại!', 500, false, 1500);
                        }else{
                            notification('center', 'success', 'Cập nhật danh mục thành công!', 500, false, 1500);
                        }
                        dataCategory.ajax.reload(null, false);
                    }
                });
            }
        });

        //* delete category
        $(document).on('click', '.delete-category', function (){
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrCategoryEdit.push(id);
            }
        });

        $(document).on('click', '.confirm', function (){
            var id = arrCategoryEdit.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('category.delete') }}",
                success: function() {
                    notification('center', 'success', 'Xóa danh mục sản phẩm thành công!', 500, false, 2000);
                    dataCategory.ajax.reload(null, false);
                }
            });
        });
    });
</script>
@endsection
