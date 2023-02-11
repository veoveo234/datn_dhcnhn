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
                <h3 class="text-dark font-weight-700">Quản lý sản phẩm</h3>
            </div>
            <div class="col-md-8 p-0 d-flex justify-content-end">
                <a href="{{ route('product.view.add') }}" class="d-flex justify-content-end align-items-center" style="width: 60px;">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row d-flex align-items-center bg-white m-0">
                <div class="col-md-2 mt-25 mb-25">
                    <label class="my-input" for="brand-fashion">Thương hiệu</label>
                    <select class="form-control" id="brand-fashion" name="brand-fashion">
                        <option value="0">Tất cả</option>
                        @if(isset($brand) && !empty($brand))
                            @foreach ($brand as $val)
                                <option value="{{ $val['id'] }}">{{ $val['name_brand'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2 mt-25 mb-25">
                    <label class="my-input" for="category">Danh mục</label>
                    <select class="form-control" id="category" name="category">
                        <option value="0">Tất cả</option>
                        @if(isset($category) && !empty($category))
                            @foreach ($category as $val)
                                <option value="{{ $val['id'] }}">{{ $val['name_cate'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3 mt-25 mb-25">
                    <label class="my-input" for="name-product">Tìm kiếm tên sản phẩm</label>
                    <input class="form-control" type="text" name="name-product" id="name-product" placeholder="Tên danh mục">
                </div>
                <div class="col-md-3 mt-25 mb-25 custom-search">
                    <div class="input-group">
                        <button class="btn btn-info search-store" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="col-md-2 mt-25 mb-25 custom-search justify-content-end">
                    <div class="input-group" style="width: 60px">
                        <button class="btn btn-warning refresh-data" style="width: 60px; height: 38px;" type="button"><i class="fa fa-refresh" aria-hidden="true"></i></button>
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
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá bán</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
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
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="category" class="my-input">Danh mục</label>
                                <select name="category" id="category" class="form-control">
                                    @foreach ($category as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name_cate'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand" class="my-input">Thương hiệu</label>
                                <select name="brand" id="brand" class="form-control">
                                    @foreach ($brand as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name_brand'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product-name" class="my-input">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product-name" name="product-name">
                            </div>
                            <div class="form-group">
                                <label for="image" class="my-input">Ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="price" class="my-input">Giá bán</label>
                                <input type="text" class="form-control" id="price" name="price" data-type="currency" placeholder="Giá bán">
                            </div>
                            <div class="form-group">
                                <label for="ckeditor" class="my-input">Mô tả</label>
                                <textarea name="description" class="form-control ckeditor" id="ckeditor"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" id="insert-product" class="btn btn-info">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal delete product -->
<div class="modal fade" id="delete-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-700" id="exampleModalCenterTitle">Thông tin Sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc chắn muốn xóa sản phẩm này không ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Xóa</button>
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
        var arrBrand = [0], arrCategory = [0];
        var dataProduct = $('#datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            // "bStateSave": true,
            autofill: true,
            "order": [
                [0, "DESC"]
            ],
            ajax: {
                url: '{{ route('product.index') }}',
                type: 'GET',
                data: function(param) {
                    param.brand = arrBrand.slice(-1)[0];
                    param.category = arrCategory.slice(-1)[0];
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
                    data: 'main_image', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/product') }}/'+ data +'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {data: 'name', name: 'name'},
                {
                    data: 'price', render: function (data, type, row) {
                        return formatDollar(Number(data))+' VND';
                    }
                },
                {
                    data: 'status', render: function (data, type, row) {
                        if(data == 1){
                            return 'Sản phẩm mới';
                        }else if(data == 2){
                            return 'Đang bán';
                        }else if(data == 3){
                            return 'Bán chạy nhất';
                        }else if(data == 4){
                            return 'Giảm giá sốc';
                        }else if(data == 5){
                            return 'Đã hết hàng';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {
                    data: '',
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-product" data-url='+ row.id +' data-toggle="modal" data-target="#edit-product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger destroy-product" data-toggle="modal" data-target="#delete-product" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                }
            ]
        });

        $(document).on('change', '#brand-fashion', function(){
            var brand_id = $(this).val();
            if(brand_id != ""){
                arrBrand.push(Number(brand_id));
                dataProduct.ajax.reload(null, false);
            }
        });

        $(document).on('change', '#category', function(){
            var category = $(this).val();
            if(category != ""){
                arrCategory.push(Number(category));
                dataProduct.ajax.reload(null, false);
            }
        });

        $(document).on('click', '.search-store', function(){
            var filter = $('#name-product').val();
            $('#datatables').DataTable().search(filter).draw();
        });

        $(document).on('click', '.edit-product', function(){
            var id = $(this).attr('data-url');
            if(id != "" && id > 0){
                window.open("product-edit/"+id);
            }
        });

        $(document).on('click', '.refresh-data', function(){
            dataProduct.ajax.reload(null, false);
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
                    notification('center', 'success', 'Xóa sản phẩm thành công!', 500, false, 1500);
                    dataProduct.ajax.reload(null, false);
                }
            });
        });

    });
</script>
@endsection
