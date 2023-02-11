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
    <div class="row justify-content-between mb-25">
        <div class="col-4 d-flex align-items-center p-0">
            <h3 class="text-dark font-weight-700 mr-5">Mã khuyến mại</h3>
        </div>
        <div class="col-4 d-flex  justify-content-end">
            <a href="{{ route('discount.add') }}" class="" style="width: 60px;">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="row bg-white">
        <div class="col-md-12">
            <div class="row bg-white m-0 pb-3">
                <div class="col-md-3 mb-0 mt-25">
                    <label class="my-input" for="type-asset">Tiêu đề</label>
                    <input name="tile-search" id="tile-search" class='form-control code'  type="text" placeholder="Tên chương trình" >
                </div>
                <div class="col-md-3 mb-0 mt-25">
                    <label class="my-input" for="code">Loại mã</label>
                    <select name="type-code-search" class="form-control" id="type-code-search">
                        <option hidden disabled selected>-- Loại mã code --</option>
                        <option value="Mã giảm giá % theo sản phẩm">Mã giảm giá % theo sản phẩm</option>
                        <option value="Mã giảm giá tiền">Mã giảm giá tiền</option>
                        <option value="Mã miễn phí vận chuyển">Mã miễn phí vận chuyển</option>
                    </select>
                </div>
                <div class="col-md-3 mb-0 mt-25">
                    <label class="my-input">Trạng thái</label>
                    <select name="status-program" id="status-program" class="form-control">
                        <option value="">-- Trạng thái mã code --</option>
                        <option value="Đang hoạt động">Đang hoạt động</option>
                        <option value="Dừng hoạt động">Dừng hoạt động</option>
                    </select>
                </div>
                <div class="col-md-1 mb-0 mt-25" style="margin-top: 55px !important;">
                    <button class="search" id="btnSearch" name="search" style="background:#2D9CDB; border: 1px;height: 35px;width: 35px;border-radius: 3px;" type="button"><i style="color: #ffff;width: 25px;" class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 p-0">
            <div class="table-responsive">
                <table id="code-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Loại mã</th>
                            <th>Giảm</th>
                            <th>Thời gian sử dụng</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit -->
<div class="modal fade" id="updateProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px !important;display: flex;align-items: center;" role="document">
        <div class="modal-content" >
            <div class="modal-header bg-info">
                <h4 class="modal-title text-dark font-weight-700"> Chỉnh sửa mã khuyến mại</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 p-0 ">
                    <div class="row bg-white">
                        <div class="col-md-4 mb-0 mt-25">
                            <label class="my-input" for="code">Mã CODE</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="code" aria-describedby="basic-addon2" readonly>
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
                                <label class="my-input" for="title">Tiêu để</label>
                                <input type="text" id="title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row bg-white">
                        <div class="col-md-4 mb-0 mt-25">
                            <div class="form-group">
                                <label class="my-input" for="type-code">Loại code</label>
                                <input name="type-code" class="form-control" id="type-code" readonly></input>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng'</button>
                <button type="button" id="btn-updata" class="btn btn-primary update-discount">Cập nhập</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal approval -->
<div class="modal fade" id="updateProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content" id="load-detail">

        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý chương trình</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6 class="font-weight-bold">Bạn có chắc chắn muốn xóa chương trình này không ?</h6>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Có</button>
        </div>
        </div>
    </div>
</div>
@endsection

@section('library-js')

