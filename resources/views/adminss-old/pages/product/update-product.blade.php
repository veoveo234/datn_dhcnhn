<div class="modal-header no-bd">
    <h5 class="modal-title">
        <span class="fw-mediumbold">
            Cập nhật</span>
        <span class="text-uppercase font-weight-bold text-info">
            Sản phẩm
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
                <label for="category-update">Danh mục</label>
                <select name="category-update" id="category-update" class="form-control">
                    @foreach ($category as $value)
                        <option value="{{ $value['id'] }}" @if ($value['id'] == $data[0]['category_id']) selected @endif>
                            {{ $value['name_cate'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="brand-update">Thương hiệu</label>
                <select name="brand-update" id="brand-update" class="form-control">
                    @foreach ($brand as $value)
                        <option value="{{ $value['id'] }}" @if ($value['id'] == $data[0]['brand_id']) selected @endif>
                            {{ $value['name_brand'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name-product">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name-product" name="product_name" value="{{ $data[0]['name'] }}">
            </div>
            <div class="form-group">
                <label for="image-update">Ảnh sản phẩm</label>
                <input type="file" class="form-control" id="image-update" name="image-update" accept="image/*">
            </div>
            <div class="form-group">
                <input type="hidden" id="image_old" name="image_old" value="{{ $data[0]['main_image'] }}">
                <img src="{{ asset('storage/images/product/' . $data[0]['main_image']) }}" style="width: 300px" alt="{{ $data[0]['main_image'] }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="price-update">Giá bán</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="price-update" name="price-update" aria-describedby="basic-addon2" value="{{ $data[0]['price'] }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">VND</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sale">Giảm giá</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="sale" name="sale" aria-describedby="basic-addon2" value="{{ $data[0]['sale'] }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" class="form-control" id="status">
                    <option value="1" @if ($data[0]['status'] == 1) selected @endif>Sản phẩm mới</option>
                    <option value="2" @if ($data[0]['status'] == 2) selected @endif>Đang bán</option>
                    <option value="3" @if ($data[0]['status'] == 3) selected @endif>Bán chạy nhất</option>
                    <option value="4" @if ($data[0]['status'] == 4) selected @endif>Giảm giá sốc</option>
                    <option value="5" @if ($data[0]['status'] == 5) selected @endif>Đã hết hàng</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="views">Lượt xem</label>
                <input type="text" class="form-control" id="views" name="views" value="{{ $data[0]['views'] }}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Cập nhật số lượng theo size</label>
            </div>
             {{-- Ao nam, ao nu --}}
            @if ($checkItems[0]->items == 1 || $checkItems[0]->items == 2)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size XS</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="XS">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[0]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size S</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="S">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[1]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size M</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="M">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[2]->quantity }}@endif">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size L</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="L">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[3]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size XL</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="XL">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[4]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size XXL</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="XXL">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[5]->quantity }}@endif">
                        </div>
                    </div>
                </div>
             {{-- quan nam, quan nu --}}
            @elseif($checkItems[0]->items == 3 || $checkItems[0]->items == 4)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 28</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="28">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[0]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 29</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="29">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[1]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 30</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="30">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[2]->quantity }}@endif">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 31</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="31">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[3]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 32</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="32">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[4]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 33</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="33">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[5]->quantity }}@endif">
                        </div>
                    </div>
                </div>
             {{-- giay nam, giay nu --}}
            @elseif($checkItems[0]->items == 5 || $checkItems[0]->items == 6)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 34</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="34">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[0]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 35</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="35">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[1]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 36</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="36">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[2]->quantity }}@endif">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 37</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="37">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[3]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 38</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="38">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[4]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 39</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="39">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[5]->quantity }}@endif">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 40</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="40">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[6]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 41</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="41">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[7]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 42</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="42">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[8]->quantity }}@endif">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 43</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="43">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[9]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 44</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="44">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[10]->quantity }}@endif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Size 45</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="45">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[11]->quantity }}@endif">
                        </div>
                    </div>
                </div>
            {{-- phu kien nam, phu kien nu --}}
            @elseif($checkItems[0]->items == 7 || $checkItems[0]->items == 8)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="hidden" id="name_size" name="name_size[]" class="form-control name-size" value="1">
                            <input type="text" id="quantity" name="quantity[]" class="form-control quantity" value="@if (empty($select_detail)) {{ 0 }}@else{{ $select_detail[0]->quantity }}@endif">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Ảnh phụ mới hiện có</label>
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
                                <td><img src="{{ asset('storage/images/product/' . $image_detail[$i]->sub_image) }}"
                                        alt="" style="width: 100px"></td>
                            @endfor
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="sub_image">Cập nhật ảnh phụ mới</label>
                <input type="file" id="sub_image" name="sub_image[]" multiple accept="image/*" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="editor">Mô tả</label>
                <textarea name="description" class="form-control" id="editor">{{ $data[0]['description'] }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Thời gian đăng</label>
                <input type="text" class="form-control" id="" name="" value="{{ $data[0]['created_at'] }}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Cập nhật lúc</label>
                <input type="text" class="form-control" id="" name="" value="{{ $data[0]['updated_at'] }}" readonly>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer no-bd">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="button" id="update-product" class="btn btn-primary" data-dismiss="modal">Cập nhật</button>
</div>
<script>
    CKEDITOR.replace('editor');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        var dataProduct = $('#product-datatables').DataTable();

        // $(document).on('click', '#update-product', function(e){
        $('#update-product').click(function() {
            var id = "{{ $data[0]['id'] }}",
                category = $('select[name=category-update] option').filter(':selected').val(),
                brand = $('select[name=brand-update] option').filter(':selected').val(),
                name_product = $('#name-product').val(),
                main_image = $('#image-update')[0].files[0],
                image_old = $('#image_old').val(),
                price = $('#price-update').val(),
                sale = $('#sale').val(),
                status = $('select[name=status] option').filter(':selected').val(),
                arr1 = $('.name-size'),
                arr2 = $('.quantity'),
                description = CKEDITOR.instances["editor"].getData();
            
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
                console.log(ext);
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("sub_image").files[i]);

                form_data.append("sub_image[]", document.getElementById('sub_image').files[i]);
            }
            
            if(id != "" && category != "" && brand != "" && name_product != "" && price != "" && status != "" && description != "" && price != String && price > 0 && image_old != ""){
            
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

                form_data.append("image_old", image_old);
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
                        dataProduct.ajax.reload(null, false);
                    }
                });
            }
        });
    });
</script>
