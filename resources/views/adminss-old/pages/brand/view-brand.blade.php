@extends('admin-index')
@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10 offset-1">
            <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#addRowModal">
                <i class="fa fa-plus"></i> Thêm mới thương hiệu
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
                <option value="">-- Trạng thái thương hiệu --</option>
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
                                <label for="name-brand">Tên thương hiệu</label>
                                <input type="text" id="name-brand" name="name-brand" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="images">Ảnh thương hiệu</label>
                                <input type="file" class="form-control" id="images" name="images" accept="image/*">
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
                <table id="brand-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh thương hiệu</th>
                            <th>Tên thương hiệu</th>
                            <th>Lượt xem</th>
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
                <button type="button" class="btn btn-danger update-brand" data-dismiss="modal">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý thương hiệu</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="font-weight-bold">Bạn có chắc chắn muốn xóa thương hiệu này không ?</h4>
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

        var dataBrand = $('#brand-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('brand.index') }}',
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
                "sLengthMenu": "Hiển thị _MENU_ thương hiệu",
                "sZeroRecords": "Không tìm thấy thương hiệu nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ thương hiệu",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
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
                        return "Thời gian tạo: "+ row.created_at +" <br> Cập nhật lúc: "+ row.updated_at +"";
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-brand" data-url='+ row.id +' data-toggle="modal" data-target="#updateBrand"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger delete-brand" data-toggle="modal" data-target="#destroyBrand" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
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
            dataBrand.ajax.reload(null, false);
        });

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-program').on('change', function(){
            var valFilter = $("#status-program").val();
            $('#brand-datatables').DataTable().search(valFilter).draw();   
        });

        //* insert brand
        $(document).on('click', '#insert', function(e){
            e.preventDefault();
            var form_data = new FormData();
            var name_brand = $('#name-brand').val();
            var file = $('#images')[0].files[0];
            var fileType = file['type'];
            var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if(name_brand != "" && file != ""){
                if (validImageTypes.includes(fileType)) {
                    form_data.append('name_brand', name_brand);
                    form_data.append('file', file);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('brand.insert') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            var title = '';
                            var icon = '';
                            var className = '';
                            if(data == 1){
                                title = "Tên thương hiệu đã tồn tại!";
                                icon = "error";
                                className = "btn btn-danger";
                            }else{
                                title = "Thêm mới thương hiệu thành công!";
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
                            dataBrand.ajax.reload(null, false);
                        }
                    });
                }else{
                }
            }else{
            }
        });

        //* delete brand
        var arrBrand = [];
        $(document).on('click', '.delete-brand', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrBrand.push(id);
            }
        });

        $(document).on('click', '.confirm', function (e){
            e.preventDefault();
            var id = arrBrand.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('brand.delete') }}",
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
                    dataBrand.ajax.reload(null, false);
                }
            });
        });

        //* edit brand
        $(document).on('click', '.edit-brand', function (e){
            e.preventDefault();
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
                                        <label for="update-name-brand">Tên thương hiệu</label>\
                                        <input type="text" id="update-name-brand" name="update-name-brand" class="form-control" value="'+ brandEdit[0]['name_brand'] +'">\
                                    </div>\
                                    <div class="form-group d-flex flex-column">\
                                        <label for="images">Ảnh thương hiệu</label>\
                                        <img src="{{ asset('storage/images/brand') }}/'+ brandEdit[0]['image_brand'] +'" alt="" style="width: 300px">\
                                    </div>\
                                    <div class="form-group">\
                                        <label for="update-images">Thay ảnh mới</label>\
                                        <input type="file" class="form-control" id="update-images" name="update-images" accept="image/*">\
                                    </div>\
                                    <div class="form-group">\
                                        <label for="status">Trạng thái</label>\
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
                var title = '';
                var icon = '';
                var className = '';
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
                                    title = "Tên thương hiệu đã tồn tại!";
                                    icon = "error";
                                    className = "btn btn-danger";
                                }else{
                                    title = "Cập nhật thương hiệu thành công!";
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
                    }else{
                        swal({
                            title: "File ảnh không đúng định dạng!",
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
                            timer: 1200
                        });
                    }
                }else{
                    $.ajax({
                        type: "POST",
                        url: "{{ route('brand.update') }}",
                        data: { id: id, name_brand: name_brand, status: status },
                        success: function(data) {
                            if(data == 1){
                                title = "Tên thương hiệu đã tồn tại!";
                                icon = "error";
                                className = "btn btn-danger";
                            }else{
                                title = "Cập nhật thương hiệu thành công!";
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
                }
                dataBrand.ajax.reload(null, false);
            }
        
        });
    });
</script>
@endsection