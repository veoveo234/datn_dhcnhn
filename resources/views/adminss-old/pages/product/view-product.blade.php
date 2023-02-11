@extends('admin-index')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                <!-- Button -->
                <div class="d-flex">
                    <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i> Thêm mới sản phẩm
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Thêm mới</span>
                                    <span class="text-uppercase font-weight-bold text-info">
                                        Sản phẩm
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form" action="" method="POST" enctype="multipart/form-data">
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
                                                <label for="brand">Thương hiệu</label>
                                                <select name="brand" id="brand" class="form-control">
                                                    @foreach ($brand as $value)
                                                        <option value="{{ $value['id'] }}">{{ $value['name_brand'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="product-name">Tên sản phẩm</label>
                                                <input type="text" class="form-control" id="product-name"
                                                    name="product-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Ảnh sản phẩm</label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                    accept="image/*">
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Giá bán</label>
                                                <input type="text" class="form-control" id="price" name="price">
                                            </div>
                                            <div class="form-group">
                                                <label for="ckeditor">Mô tả</label>
                                                <textarea name="description" class="form-control ckeditor"
                                                    id="ckeditor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="insert-product" class="btn btn-primary" data-dismiss="modal">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                    <option value="">-- Trạng thái sản phẩm --</option>
                    <option value="Sản phẩm mới">Sản phẩm mới</option>
                    <option value="Đang bán">Đang bán</option>
                    <option value="Bán chạy nhất">Bán chạy nhất</option>
                    <option value="Giảm giá sốc">Giảm giá sốc</option>
                    <option value="Đã hết hàng">Đã hết hàng</option>
                </select>
            </div>
        </div>

                <!-- Table -->
        <div class="row mt-4">
            <div class="col-md-12 mb-5">
                <div class="table-responsive">
                    <table id="product-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá bán</th>
                                <th>Giảm giá</th>
                                <th>Lượt xem</th>
                                <th>Trạng thái</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal show product -->
    <div class="modal fade" id="show-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
            <div class="modal-content" id="load-detail">

            </div>
        </div>
    </div>

    <!-- Modal update product -->
    <div class="modal fade" id="edit-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
            <div class="modal-content" id="edit-detail">

            </div>
        </div>
    </div>

    <!-- Modal delete product -->
    <div class="modal fade" id="delete-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Thông tin Sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Bạn có chắc chắn muốn xóa sản phẩm này không ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Xóa</button>
            </div>
        </div>
        </div>
    </div>
    
@endsection

@section('script-ajax')
<script>
    $(document).ready(function() {
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


        var dataProduct = $('#product-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "DESC" ]],
            ajax: {
                url  : '{{ route('product.index') }}',
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
                "sLengthMenu": "Hiển thị _MENU_ sản phẩm",
                "sZeroRecords": "Không tìm thấy sản phẩm nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ sản phẩm",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
                {
                    data: 'main_image', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/product') }}/'+row.main_image+'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {data: 'name', name: 'name'},
                {
                    data: 'price', render: function (data, type, row) {
                        return data.toLocaleString()+' VND';
                    }
                },
                {data: 'sale', name: 'sale'},
                {data: 'views', name: 'views'},
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-primary show-product" data-url='+ row.id +' data-toggle="modal" data-target="#show-product"><i class="fas fa-eye"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-product" data-url='+ row.id +' data-toggle="modal" data-target="#edit-product"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger destroy-product" data-toggle="modal" data-target="#delete-product" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
                    }
                }
            ]
        });

        // var info = dataProduct.page.info();
        // console.log(info['page']);
        // data.on( 'order.dt search.dt', function () {
        //     data.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //         cell.innerHTML = i+1;
        //     } );
        // } ).draw();
        
        $('#date_range').on('apply.daterangepicker', function(event, picker) {
            dataProduct.ajax.reload(null, false);
        });

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-program').on('change', function(){
            var valFilter = $("#status-program").val();
            $('#product-datatables').DataTable().search(valFilter).draw();   
        });

        $(document).on('click', '#insert-product', function(e){
            e.preventDefault();
            var category = $('select[name=category] option').filter(':selected').val(),
                brand = $('select[name=brand] option').filter(':selected').val(),
                name = $('#product-name').val(),
                main_image = $('#image')[0].files[0],
                price = $('#price').val(),
                description = CKEDITOR.instances["ckeditor"].getData();

            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("brand_id", brand);
            form_data.append("name", name);
            form_data.append("main_image", main_image);
            form_data.append("price", price);
            form_data.append("description", description);

            $.ajax({
                type: "POST",
                url: "{{ route('product.store') }}",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function() {
                    dataProduct.ajax.reload(null, false);
                }
            });
        });

        //* show product
        $(document).on('click', '.show-product', function(){
            var id = $(this).attr('data-url');
            if(id != "" && id > 0){
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.show') }}",
                    data: { id: id },
                    dataType: "html",
                    success: function(data) {
                        $('#load-detail').html(data);
                    }
                });
            }
        });

        //* update product
        $(document).on('click', '.edit-product', function(){
        // $('.edit-product').click(function() {
            var id = $(this).attr('data-url');
            if(id != "" && id > 0){
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.edit') }}",
                    data: { id: id },
                    dataType: "html",
                    success: function(data) {
                        $('#edit-detail').html(data);
                    }
                });
            }
        });

        //* delete product
        var arrProduct = [];
        $(document).on('click', '.destroy-product', function(e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrProduct.push(id);
            }
        });
        $(document).on('click', '.confirm', function(e){
            e.preventDefault();
            var id = arrProduct.slice(-1)[0];
            $.ajax({
                type: "GET",
                url: "{{ route('product.destroy') }}",
                data: { id: id },
                cache: false,
                success: function() {
                    swal({
                        title: "Xóa sản phẩm thành công!",
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
                    dataProduct.ajax.reload(null, false);
                }
            });
        });

    });

</script>
@endsection
