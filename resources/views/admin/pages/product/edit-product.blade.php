@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')
    <style>
        .avatar-wrapper{
            position: relative;
            height: 200px;
            width: 200px;
            /* margin: 50px auto; */
            border-radius: 0%;
            overflow: hidden;
            box-shadow: 1px 1px 15px -5px black;
            transition: all .3s ease;
        }
        .avatar-wrapper:hover{
            transform: scale(1.05);
            cursor: pointer;
        }
        .avatar-wrapper:hover .profile-pic{
            opacity: .5;
        }
        .avatar-wrapper .profile-pic {
            height: 100%;
            width: 100%;
            transition: all .3s ease;
        }
        .avatar-wrapper .profile-pic:after{
            font-family: FontAwesome;
            content: "\f007";
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            font-size: 190px;
            background: #ecf0f1;
            color: #34495e;
            text-align: center;
        }
        .avatar-wrapper .upload-button {
            position: absolute;
            top: 0; left: 0;
            height: 100%;
            width: 100%;
        }
        .avatar-wrapper .upload-button .fa-arrow-circle-up{
            position: absolute;
            font-size: 234px;
            top: -17px;
            left: 0;
            text-align: center;
            opacity: 0;
            transition: all .3s ease;
            color: #34495e;
        }
        .avatar-wrapper .upload-button:hover .fa-arrow-circle-up{
            opacity: .9;
        }
    </style>
@endsection

@section('script')
{{-- Ckeditor 4 --}}
<script src="{{ asset('admin_assets/ckd/ckeditor.js') }}"></script>

@endsection