@endsection
@section('after-js')
<script>
    $(document).ready(function () {
        //* dataTables
        var dataCode = $('#code-datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            // "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('discount.index') }}',
                type : 'GET',
                data: function() {
                   
                }
            },
            // "targets": 0,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ chương trình",
                "sZeroRecords": "Không tìm thấy chương trình nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ chương trình",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'type_code', name: 'type_code'},
                {
                    data: 'price', render: function (data, type, row) {
                        if(row['type'] == 1){
                            return data+' %';
                        }else{
                            return data.toLocaleString()+' VND';
                        }
                    }
                },
                {
                    data: 'time', render: function (data, type, row) {
                        return data+' ngày';
                    }
                },
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-program" data-url='+ row.id +' data-toggle="modal" data-target="#updateProgram"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger delete-program" data-toggle="modal" data-target="#destroyProgram" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                },
                
            ]
        });

        // * Search
        $(document).on('click','#btnSearch', function(){
            var valFilter = $('#tile-search').val();
            $('#code-datatables').DataTable().search(valFilter).draw();
        });

        $('#type-code-search,#status-program').on('change', function(){
            var valFilter = $('select[name="type-code-search"]').val() +" "+$('select[name="status-program"]').val();
            $('#code-datatables').DataTable().search(valFilter).draw();
        });

        //* edit program
        var dataId = [];
        $(document).on('click', '.edit-program', function(){
            var id = $(this).attr('data-url');
            if(id != "" && Number(id)){
                dataId.push(id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('show.code') }}",
                    data: { id: id },
                    dataType: "json",
                    success: function (data) {
                        var arr = Object.keys(data).map(key => data[key]);
                        var dataEditDiscount = [];
                        dataEditDiscount.push(arr[0][0]);

                        $('#code').val(dataEditDiscount[0]['code']);
                        $('#category').val(dataEditDiscount[0]['category_id']);
                        $('#title').val(dataEditDiscount[0]['title']);
                        $('#used-time').val(dataEditDiscount[0]['time']);
                        $('#quantity').val(dataEditDiscount[0]['quantity']);
                        
                        var option = '';
                        if(dataEditDiscount[0]['type_code'] != null){
                            if(dataEditDiscount[0]['type_code'] == 1){
                                $('#type-code').val('Mã giảm giá % theo sản phẩm');
                                option += '<label class="my-input">Phần trăm giảm giá</label>\
                                            <input type="text" id="percent"  name="price percent" value="'+dataEditDiscount[0]['price']+' %" onKeyup="loadCheckPercent()" data-type="percent" data-val="Phần trăm giảm giá" class="form-control price">';
                            }else if(dataEditDiscount[0]['type_code'] == 2){
                                $('#type-code').val('Mã giảm giá tiền');
                                option += '<label class="my-input">Giảm giá tiền</label>\
                                            <input type="text" id="price"  name="price" data-type="currency" value="'+formatDollar(Number(dataEditDiscount[0]['price']))+' VNĐ" onKeyup="loadInput()" data-value="Giảm giá tiền" class="form-control price">';
                            }else if(dataEditDiscount[0]['type_code'] == 3){
                                $('#type-code').val('Mã miễn phí vận chuyển');
                                option += '<label class="my-input">Miễn phí vận chuyển</label>\
                                            <input type="text" id="price"  name="price"  data-type="currency" value="'+formatDollar(Number(dataEditDiscount[0]['price']))+' VNĐ"  onKeyup="loadInput()" data-value="Miễn phí vận chuyển" class="form-control price">';
                            }
                            $('#load-type-code').html(option);
                        }
                        
                    }
                });
            }
        });
        $(document).on('click', '#btn-updata', function(){
            var id = dataId.slice(-1)[0];
            var category_id = $('#category').val();
            var title = $('#title').val();
            var quantity = $('#quantity').val();
            var time = $('#used-time').val();
            var typeCode =$('#type-code').val();
            if(typeCode == 'Mã giảm giá % theo sản phẩm'){
                var priceValue = $(".price").val();
                var price = priceValue.replaceAll('%',"");
            }else{
                var priceValue = $(".price").val();
                var price1 = priceValue.replaceAll(',',"");
                var price = price1.replaceAll('VNĐ',"");
            }
            console.log(category_id);
            
            if(id != "" && Number(id) && title != "" && quantity != "" && time != "" && category_id != "" && price != "")
            {
                $.ajax({
                    url: "{{ route('update.code') }}",
                    type: "POST",
                    data:{id: id, title: title, quantity: quantity, time:time,category_id: category_id,price: price},
                    success:function(data){
                        if(data=='error'){
                            notification('center', 'info','Tiêu đề mã khuyến đã tồn tại !',500, false, 1500);
                        }else{
                            notification('center', 'success','Cập nhập mã khuyến mại thành công !',500, false, 1500);
                            location.reload();
                        }
                    }
                });
                
            }else{
               notification('center', 'error','Bạn chưa nhập đủ thông tin !',500, false, 1500);
            }

        });

        //* delete program
        var arrProgram = [];
        $(document).on('click', '.delete-program', function (){
            var id = $(this).attr('data-url');
            console.log(id);
            if(id != "" && Number(id)){
                arrProgram.push(id);
            }
        });
        $(document).on('click', '.confirm', function (){
            var id = arrProgram.slice(-1)[0];
            console.log(id);
            $.ajax({
                type: "POST",
                data: { id: id },
                url: "{{ route('discount.delete') }}",
                success: function(data) {
                    notification('center', 'success', 'Chương trình xóa thành công !',500, false, 1500)
                    dataCode.ajax.reload(null, false);
                }
            });
        });
    });
</script>
@endsection
