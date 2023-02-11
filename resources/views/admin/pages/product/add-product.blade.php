@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')

@endsection

@section('script')
{{-- Ckeditor 4 --}}
<script src="{{ asset('admin_assets/ckd/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row mb-25">
        <div class="col-md-12">
            <div class="col-md-12 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700 mr-5">Quản lý sản phẩm</h3>
                <h4>Thêm mới sản phẩm</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="category" class="my-input">Danh mục</label>
                    <select name="category" id="category" class="form-control">
                        <option value="" hidden>Chọn danh mục</option>
                        @if(isset($category) && !empty($category))
                            @foreach ($category as $val)
                                <option value="{{ $val['id'] }}">{{ $val['name_cate'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="brand" class="my-input">Thương hiệu</label>
                    <select name="brand" id="brand" class="form-control">
                        <option value="" hidden>Chọn thương hiệu</option>
                        @if(isset($brand) && !empty($brand))
                            @foreach ($brand as $val)
                                <option value="{{ $val['id'] }}">{{ $val['name_brand'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="product-name" class="my-input">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="product-name" name="product-name">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="image" class="my-input">Ảnh sản phẩm</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="price" class="my-input">Giá sản phẩm</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="price" name="price" data-type="currency" placeholder="Giá sản phẩm">
                        <span class="input-group-addon">VND</span>
                    </div>
                </div>
            </div>
            <div class="row m-0 bg-white">
                <div class="form-group col-md-12 mb-0 mt-25">
                    <label for="ckeditor" class="my-input">Mô tả</label>
                    <textarea name="description" class="form-control ckeditor" id="ckeditor"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="col-md-6 text-right mt-25 mb-25">
                    <a href="{{ route('product.index') }}">
                        <button type="button" class="btn btn-secondary font-weight-700" id="cancel" name="cancel" style="height: 40px; width: 191px; border-radius: 25px; font-size: 17px;">Cancel</button>
                    </a>
                </div>
                <div class="col-md-6 mt-25 mb-25">
                    <button type="button" class="btn btn-success font-weight-700" id="insert-product" name="insert-product" style="height: 40px; width: 215px; border-radius: 25px; font-size: 17px;">Thêm mới sản phẩm</button>
                </div>
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
        $(document).on('click', '#insert-product', function(e){
            e.preventDefault();
            var category = $('select[name=category] option').filter(':selected').val(),
                brand = $('select[name=brand] option').filter(':selected').val(),
                name = $('#product-name').val(),
                main_image = $('#image')[0].files[0],
                price_text = $('#price').val(),
                description = CKEDITOR.instances["ckeditor"].getData();
            var temp = document.getElementById("image");
            var price = "";
            if(price_text != ""){
                price = price_text.replaceAll(',', "");
            }else{
                price = "";
            }
            if(category != "" && brand != "" && name != "" && description && price != ""){
                if(temp.files.length == 0){
                    notification('center', 'warning', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
                }else{
                    var form_data = new FormData();
                    var fileType = main_image['type'];
                    var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                    if (validImageTypes.includes(fileType)) {
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
                            success: function(data) {
                                if(data == 1){
                                    notification('center', 'success', 'Thêm mới sản phẩm thành công!', 500, false, 1500);
                                    location.reload();
                                }else{
                                    notification('center', 'error', 'Thông tin không hợp lệ!', 500, false, 1500);
                                }
                            }
                        });
                    }else{
                        notification('center', 'warning', 'Ảnh không đúng định dạng!', 500, false, 1500);
                    }
                }
            }else{
                notification('center', 'warning', 'Bạn chưa nhập đủ thông tin!', 500, false, 1500);
            }
        });
    });
</script>
@endsection