@section('content')
@if(isset($data) && !empty($data))
<div class="container-fluid mt-3">
    <div class="row mb-25">
        <div class="col-md-12">
            <div class="col-md-12 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700 mr-5">Quản lý sản phẩm</h3>
                <h4>Cập nhật sản phẩm</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row m-0 bg-white">
                <div class="form-group col-md-12 mb-0 mt-25 d-flex flex-column justify-content-center align-items-center">
                    <label for="category" class="my-input">Ảnh sản phẩm</label>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" src="{{ asset('storage/images/product/' . $data[0]->main_image) }}" />
                        {{-- <img class="profile-pic" src="http://media.doisongphapluat.com/695/2021/3/27/hot-girl-so-huu-vong-1-108cm-khang-dinh-ban-sexy-chu-khong-hu-03.jpg" /> --}}
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload" type="file" id="image-update" accept="image/*"/>
                    </div>
                </div>
            </div>
            <div class="row m-0 bg-white">
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="category" class="my-input">Danh mục</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ $data[0]->name_cate }}" readonly>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="brand" class="my-input">Thương hiệu</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ $data[0]->name_brand }}" readonly>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="name-product" class="my-input">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name-product" name="name-product" value="{{ $data[0]->name }}">
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="price-update" class="my-input">Giá sản phẩm</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="price-update" name="price-update" data-type="currency" placeholder="Giá sản phẩm" value="{{ number_format($data[0]->price, 0, '', ',') }}">
                        <span class="input-group-addon">VND</span>
                    </div>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="sale" class="my-input">Giảm giá</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="sale" name="sale" data-type="percent" placeholder="Giảm giá" data-val="Giảm giá" value="{{ $data[0]->sale }}">
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
                <div class="form-group col-md-4 mb-0 mt-25">
                    <label for="status" class="my-input">Trạng thái</label>
                    <select name="status" class="form-control" id="status">
                        <option value="1" @if ($data[0]->status == 1) selected @endif>Sản phẩm mới</option>
                        <option value="2" @if ($data[0]->status == 2) selected @endif>Đang bán</option>
                        <option value="3" @if ($data[0]->status == 3) selected @endif>Bán chạy nhất</option>
                        <option value="4" @if ($data[0]->status == 4) selected @endif>Giảm giá sốc</option>
                        <option value="5" @if ($data[0]->status == 5) selected @endif>Đã hết hàng</option>
                    </select>
                </div>
            </div>
            <div class="row m-0 bg-white">
                <div class="col-md-12 mt-25">
                    <label for="" class="my-input">Cập nhật số lượng theo size</label>
                </div>
                {{-- Ao nam, ao nu --}}
                @if ($data[0]->items == 1 || $data[0]->items == 2)
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size XS</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="XS">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[0]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size S</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="S">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[1]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size M</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="M">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[2]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size L</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="L">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[3]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size XL</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="XL">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[4]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size XXL</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="XXL">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[5]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                {{-- quan nam, quan nu --}}
                @elseif($data[0]->items == 3 || $data[0]->items == 4)
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 28</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="28">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[0]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 29</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="29">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[1]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 30</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="30">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[2]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 31</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="31">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[3]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 32</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="32">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[4]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 33</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="33">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[5]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                {{-- giay nam, giay nu --}}
                @elseif($data[0]->items == 5 || $data[0]->items == 6)
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 34</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="34">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[0]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 35</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="35">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[1]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 36</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="36">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[2]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 37</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="37">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[3]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 38</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="38">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[4]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 39</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="39">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[5]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 40</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="40">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[6]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 41</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="41">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[7]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 42</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="42">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[8]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 43</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="43">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[9]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 44</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="44">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[10]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Size 45</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="45">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[11]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                {{-- phu kien nam, phu kien nu --}}
                @elseif($data[0]->items == 7 || $data[0]->items == 8)
                    <div class="form-group col-md-4 mb-0 mt-25">
                        <label for="" class="my-input">Số lượng</label>
                        <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="1">
                        <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)){{ 0 }}@else{{ $select_detail[0]->quantity }}@endif" data-type="number" data-val="Số lượng">
                    </div>
                @endif
            </div>
            <div class="row m-0 bg-white">
                <div class="col-md-12 mt-25">
                    <div class="form-group">
                        <label class="my-input">Ảnh phụ mới hiện có</label>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @if (!empty($image_detail))
                                    @for ($i = 0; $i < count($image_detail); $i++)
                                        <th scope="col">Ảnh {{ $i+1 }}</th>
                                    @endfor
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if (!empty($image_detail))
                                    @for ($i = 0; $i < count($image_detail); $i++)
                                        <td><img src="{{ asset('storage/images/product/' . $image_detail[$i]->sub_image) }}" alt="" style="width: 100px"></td>
                                    @endfor
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row m-0 bg-white">
                <div class="form-group col-md-12 mb-0 mt-25">
                    <label for="sub_image" class="my-input">Cập nhật ảnh phụ mới</label>
                    <input type="file" id="sub_image" name="sub_image[]" multiple accept="image/*" class="form-control">
                </div>
            </div>
            <div class="row m-0 bg-white">
                <div class="form-group col-md-12 mb-0 mt-25">
                    <label for="ckeditor" class="my-input">Mô tả</label>
                    <textarea name="description" class="form-control ckeditor" id="ckeditor">{{ $data[0]->description }}</textarea>
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
                    <button type="button" class="btn btn-success font-weight-700" id="update-product" name="update-product" style="height: 40px; width: 215px; border-radius: 25px; font-size: 17px;">Cập nhật sản phẩm</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('library-js')

@endsection
@section('after-js')
@if(isset($data) && !empty($data))
    <script>
        $(document).ready(function() {
            // CKEDITOR.replace('editor');
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }
        
            $(".file-upload").on('change', function(){
                readURL(this);
            });
            
            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });

            $(document).on('click', '#update-product', function(){
                // console.log(123);
            // $('#update-product').click(function() {
                var id = "{{ $data[0]->id }}",
                    // category = $('select[name=category-update] option').filter(':selected').val(),
                    // brand = $('select[name=brand-update] option').filter(':selected').val(),
                    name_product = $('#name-product').val(),
                    main_image = $('#image-update')[0].files[0],
                    // image_old = $('#image_old').val(),
                    price_temp = $('#price-update').val(),
                    sale = $('#sale').val(),
                    status = $('select[name=status] option').filter(':selected').val(),
                    arr1 = $('.name-size'),
                    arr2 = $('.quantity'),
                    description = CKEDITOR.instances["ckeditor"].getData();
                // console.log(price);
                var name_size = [];
                for(var i = 0; i < arr1.length; i++){
                    name_size.push($(arr1[i]).val());
                }
                var quantity = [];
                for(var i = 0; i < arr2.length; i++){
                    if(($(arr2[i]).val()) == '' || ($(arr2[i]).val()) < 0 && ($(arr2[i]).val()) != Number){
                        $(arr2[i]).val(0);
                    }
                    quantity.push($(arr2[i]).val());
                }
                // console.log(quantity);
                var form_data = new FormData();
                var files = $('#sub_image')[0].files;
                
                for (var i = 0; i < files.length; i++) {
                    // var fileType = files[i]['type'];
                    // console.log(fileType);
                    var name = document.getElementById("sub_image").files[i].name;
                    var ext = name.split('.').pop().toLowerCase();
                    if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                        // error_images += '<p>Invalid ' + i + ' File</p>';
                    }
                    // console.log(ext);
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("sub_image").files[i]);

                    form_data.append("sub_image[]", document.getElementById('sub_image').files[i]);
                }
                
                if(id != "" && name_product != "" && price_temp != "" && status != "" && description != ""){
                    var price = price_temp.replaceAll(',', "");
                    form_data.append("id", id);
                    form_data.append("category_id", category);
                    form_data.append("brand_id", brand);
                    form_data.append("name_product", name_product);
                    if(main_image != undefined){
                        var fileType = main_image['type'];
                        var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                        if (validImageTypes.includes(fileType)) {
                            form_data.append("main_image", main_image);
                        }
                    }else{
                    }
                    form_data.append("price", price);
                    form_data.append("sale", sale);
                    form_data.append("status", status);
                    form_data.append("name_size", name_size);
                    form_data.append("quantity", quantity);
                    form_data.append("description", description);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('product.update') }}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if(data == 1){
                                notification('center', 'success', 'Cập nhật sản phẩm thành công!', 500, false, 1500);
                                location.reload();
                            }else if(data == 0){
                                notification('center', 'error', 'Sản phẩm không tồn tại!', 500, false, 1500);
                                window.location.href = "{{ route('product.index') }}";
                            }
                            // dataProduct.ajax.reload(null, false);
                        }
                    });
                }
            });

        });
    </script>
@endif
@endsection
