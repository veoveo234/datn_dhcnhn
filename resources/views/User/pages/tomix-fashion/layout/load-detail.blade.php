@php
function substr_word($str, $limit)
{
    if (stripos($str, ' ')) {
        $ex_str = explode(' ', $str);
        $str_s = '';
        if (count($ex_str) > $limit) {
            for ($i = 0; $i < $limit; $i++) {
                $str_s .= $ex_str[$i] . ' ';
            }
            return $str_s . ' ...';
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}
@endphp

<div class="notification-view" style="z-index: 99999"></div>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">Thông tin sản phẩm</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/images/product/'.$detailWomen[0]->main_image) }}" style="height: 583.78px;" class="d-block w-100" alt="...">
                            </div>
							@if(!empty($detailImage))
								@for($i = 0; $i < count($detailImage); $i++)
									<div class="carousel-item">
										<img src="{{ asset('storage/images/product/'.$detailImage[$i]->sub_image) }}" style="height: 583.78px;" class="d-block w-100" alt="...">
									</div>
								@endfor
							@endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev" title="Previous">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            {{-- <span class="sr-only">Previous</span> --}}
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next" title="Next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            {{-- <span class="sr-only">Next</span> --}}
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $detailWomen[0]->name }}</h3>
                        <div>
                            @if ($detailWomen[0]->sale != 0)
                                <del>
                                    <h6>{{ number_format($detailWomen[0]->price, 0, '', '.') }} VND</h6>
                                </del>
                            @endif
                            <h2>@php $total = ($detailWomen[0]->price) * ((100 - ($detailWomen[0]->sale)) / 100) @endphp {{ number_format($total, 0, '', '.') }} VND
                            </h2>
                        </div>
                        <ul class="list" style="margin: 20px 0;">
                            <li><span>Danh mục</span> : {{ $detailWomen[0]->name_cate }}</a></li>
                            <li><span>Thương hiệu</span> : {{ $detailWomen[0]->name_brand }}</a></li>
                        </ul>
                        <div style="border-top: 1px dotted #eeeeee; border-bottom: 1px dotted #eeeeee;">
                            @php echo substr_word($detailWomen[0]->description, 20) @endphp
                        </div>
                        @if(count($detailSize) > 1)
                        @php $totalProduct = 0; @endphp
                        <div class="product_count" style="margin: 10px 0; padding: 10px 0;" id="display-size">
                            <label id="c-size">Size:</label>
                            <input type="hidden" id="sizeDefault" value="0" >
                            <div style="display: grid; grid-template-columns: auto auto auto auto auto; grid-gap: 10px;">
                                @for($i = 0; $i < count($detailSize); $i++)
                                    <button type="button" class="btn btn-size mr-2" size_id="{{ $detailSize[$i]->id }}" quantitySize="{{ $detailSize[$i]->quantity }}" nameSize="{{ $detailSize[$i]->name_size }}" @if(($detailSize[$i]->quantity) == 0) disabled @endif >{{ $detailSize[$i]->name_size }}</button>
                                @endfor
                            </div>
                        </div>
                        @else
                        <input type="hidden" id="sizeDefault" value="1" >
                        @endif
                        <div><label id="noti-checksize" style="color: red; font-weight: 500;"></label></div>
                        <div class="product_count">
                            <label for="qty">Số lượng:</label>
                            <div
                                style="width: 260px; height: 50px; display: flex; justify-content: space-around; margin-left: 20px; border: 2px solid #eee;">
                                <button
                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                    class="reduced items-count" type="button"><i class="fa fa-minus"
                                        aria-hidden="true"></i></button>
                                <input type="text" name="qty" id="sst" maxlength="12" disabled value="1" title="Số lượng"
                                    class="input-text qty">
                                <button
                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                    class="increase items-count" type="button"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div style="margin: 10px 0">
                            <label class="quantityProduct">@php
                                $sum = 0;
                                for ($i = 0; $i < count($detailSize); $i++) { 
                                    $sum += ($detailSize[$i]->quantity);
                                } 
                                echo 'Có '.$sum.' sản phẩm có sẵn';
                                @endphp</label>
                        </div>
                        <div>
                            <button class="button primary-btn add-to-cart d-flex align-items-center" data-url="{{ $detailWomen[0]->id }}">
                                <i class="fas fa-luggage-cart" style="font-size: 32px; padding-right: 15px;"></i>Thêm vào bộ đồ</button>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
