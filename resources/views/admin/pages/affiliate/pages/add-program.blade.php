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
                <h3 class="text-dark font-weight-700 mr-5">Quản lý chương trình</h3>
                <h4>Thêm mới chương trình</span>
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
                                <option value="{{ $val->id }}">{{ $val->name_cate }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="rose_old" class="my-input">Khách hàng cũ</label>
                    <input type="text" class="form-control" id="rose_old" name="" data-type="percent" data-val="Giá trị" readonly>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="rose_new" class="my-input">Khách hàng mới</label>
                    <input type="text" class="form-control" id="rose_new" name="" data-type="percent" data-val="Giá trị" readonly>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="product" class="my-input">Sản phẩm muốn tiếp thị</label>
                    <select name="product" id="product" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="images" class="my-input">Ảnh chương trình</label>
                    <input type="file" class="form-control" id="images" name="images" accept="image/*">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="title" class="my-input">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0 bg-white">
        <div class="form-group col-md-12 mb-0 mt-25">
            <label for="ckeditor" class="my-input">Mô tả</label>
            <textarea name="description" class="form-control ckeditor" id="ckeditor"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="col-md-6 text-right mt-25 mb-25">
                    <a href="{{ route('program.index') }}">
                        <button type="button" class="btn btn-secondary font-weight-700" id="cancel" name="cancel" style="height: 40px; width: 191px; border-radius: 25px; font-size: 17px;">Quay lại</button>
                    </a>
                </div>
                <div class="col-md-6 mt-25 mb-25">
                    <button type="button" class="btn btn-success font-weight-700" id="insert" name="insert" style="height: 40px; width: 230px; border-radius: 25px; font-size: 17px;">Thêm mới chương trình</button>
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
                        if(dataRose.length === 0){
                            $('#rose_old').val('');
                            $('#rose_new').val('');
                        }else{
                            $('#rose_old').val(dataRose[0]['rose_old']+' %');
                            $('#rose_new').val(dataRose[0]['rose_new']+' %');
                        }
                        if(dataProduct.length === 0){
                            $('select[name="product"]').html('');
                        }else{
                            var option = '';
                            for(let i = 0; i < dataProduct.length; i++){
                                $.each(dataProduct[i], function(key, val){
                                    option += '<option value="' + val['id'] + '">' + val['name'] + '</option>';
                                    $('select[name="product"]').html(option);
                                });
                            }
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
                                notification('center', 'success', 'Đăng ký chương trình thành công!', 650, false, 1500);
                                location.reload();
                            }else if(data == 1){
                                notification('center', 'error', 'Sản phẩm đang đã tồn tại chương trình!', 650, false, 1500);
                            }
                        }
                    });
                }else{
                }
            }else{
            }
        });
    });
</script>
@endsection
