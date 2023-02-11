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
                <h3 class="text-dark font-weight-700">Quản lý thương hiệu</h3>
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
                    <label class="my-input" for="name-brand">Tên thương hiệu</label>
                    <input class="form-control" type="text" name="name-brand" id="name-brand" placeholder="Tên thương hiệu">
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
                            <th>Ảnh thương hiệu</th>
                            <th>Tên thương hiệu</th>
                            <th>Lượt xem</th>
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
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm mới</span>
                    <span class="text-uppercase font-weight-bold text-info">
                        Thương hiệu
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
                            <label for="name-brand-create" class="my-input">Tên thương hiệu</label>
                            <input type="text" id="name-brand-create" name="name-brand-create" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="images" class="my-input">Ảnh thương hiệu</label>
                            <input type="file" class="form-control" id="images" name="images" accept="image/*">
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
<div class="modal fade" id="updateBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý thương hiệu</h3>
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
                <button type="button" class="btn btn-info update-brand" data-dismiss="modal">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase font-weight-700" id="exampleModalCenterTitle">Quản lý thương hiệu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Bạn có chắc chắn muốn xóa thương hiệu này không?</h6>
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
        var dataBrand = $('#datatables').DataTable({
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
                url: '{{ route('brand.index') }}',
                type: 'GET',
                data: function(param) {

                }
            },
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
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
                    data: 'image_brand', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/brand') }}/'+ row.image_brand +'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {data: 'name_brand', name: 'name_brand'},
                {data: 'views', name: 'views'},
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return "Ngày tạo: "+ row.created_at;
                    }
                },
                {
                    data: '',
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-brand" data-url='+ row.id +' data-toggle="modal" data-target="#updateBrand"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger delete-brand" data-toggle="modal" data-target="#destroyBrand" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                }
            ]
        });

        $(document).on('click', '.search-store', function(){
            var name_brand = $('#name-brand').val();
            $('#datatables').DataTable().search(name_brand).draw();
        });

        //* insert brand
        $(document).on('click', '#insert', function(){
            var form_data = new FormData();
            var name_brand = $('#name-brand-create').val();
            var file = $('#images')[0].files[0];
            var temp = document.getElementById("images");
            // console.log(name_brand);
            if(name_brand == "" || temp.files.length == 0){
                notification('center', 'warning', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
            }else{
                var fileType = file['type'];
                var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                if (validImageTypes.includes(fileType)) {
                    form_data.append('name_brand', name_brand);
                    form_data.append('file', file);
                    // console.log(form_data);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('brand.insert') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if(data == 1){
                                notification('center', 'error', 'Tên thương hiệu đã tồn tại!', 500, false, 1500);
                            }else{
                                notification('center', 'success', 'Thêm mới thương hiệu thành công!', 500, false, 1500);
                                $('#addRowModal').modal('hide');
                                $('#name-brand').val('');
                                $('#images').val('');
                                dataBrand.ajax.reload(null, false);
                            }
                        }
                    });
                }else{
                    notification('center', 'warning', 'Ảnh không đúng định dạng!', 500, false, 1500);
                }
            }
        });
        //* edit brand
        var arrBrand = [];
        $(document).on('click', '.edit-brand', function (){
            var id = $(this).attr('data-url');
            if(id != "" && Number(id)){
                $.ajax({
                    type: "GET",
                    url: "{{ route('brand.edit') }}",
                    data: { id : id },
                    dataType: "json",
                    success: function(data) {
                        var brandEdit = [];
                        var arr = Object.keys(data).map(key => data[key]);
                        brandEdit.push(arr[0][0]);
                        var selectedIs = '';
                        var selectedStop = '';
                        if((brandEdit[0]['status']) == 1){
                            selectedIs = 'selected';
                        }else if(brandEdit[0]['status'] == 2){
                            selectedStop = 'selected';
                        }
                        var option = '<div class="form-group">\
                                        <label for="update-name-brand" class="my-input">Tên thương hiệu</label>\
                                        <input type="text" id="update-name-brand" name="update-name-brand" class="form-control" value="'+ brandEdit[0]['name_brand'] +'">\
                                    </div>\
                                    <div class="form-group d-flex flex-column">\
                                        <label for="images" class="my-input">Ảnh thương hiệu</label>\
                                        <img src="{{ asset('storage/images/brand') }}/'+ brandEdit[0]['image_brand'] +'" alt="" style="width: 300px">\
                                    </div>\
                                    <div class="form-group">\
                                        <label for="update-images" class="my-input">Thay ảnh mới</label>\
                                        <input type="file" class="form-control" id="update-images" name="update-images" accept="image/*">\
                                    </div>\
                                    <div class="form-group">\
                                        <label for="status" class="my-input">Trạng thái</label>\
                                        <select name="status" id="status" class="form-control">\
                                            <option value="1" '+ selectedIs +'>Đang hoạt động</option>\
                                            <option value="2" '+ selectedStop +'>Dừng hoạt động</option>\
                                        </select>\
                                    </div>';
                        $('#load-edit').html(option);
                        arrBrand.push(brandEdit[0]['id']);
                    }
                });
            }
        });

        $(document).on('click', '.update-brand', function (e){
            e.preventDefault();
            var id = arrBrand.slice(-1)[0];
            var name_brand = $('#update-name-brand').val();
            var file = $('#update-images')[0].files[0];
            var status = $('select[name="status"]').val();

            if(name_brand != "" && status != ""){
                if(file != undefined){
                    var fileType = file['type'];
                    var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                    var form_data = new FormData();
                    if (validImageTypes.includes(fileType)) {
                        form_data.append('id', id);
                        form_data.append('name_brand', name_brand);
                        form_data.append('file', file);
                        form_data.append('status', status);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('brand.update') }}",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                if(data == 1){
                                    notification('center', 'error', 'Tên thương hiệu đã tồn tại!', 500, false, 1500);
                                }else{
                                    notification('center', 'success', 'Cập nhật thương hiệu thành công!', 500, false, 1500);
                                }
                            }
                        });
                    }else{
                        notification('center', 'error', 'File ảnh không đúng định dạng!', 500, false, 1500);
                    }
                }else{
                    $.ajax({
                        type: "POST",
                        url: "{{ route('brand.update') }}",
                        data: { id: id, name_brand: name_brand, status: status },
                        success: function(data) {
                            if(data == 1){
                                notification('center', 'error', 'Tên thương hiệu đã tồn tại!', 500, false, 1500);
                            }else{
                                notification('center', 'success', 'Cập nhật thương hiệu thành công!', 500, false, 1500);
                            }
                        }
                    });
                }
                setTimeout(setTimeLoad, 1000);
            }
        });

        function setTimeLoad(){
            dataBrand.ajax.reload(null, false);
        }

        //* delete brand
        $(document).on('click', '.delete-brand', function (){
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrBrand.push(id);
            }
        });

        $(document).on('click', '.confirm', function (){
            var id = arrBrand.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('brand.delete') }}",
                cache: false,
                success: function() {
                    notification('center', 'success', 'Thương hiệu đã bị xóa!', 500, false, 1500);
                    dataBrand.ajax.reload(null, false);
                }
            });
        });

    });
</script>
@endsection
