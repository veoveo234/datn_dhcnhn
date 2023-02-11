@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row ">
        <div class="col-md-12 p-0 mb-25 align-items-center">
            <h3 class="text-dark font-weight-700 ml-2">Thêm mới mã khuyến mại</h3>
        </div>
    </div>
    <div class="col-md-12 p-0 ">
        <div class="row bg-white">
            <div class="col-md-4 mb-0 mt-25">
                <label class="my-input" for="code">Mã CODE</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="code" aria-describedby="basic-addon2" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-primary" style="height: 100%;" id="code-random" type="button">Lấy mã</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-0 mt-25">
                <label class="my-input" for="category">Danh mục</label>
                <select name="category" id="category" class="form-control selectpicker" data-live-search="true">
                    <option value="0" >-- Chọn danh mục --</option>
                    @foreach ($category as $value)
                        <option value="{{ $value['id'] }}">{{ $value['name_cate'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-0 mt-25">
                <div class="form-group">
                    <label class="my-input" for="title">Tiêu đề</label>
                    <input type="text" id="title" class="form-control">
                </div>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-md-4 mb-0 mt-25">
                <div class="form-group">
                    <label class="my-input" for="type-code">Loại code</label>
                    <select name="type-code" class="form-control" id="type-code">
                        <option hidden disabled selected></option>
                        <option value="1">Mã giảm giá % theo sản phẩm</option>
                        <option value="2">Mã giảm giá tiền</option>
                        <option value="3">Mã miễn phí vận chuyển</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-0 mt-25">
                <div class="form-group">
                    <label class="my-input" for="title">Số lượng</label>
                    <input class="form-control" type="number" min="1" data-val="Số lượng" name="quantity" id="quantity">
                </div>
            </div>
            <div class="col-md-4 mb-0 mt-25">
                <div class="form-group">
                    <label class="my-input" for="title">Thời gian sử dụng</label>
                    <select name="used-time" class="form-control" id="used-time">
                        <option value="">Chọn thời gian</option>
                        <option value="1">1 ngày</option>
                        <option value="2">3 ngày</option>
                        <option value="3">5 ngày</option>
                        <option value="4">7 ngày</option>
                        <option value="5">15 ngày</option>
                        <option value="6">30 ngày</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-md-4 mb-0 mt-25">
                <div class="form-group" id="load-type-code">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 p-0">
        <div class=" row bg-white pb-5">
            <div class="col-md-6 text-right mt-25">
                <a href="{{ route('discount.index') }}">
                    <button type="button" class="btn btn-secondary font-weight-700" id="cancel" name="cancel" style="height: 40px; width: 191px; border-radius: 25px; font-size: 17px;">Cancel</button>
                </a>
            </div>
            <div class="col-md-6 mt-25">
                <button type="button" class="btn btn-success font-weight-700" id="btn-copmle" name="btn-copmle"
                    style="height: 40px; width: 215px; border-radius: 25px; font-size: 17px;">{{__("Hoàn Tất")}}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('library-js')

@endsection
@section('after-js')
<script>
    function randCode(letters, numbers, either) {
        var chars = [
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", // letters
            "0123456789", // numbers
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789" // either
        ];

        return [letters, numbers, either].map(function(len, i) {
            return Array(len).fill(chars[i]).map(function(x) {
            return x[Math.floor(Math.random() * x.length)];
            }).join('');
        }).concat().join('').split('').sort(function(){
            return 0.5-Math.random();
        }).join('')
    }
    $(document).ready(function () {
        var arrCode = [];
        $(document).on('click','#code-random', function(e){
            var code = randCode(4,5,6);
            arrCode.push(code);
            $('#code').val(code);
        });
        var arrTypeCode = [];
        $(document).on('change', '#type-code', function(e){
            var id = $(this).val();
            var option = '';
            if(id != null){
                if(id == 1){
                    option += '<label class="my-input">Phần trăm giảm giá</label>\
                                <input type="text" id="percent" name="price percent" onKeyup="loadCheckPercent()" data-type="percent" data-val="Phần trăm giảm giá" class="form-control">';
                }else if(id == 2){
                    option += '<label class="my-input">Giảm giá tiền</label>\
                                <input type="text" id="price" name="price" data-type="currency" onKeyup="loadInput()" data-value="Giảm giá tiền" class="form-control">';
                }else if(id == 3){
                    option += '<label class="my-input">Miễn phí vận chuyển</label>\
                                <input type="text" id="price" name="price"  data-type="currency"  onKeyup="loadInput()" data-value="Miễn phí vận chuyển" class="form-control">';
                }
                arrTypeCode.push(id)
                $('#load-type-code').html(option);
            }
        });
        
        $(document).on('click','#btn-copmle', function(e){
            
            var code= $('#code').val();
            var category_id = $('#category').val();
            var title = $('#title').val();
            var typeCode = $('#type-code').val();
            var quantity = $('#quantity').val();
            var time = $('#used-time').val();
            var check = 0;
            console.log(code);
            console.log(category_id);
            console.log(title);
            console.log(typeCode);
            console.log(quantity);
            console.log(time);
            if(typeCode == 1){
                check = 1;
                var price = $('#percent').val();
            }else{
                check = 2;
                var money = $('#price').val();
                var price = money.replaceAll(',',"");
            }
            console.log(price);
            
            if(code != "" && title != "" && typeCode != "" && quantity != "" && time != "" && category_id != "" && price != "")
            {
                $.ajax({
                    url: "{{ route('insert-code') }}",
                    type: "POST",
                    data:{code: code, title: title, quantity: quantity, time:time,typeCode: typeCode,category_id: category_id,price: price,check: check},
                    success:function(data){
                        if(data=='error'){
                            notification('center', 'error','Mã code đã tồn tại !',500, false, 1500);
                        }else{
                            notification('center', 'success','Thêm mã khuyến mại thành công !',500, false, 1500);
                            location.reload();
                        }
                    }
                });
                
            }else{
               notification('center', 'error','Bạn chưa nhập đủ thông tin !',500, false, 1500);
            }
        });
    });
</script>
@endsection