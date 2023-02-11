@extends('index')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1>Thời trang @if($id == 1) nam @elseif($id == 2) nữ @endif </h1>
            <button type="button" class="btn btn-warning add-cart" style="font-size: 20px;"><i class="fas fa-luggage-cart" style="font-size: 20px; padding-right: 15px;"></i>Thêm vào giỏ hàng</button>
        </div>
    </div>
</div>
<div class="container-fluid mt-5 mb-4">
    <div class="row justify-content-center" id="load-suit">
        
    </div>
</div>
<div class="container">
    <div class="row">
        @if($id == 1)
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="1" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Áo nam</button>
            </div>
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="3" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Quần nam</button>
            </div>
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="5" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Giày nam</button>
            </div>
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="7" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Sản phẩm khác</button>
            </div>
        @elseif($id == 2)
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="2" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Áo nữ</button>
            </div>
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="4" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Quần nữ</button>
            </div>
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="6" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Giày nữ</button>
            </div>
            <div class="col cate-col">
                <button type="button" class="btn btn-success select-category" data-url="8" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Sản phẩm khác</button>
            </div>
        @endif
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <div class="grid-container">
                    </div>
                    <input type="hidden" id="cate_id" name="cate_id" value="0">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container" id="load-data">
    <!-- Table -->
    <div class="row mt-4 content-database">
        <div class="col-md-12 mb-5">
            <div class="table-responsive">
                <table id="product-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá bán</th>
                            <th>Xem chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1140px">
        <div class="modal-content" id="view-modal">
            
        </div>
    </div>
</div>


@endsection

@section('ajax')

<script>
    $(document).ready(function() {
        var gender = {{ $id }};
        var arrItems = [];
        $('#load-data').css({ 'display': 'none' });

        function load_data_suit(){
            $.ajax({
                type: "GET",
                url: "{{ route('fashion.loadSuit') }}",
                dataType: "html",
                success: function (data) {
                    $('#load-suit').html(data);
                }
            });
        }
        load_data_suit();

        $(document).on('click', '.select-category', function(){
            $('#load-data').css({ 'display': 'none' });
            var items = $(this).attr('data-url');
            arrItems.push(items);
            if(gender == 1  || gender == 2){
                if(items == 1  || items == 2 || items == 3  || items == 4 || items == 5  || items == 6 || items == 7 || items == 8){
                    $.ajax({
                        type: "GET",
                        url: "{{ route('fashion.loadCategory') }}",
                        data: { items: items, gender: gender },
                        dataType: "json",
                        success: function (data) {
                            $('.grid-container').html("");
                            var dataCate = [];
                            var arr = Object.keys(data).map(key => data[key]);
                            dataCate.push(arr[0]);
                            var option = '';
                            $('.grid-container').html("");
                            for(let i = 0; i < dataCate.length; i++){
                                $.each(dataCate[i], function(key, val){
                                    option += '<div class="grid-item btn bg-info" cate-id="' + val['id'] + '">' + val['name_cate'] + '</div>';
                                    $('.grid-container').html(option);
                                });
                            }
                        }
                    });
                }
            }
        });
        
        var dataProduct = $('#product-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            bLengthChange: false,
            "bInfo": false,
            "bStateSave": true,
            "order": [[ 0, "DESC" ]],
            ajax: {
                type: 'GET',
                url: '{{ route('fashion.loadProduct') }}',
                data: function(param) {
                    param.id = $('#cate_id').val();
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
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-primary show-product" data-url='+ row.id +' data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-eye"></i></button>';
                    }
                }
            ]
        });

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $(document).on('click', '.grid-item', function(){
            var id = $(this).attr('cate-id');
            $('#cate_id').val(id);
            $('#load-data').css({ 'display': 'block' });
            $('#product-datatables_wrapper .row .col-md-12:first-child').css({ 'display': 'none' });
            if(id != "" && id > 0 && id != String){
                dataProduct.ajax.reload(null, false);
            }
        });

        $(document).on('click', '.show-product', function(){
            var id = $(this).attr('data-url');
            var items = arrItems.slice(-1)[0];
            if(id != "" && id > 0 && id != String){
                $.ajax({
                    type: "GET",
                    url: "{{ route('fashion.detailProduct') }}",
                    data: { id: id, items: items },
                    dataType: "html",
                    success: function (data) {
                        $('#view-modal').html(data);
                    }
                });
            }
        });

        $(document).on('click', '.add-cart', function(){
            $.ajax({
                type: "GET",
                url: "{{ route('fashion.addSuitCart') }}",
                success: function (data) {
                    if(data == 'success'){
                        $('#load-count').load(' .count-cart');
                        notification('center', 'success', 'Sản phẩm đã được thêm vào giỏ hàng', 650, false, 2000);
                    }else if(data == 'error'){
                        notification('center', 'warning', 'Bộ đồ cơ bản phải có Áo - Quần - Giày', 650, false, 2000);
                    }
                    load_data_suit();
                }
            });
        });

    });

</script>
@endsection