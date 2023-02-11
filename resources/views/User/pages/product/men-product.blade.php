@extends('index')
@section('content')

    <!-- ================ start banner area ================= -->
    {{-- <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Shop Women</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Women</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ================ end banner area ================= -->


    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                    <div class="sidebar-categories">
                        <div class="head">Danh mục</div>
                        <ul class="main-categories">
                            <li class="common-filter">
                                <form action="#">
                                    <ul id="load-category">

                                    </ul>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-categories mt-5">
                        <div class="head">Thương hiệu</div>
                        <ul class="main-categories">
                            <li class="common-filter">
                                <form action="#">
                                    <ul id="load-brand">
                                        
                                    </ul>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center" style="background: #f1f6f7">
                        <div class="sorting">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" style="background: #fff">
                                    <a class="nav-link latest active" id="pills-home-tab" data-toggle="pill" href="" role="tab" aria-controls="pills-home" aria-selected="true">Mới nhất</a>
                                </li>
                                <li class="nav-item mr-3 ml-3" style="background: #fff">
                                    <a class="nav-link selling" id="pills-profile-tab" data-toggle="pill" href="" role="tab" aria-controls="pills-profile" aria-selected="false">Bán chạy</a>
                                </li>
                                <li class="nav-item" style="background: #fff">
                                    <a class="nav-link distcount" id="pills-contact-tab" data-toggle="pill" href="" role="tab" aria-controls="pills-contact" aria-selected="false">Giảm giá</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sorting mr-auto">
                            <select class="form-control" style="border: none" id="price-arrangement">
                                <option hidden disabled selected value>Giá</option>
                                <option value="1">Giá: Thấp đến Cao</option>
                                <option value="2">Giá: Cao đến Thấp</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Filter Bar -->
                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list" id="load-product">
                        @include('User/pages/product/pages.load-product')
                    </section>
                    <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </section>
    <!-- ================ category section end ================= -->
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1140px">
            <div class="modal-content" id="view-modal">
               
            </div>
        </div>
    </div>

    <!-- ================ top product area start ================= -->
    {{-- <section class="related-product-area" style="margin-bottom: 100px">
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
    <!-- ================ top product area end ================= -->

@endsection

@section('ajax')
<script>
    $(document).ready(function(){
        var arrPage = [1];
        var arrStatus = [0];
        var arrangement = [0];
        var arrCategory = [0];
        var arrBrand = [0];
        var arrFilter = [0];

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            $(this).attr('href', '"javascript: void(0)"');
            fetch_data(page);
            arrPage.push(page);
        });
        var gender = 1;
        function fetch_data(page) {
            var status = 0;
            var filter = 0;
            var value = arrangement.slice(-1)[0];
            var category_id = arrCategory.slice(-1)[0];
            var brand_id = arrBrand.slice(-1)[0];
            if(gender != "" && status == 0 && filter == 0){
                arrFilter.push(filter);
                arrStatus.push(status);
                $.ajax({
                    type: "GET",
                    url:"/load-product?page="+page,
                    data: { gender: gender, status: status, filter: filter, value: value, category_id: category_id, brand_id: brand_id },
                    success: function(data) {
                        $('#load-product').html(data);
                    }
                });
            }
        }

        $(document).on('click', '.latest', function(){
            var page = arrPage.slice(-1)[0];
            fetch_data();
        });
        $(document).on('click', '.selling', function(){
            var status = 3;
            var page = arrPage.slice(-1)[0];
            var filter = 0;
            var value = arrangement.slice(-1)[0];
            var category_id = arrCategory.slice(-1)[0];
            var brand_id = arrBrand.slice(-1)[0];
            if(gender != "" && status == 3 && page != "" && filter == 0){
                arrFilter.push(filter);
                arrStatus.push(status);
                $.ajax({
                    type: "GET",
                    url:"/load-product?page="+page,
                    data: { gender: gender, status: status, filter: filter, value: value, category_id: category_id, brand_id: brand_id },
                    success: function(data) {
                        $('#load-product').html(data);
                    }
                });
            }
        });

        $(document).on('click', '.distcount', function(){
            var status = 4;
            var page = arrPage.slice(-1)[0];
            var filter = 0;
            var value = arrangement.slice(-1)[0];
            var category_id = arrCategory.slice(-1)[0];
            var brand_id = arrBrand.slice(-1)[0];
            if(gender != "" && status == 4 && page != "" && filter == 0){
                arrFilter.push(filter);
                arrStatus.push(status);
                $.ajax({
                    type: "GET",
                    url:"/load-product?page="+page,
                    data: { gender: gender, status: status, filter: filter, value: value, category_id: category_id, brand_id: brand_id },
                    success: function(data) {
                        $('#load-product').html(data);
                    }
                });
            }
        });

        
        $(document).on('change', '#price-arrangement', function (){
            var value = $(this).val();
            var status = arrStatus.slice(-1)[0];
            var page = arrPage.slice(-1)[0];
            var filter = 1;
            var category_id = arrCategory.slice(-1)[0];
            var brand_id = arrBrand.slice(-1)[0];
            // console.log(brand_id);
            if(gender != "" && filter == 1 && value == 1 || value == 2){
                arrFilter.push(filter);
                arrangement.push(value);
                $.ajax({
                    type: "GET",
                    url:"/load-product?page="+page,
                    data: { gender: gender, status: status, filter: filter, value: value, category_id: category_id, brand_id: brand_id },
                    success: function(data) {
                        $('#load-product').html(data);
                    }
                });
            }
        });

        function load_category(){
            var dataCategory = [];
            $.ajax({
                type: "GET",
                url:"{{ route('load.category') }}",
                data: { gender: gender },
                success: function(data) {
                    var arr = Object.keys(data).map(key => data[key]);
                    dataCategory.push(arr[0]);
                    var option = '';
                    for(let i = 0; i < dataCategory.length; i++){
                        $.each(dataCategory[i], function(key, val){
                            option += '<li class="filter-list"><input class="pixel-radio" type="radio" id="men' + val['id'] + '" name="category" value="' + val['id'] + '"><label for="men' + val['id'] + '">' + val['name_cate'] + '<span> (' + val['countSL'] + ')</span></label></li>';
                            $('#load-category').html(option);
                        });
                    }
                }
            });
        }
        load_category();

        function load_brand(){
            var dataCategory = [];
            $.ajax({
                type: "GET",
                url:"{{ route('load.brand') }}",
                data: { gender: gender },
                success: function(data) {
                    var arr = Object.keys(data).map(key => data[key]);
                    dataCategory.push(arr[0]);
                    var option = '';
                    for(let i = 0; i < dataCategory.length; i++){
                        $.each(dataCategory[i], function(key, val){
                            option += '<li class="filter-list"><input class="pixel-radio" type="radio" id="men' + val['id'] + '" name="brand" value="' + val['id'] + '"><label for="men' + val['id'] + '">' + val['name_brand'] + '<span> (' + val['countSL'] + ')</span></label></li>';
                            $('#load-brand').html(option);
                        });
                    }
                }
            });
        }
        load_brand();

        $(document).on('click', 'input[name=category]', function(){
            var category_id = $(this).val();
            var status = arrStatus.slice(-1)[0];
            var page = arrPage.slice(-1)[0];
            var brand_id = arrBrand.slice(-1)[0];
            var value = arrangement.slice(-1)[0];
            var filter = arrFilter.slice(-1)[0];
            if(category_id != "" && Number(category_id)){
                arrCategory.push(category_id);
                $.ajax({
                    type: "GET",
                    url:"/load-product?page="+page,
                    data: { gender: gender, status: status, filter: filter, value: value, category_id: category_id, brand_id: brand_id },
                    success: function(data) {
                        $('#load-product').html(data);
                    }
                });
            }
        });

        $(document).on('click', 'input[name=brand]', function(){
            var brand_id = $(this).val();
            var status = arrStatus.slice(-1)[0];
            var page = arrPage.slice(-1)[0];
            var category_id = arrCategory.slice(-1)[0];
            var value = arrangement.slice(-1)[0];
            var filter = arrFilter.slice(-1)[0];
            if(brand_id != "" && Number(brand_id)){
                arrBrand.push(brand_id);
                $.ajax({
                    type: "GET",
                    url:"/load-product?page="+page,
                    data: { gender: gender, status: status, filter: filter, value: value, category_id: category_id, brand_id: brand_id },
                    success: function(data) {
                        $('#load-product').html(data);
                    }
                });
            }
        });

        $(document).on('click', '.update-view', function(){
            var url = $(this).attr('data-url');
            if(url != ''){
                $.ajax({
                    type: "PATCH",
                    url: url,
                    success: function () {
                    }
                });
            }
        });

        $(document).on('click', '.modal-product', function(){
            var url = $(this).attr('data-url');
            if(url != ''){
                $.ajax({
                    type: "GET",
                    url: url,
                    // data: { view: view },
                    dataType: "html",
                    success: function (data) {
                        $('#view-modal').html(data);
                    }
                });
            }
        });
    });
</script>
@endsection