</div>
{{-- <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div> --}}


<script>
    var sizeDefault = $('#sizeDefault').val();
    var sizeProduct = 0;
    var items = {{ $items }};

    function load_data_suit(){
        $.ajax({
            type: "GET",
            url: "{{ route('fashion.loadSuit') }}",
            dataType: "html",
            success: function (data) {         
                $('#suit-default').css({ 'display': 'none' });
                $('#load-suit').css({ 'display': 'flex' });
                $('#load-suit').html(data);
            }
        });
    }

    $(document).on('click', '.btn-size', function(e){
        e.preventDefault();
        $('.btn-size').removeClass('active-size');
        $(this).toggleClass('active-size');

        var size_id = $(this).attr('size_id');
        var quantity = $(this).attr('quantitySize');
        // $('#totalProduct').val(quantitySize);
        $('.quantityProduct').html('Có '+quantity+' sản phẩm có sẵn');
        sizeProduct = $(this).attr('nameSize');
        $('#noti-checksize').html('');
        $('#display-size').css({'background': '#fff'});
        $('#c-size').css({'color': '#777'});
    });
    $('.add-to-cart').click(function(e) {
    // $(document).on('click', '.add-to-cart', function(e){
        e.preventDefault();
        var id = $(this).attr('data-url');
        // var product_id = '{{ $detailWomen[0]->id }}';
        var quantity = $('#sst').val();
        
        if(sizeProduct == "" && sizeDefault == 0){
            $('#noti-checksize').html('Vui lòng chọn Size!');
            $('#display-size').css({'background': '#ff8080'});
            $('#c-size').css({'color': '#000'});
        }else if(sizeDefault == 1){
            sizeProduct = 1;
        }
        $.ajax({
            type: "GET",
            url: "{{ route('fashion.addSuit') }}",
            data: { id: id, quantity: quantity, sizeProduct: sizeProduct, sizeDefault: sizeDefault, items: items},
            success: function (data) {
                if(data == 1){
                    var html = '';
                    html +='\
                    <div class="noti-cart-view animate__animated animate__zoomInDown" style="animation-duration: 0.5s; position: absolute;z-index: 10; top: 40%;opacity:0.7; padding:20px; left: 35%; border-radius: 10px; background: black; position: fixed; text-align: center;">\
                        <span style="font-size: 45px; width: 65px; height: 65px; line-height: 65px; border-radius: 50%; color:white ;background: red" class="fas fa-times" aria-hidden="true"></span>\
                        <p style="margin-top:20px;font-size: 20px; color:white">Bạn đã thêm số lượng tối đa của sản phẩm</p>\
                    </div>';
                    $('.notification-view').html(html);
                    $('.noti-cart').delay(2000).slideUp();
                }else{
                    $('#load-count').load(' .count-cart');
                    var html = '';
                    html +='\
                    <div class="noti-cart-view animate__animated animate__zoomInDown" style="animation-duration: 0.5s; position: absolute;z-index: 10; top: 40%;opacity:0.7; padding:20px; left: 35%; border-radius: 10px; background: black; position: fixed; text-align: center;">\
                        <span style="font-size: 45px; width: 65px; height: 65px; line-height: 65px; border-radius: 50%; color:white ;background:#00CCCC" class="fas fa-check" aria-hidden="true"></span>\
                        <p style="margin-top:20px;font-size: 20px; color:white">Sản phẩm đã được thêm vào bộ đồ</p>\
                    </div>';
                    $('.notification-view').html(html);
                    $('.noti-cart-view').delay(2000).slideUp();
                }
                load_data_suit();
            }
        });

    });
</script>