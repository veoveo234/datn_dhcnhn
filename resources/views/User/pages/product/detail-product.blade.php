@extends('index')
@section('css')
    <style>
        .btn-success:hover{
            box-shadow:none !important;
            -webkit-box-shadow :none !important;
        }
    </style>
@endsection
@section('content')
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
    <!-- ================ start banner area ================= -->
    {{-- <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Shop Single</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Single</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ================ end banner area ================= -->


    <!--================Single Product Area =================-->
    <div class="product_image_areav mt-4">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/images/product/' . $detailWomen[0]->main_image) }}"
                                    style="height: 583.78px;" class="d-block w-100" alt="...">
                            </div>
                            @if (!empty($detailImage))
                                @for ($i = 0; $i < count($detailImage); $i++)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/images/product/' . $detailImage[$i]->sub_image) }}"
                                            style="height: 583.78px;" class="d-block w-100" alt="...">
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev"
                            title="Previous">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            {{-- <span class="sr-only">Previous</span> --}}
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next"
                            title="Next">
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
                        @if (count($detailSize) > 1)
                            @php $totalProduct = 0; @endphp
                            <div class="product_count" style="margin: 10px 0; padding: 10px 0;" id="display-size">
                                <label id="c-size">Size:</label>
                                <input type="hidden" id="sizeDefault" value="0">
                                <div
                                    style="display: grid; grid-template-columns: auto auto auto auto auto; grid-gap: 10px;">
                                    @for ($i = 0; $i < count($detailSize); $i++)
                                        <button type="button" class="btn btn-size mr-2"
                                            size_id="{{ $detailSize[$i]->id }}"
                                            quantitySize="{{ $detailSize[$i]->quantity }}"
                                            nameSize="{{ $detailSize[$i]->name_size }}" @if ($detailSize[$i]->quantity == 0) disabled @endif>{{ $detailSize[$i]->name_size }}</button>
                                    @endfor
                                </div>
                            </div>
                        @else
                            <input type="hidden" id="sizeDefault" value="1">
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
                                    $sum += $detailSize[$i]->quantity;
                                }
                                echo 'Có ' . $sum . ' sản phẩm có sẵn';
                            @endphp</label>
                        </div>
                        <div style="margin: 10px 0">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#help-size">Hướng dẫn chọn size</i></button>
                        </div>
                        <div>
                            <button class="button primary-btn add-to-cart"><i class="fa fa-cart-plus pr-2" aria-hidden="true"></i>Thêm vào giỏ hàng</button>
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

        
    <!-- Modal delete product -->
    <div class="modal fade" id="help-size" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-700" id="exampleModalCenterTitle">Hướng dẫn chọn size</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Hướng dẫn chọn size Nam</h5>
                    <img src="{{ asset('assets/img/help/quan_ao_nam.jpg')}}" alt="" style="width: 100%">
                    <img src="{{ asset('assets/img/help/giay_nam.jpg')}}" alt="" style="width: 100%">
                    <h5>Hướng dẫn chọn size nữ</h5>
                    <img src="{{ asset('assets/img/help/quan_ao_nu.jpg')}}" alt="" style="width: 100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="false">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="true">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                        aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @php echo $detailWomen[0]->description; @endphp
                </div>
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-lg-12" id="load-comment">
                            @include('User/pages/product/pages.load-comment')
                        </div>
                        <div class="col-lg-12 mt-5">
                            <h4>Bình luận</h4>
                            @if(session()->has('member_id'))
                                <div class="review_box">
                                    <textarea name="comment" id="editor" class="form-control" cols="30" rows="10"></textarea>
                                    <button type="button" class="btn btn-info comment-account">Submit</button>
                                </div>
                            @else
                                <div class="review_box">
                                    <div class="form-group">
                                        <label>Họ tên</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <textarea name="comment" id="editor" class="form-control" cols="30" rows="10"></textarea>
                                    <button type="button" class="btn btn-info add-comment">Submit</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>4.0</h4>
                                        <h6>(03 Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on 3 Reviews</h3>
                                        <ul class="list">
                                            <li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i> 01</a></li>
                                            <li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i> 01</a></li>
                                            <li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i> 01</a></li>
                                            <li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i> 01</a></li>
                                            <li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i> 01</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea
                                        commodo</p>
                                </div>
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-2.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea
                                        commodo</p>
                                </div>
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-3.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea
                                        commodo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <p>Your Rating:</p>
                                <ul class="list">
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <p>Outstanding</p>
                                <form action="#/" class="form-contact form-review mt-3">
                                    <div class="form-group">
                                        <input class="form-control" name="name" type="text" placeholder="Enter your name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="email"
                                            placeholder="Enter email address" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="subject" type="text" placeholder="Enter Subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control different-control w-100" name="textarea" id="textarea"
                                            cols="30" rows="5" placeholder="Enter Message"></textarea>
                                    </div>
                                    <div class="form-group text-center text-md-right mt-3">
                                        <button type="submit" class="button button--active button-review">Submit
                                            Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

    <!--================ Start related Product area =================-->
    {{-- <section class="related-product-area section-margin--small mt-0">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Top <span class="section-intro__style">Product</span></h2>
            </div>
            <div class="row mt-30">
                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-1.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-2.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-3.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-4.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-5.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-6.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-7.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-8.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-9.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-1.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-2.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="{{ asset('assets/img/product/product-sm-3.png') }}" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--================ end related Product area =================-->
@endsection
@section('ajax')
    <script>
        CKEDITOR.replace('editor');

        $(document).ready(function(){
            var arrPage = [1];
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault(); 
                var page = $(this).attr('href').split('page=')[1];
                $(this).attr('href', '"javascript: void(0)"');
                fetch_data(page);
                arrPage.push(page);
            });
            var id = "{{ $detailWomen[0]->id }}";
            if(id != ""){
                arrProduct.push(Number(id));
            }
            function fetch_data(page) {
                if(id != ""){
                    $.ajax({
                        type: "GET",
                        url:"/load-comment?page="+page,
                        data: { id: id },
                        success: function(data) {
                            $('#load-comment').html(data);
                        }
                    });
                }
            }
            
            $(document).on('click', '.add-comment', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var comment = CKEDITOR.instances["editor"].getData();
                var account = 0;
                var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                if(id != "" && name != "" && email != "" && comment != "" && account == 0){
                    if(email.match(mailformat)){
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.comment') }}",
                            data: { id: id, name: name, email: email, comment: comment, account: account },
                            success: function(data) {
                                fetch_data(1);
                                $('#name').val("");
                                $('#email').val("");
                                CKEDITOR.instances.editor.setData("");
                            }
                        });
                    }
                }
            });

            $(document).on('click', '.comment-account', function(e) {
                e.preventDefault();
                var comment = CKEDITOR.instances["editor"].getData();
                var account = 1;
                if(id != "" && comment != "" && account == 1){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('add.comment') }}",
                        data: { id: id, comment: comment, account: account },
                        success: function(data) {
                            fetch_data(1);
                            CKEDITOR.instances.editor.setData("");
                        }
                    });
                }
            });

            $(document).on('click', '.reply-comment', function(e) {
                e.preventDefault();
                var id = $(this).attr('data');
                var name = $('#name'+id).val();
                var email = $('#email'+id).val();
                var reply = CKEDITOR.instances["editor"+id].getData();
                var account = 0;
                var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                var page = arrPage.slice(-1)[0];
                if(id != "" && name != "" && email != "" && reply != "" && account == 0){
                    if(email.match(mailformat)){
                        $.ajax({
                            type: "POST",
                            url: "{{ route('reply.comment') }}",
                            data: { id: id, name: name, email: email, reply: reply, account: account },
                            success: function(data) {
                                fetch_data(page);
                            }
                        });
                    }
                }
            });
            
            $(document).on('click', '.reply-account', function(e) {
                e.preventDefault();
                var id = $(this).attr('data');
                var reply = CKEDITOR.instances["editor"+id].getData();
                var account = 1;
                var page = arrPage.slice(-1)[0];
                if(id != "" && reply != "" && account == 1){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('reply.comment') }}",
                        data: { id: id, reply: reply, account: account },
                        success: function(data) {
                            fetch_data(page);
                        }
                    });
                }
            });

            // edit comment

            var arrId = [];
            var arrCheck = [];
            $(document).on('click', '.edit-cmt', function(e) {
                var id = $(this).attr('data');
                var check = 1;
                if(id != "" && Number(id) && id > 0 && check == 1){
                    arrId.push(id);
                    arrCheck.push(check);
                    var dataComment = [];
                    $.ajax({
                        type: "POST",
                        url: "{{ route('edit.comment') }}",
                        data: { id: id, check: check },
                        success: function(data) {
                            var arr = Object.keys(data).map(key => data[key]);
                            dataComment.push(arr[0][0]);
                            CKEDITOR.instances.editorEdit.setData(dataComment[0]['comment']);
                        }
                    });
                }
            });

            $(document).on('click', '.edit-reply', function(e) {
                var id = $(this).attr('data');
                var check = 2;
                if(id != "" && Number(id) && id > 0 && check == 2){
                    arrId.push(id);
                    arrCheck.push(check);
                    var dataComment = [];
                    $.ajax({
                        type: "POST",
                        url: "{{ route('edit.comment') }}",
                        data: { id: id, check: check },
                        success: function(data) {
                            var arr = Object.keys(data).map(key => data[key]);
                            dataComment.push(arr[0][0]);
                            CKEDITOR.instances.editorEdit.setData(dataComment[0]['comment']);
                        }
                    });
                }
            });

            // update comment
            $(document).on('click', '.updateComment', function(e) {
                var page = arrPage.slice(-1)[0];
                var id = arrId.slice(-1)[0];
                var check = arrCheck.slice(-1)[0];
                var comment = CKEDITOR.instances["editorEdit"].getData();
                if(id != "" && comment != "" && check != ""){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('update.comment') }}",
                        data: { id: id, comment: comment, check: check },
                        success: function(data) {
                            fetch_data(page);
                        }
                    });
                }
            });

            // delete comment
            var arrDel = [];
            var checkDel = [];
            var checkAccount = [];

            $(document).on('click', '.delete-cmt', function(e) {
                var id = $(this).attr('data');
                var checkTable = 1;
                var account = 1;
                if(id != "" && Number(id) && id > 0 && checkTable == 1 && account == 1){
                    arrDel.push(id);
                    checkDel.push(checkTable);
                    checkAccount.push(account);
                }
            });

            $(document).on('click', '.delete-reply', function(e) {
                var id = $(this).attr('data');
                var checkTable = 2;
                var account = 1;
                if(id != "" && Number(id) && id > 0 && checkTable == 2 && account == 1){
                    arrDel.push(id);
                    checkDel.push(checkTable);
                    checkAccount.push(account);
                }
            });

            var arrEmail = [];
            $(document).on('click', '.commentNoAccount', function(e) {
                var id = $(this).attr('data');
                var checkTable = 1;
                var account = 0;
                if(id != "" && Number(id) && id > 0 && checkTable == 1 && account == 0){
                    arrDel.push(id);
                    checkDel.push(checkTable);
                    checkAccount.push(account);
                }
            });

            $(document).on('click', '.deleteComment', function(e) {
                var account = checkAccount.slice(-1)[0];
                if(account == 1){
                    var id = arrDel.slice(-1)[0];
                    var checkTable = checkDel.slice(-1)[0];
                    var page = arrPage.slice(-1)[0];
                    if(id != "" && Number(id) && id > 0 && checkTable == 1 || checkTable == 2){
                        $.ajax({
                            type: "POST",
                            url: "{{ route('delete.comment') }}",
                            data: { id: id, checkTable: checkTable, account: account },
                            success: function(data) {
                                fetch_data(page);
                            }
                        });
                    }
                }else if(account == 0){
                    var id = arrDel.slice(-1)[0];
                    var email = $('#accuracyEmail').val();
                    var checkTable = checkDel.slice(-1)[0];
                    var page = arrPage.slice(-1)[0];
                    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                    if(email.match(mailformat) && email != ""){
                        if(id != "" && Number(id) && id > 0 && checkTable == 1 || checkTable == 2){
                            $.ajax({
                                type: "POST",
                                url: "{{ route('delete.comment') }}",
                                data: { id: id, checkTable: checkTable, account: account, email: email },
                                success: function(data) {
                                    if(data == 'error'){
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'Bạn không thể xóa bình luận của người khác !',
                                            showConfirmButton: false,
                                            timer: 1000
                                        });
                                    }
                                    fetch_data(page);
                                }
                            });
                        }
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Email không được để trống và phải đúng định dạng !',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                }
            });
        });

    </script>
@endsection
