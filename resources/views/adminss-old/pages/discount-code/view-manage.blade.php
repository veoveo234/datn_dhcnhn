@extends('admin-index')
@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10 offset-1">
            <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#addRowModal">
                <i class="fa fa-plus"></i> Thêm mới mã code
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 mt-3 ml-3 mb-3 text-center" style="padding: 0; line-height: 2">
        </div>
        <div class="col-md-2 m-3">
            <label></label>
            <div id="date_range" class="border border-primary text-center" style="cursor: pointer; width: 100%; height: 50px; line-height: 50px;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
            <input type="hidden" id="start_date" value="" />
            <input type="hidden" id="end_date" value="" />
        </div>
        <div class="col-md-2 m-3 d-flex flex-column justify-content-end">
            <label></label>
            <select name="status-program" id="status-program" class="border border-primary text-center" style="width: 100%; height: 50px; line-height: 50px;">
                <option value="">-- Trạng thái mã code --</option>
                <option value="Đang hoạt động">Đang hoạt động</option>
                <option value="Dừng hoạt động">Dừng hoạt động</option>
            </select>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Thêm mới</span>
                        <span class="text-uppercase font-weight-bold text-info">
                            mã code
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
                                <label for="category">Danh mục</label>
                                <select name="category" id="category" class="form-control selectpicker" data-live-search="true">
                                    <option value="0" >-- Chọn danh mục --</option>
                                    @foreach ($category as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name_cate'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Tiêu để</label>
                                <input type="text" id="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã code</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="code" aria-describedby="basic-addon2" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="code-random" type="button">Lấy mã</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Loại code</label>
                                <select name="type-code" class="form-control" id="type-code">
                                    <option hidden disabled selected></option>
                                    <option value="1">Mã giảm giá % theo sản phẩm</option>
                                    <option value="2">Mã giảm giá tiền</option>
                                    <option value="3">Mã miễn phí vận chuyển</option>
                                </select>
                            </div>
                            <div class="form-group" id="load-type-code">
                                
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" type="number" name="quantity" id="quantity">
                            </div>
                            <div class="form-group">
                                <label>Thời gian sử dụng</label>
                                <select name="used-time" class="form-control" id="used-time">
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
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="insert" class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                            <th>Xem chi tiết</th>
                            <th>Cập nhật</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
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
        <div class="modal-header">
            <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý chương trình</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4 class="font-weight-bold">Bạn có chắc chắn muốn xóa chương trình này không ?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Có</button>
        </div>
        </div>
    </div>
</div>

@endsection

@section('script-ajax')
<script>
    $(document).ready(function () {
        //* Date ranger picker
        var start = moment().subtract(29, 'days');
        var end = moment().subtract(-1, 'days');

        function callbackDateRange(start, end) {
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));

            $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#date_range').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, callbackDateRange);

        callbackDateRange(start, end);

        var dataCode = $('#code-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('discount.index') }}',
                type : 'GET',
                data: function(param) {
                    param.start_date = $('#start_date').val();
                    param.end_date = $('#end_date').val();
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
                        if(data.length <= 3){
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
                        return '<button type="button" class="btn btn-primary show-product" data-url='+ row.id +' data-toggle="modal" data-target="#show-product"><i class="fas fa-eye"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-program" data-url='+ row.id +' data-toggle="modal" data-target="#updateProgram"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger delete-program" data-toggle="modal" data-target="#destroyProgram" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
                    }
                }
            ]
        });
        
        $('#date_range').on('apply.daterangepicker', function(event, picker) {
            dataCode.ajax.reload(null, false);
        });

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-program').on('change', function(){
            var valFilter = $("#status-program").val();
            $('#program-datatables').DataTable().search(valFilter).draw();   
        });

        //* insert program
        var arr = [], dataProduct = [];
        // $(document).on('change', '#category', function (){
        //     var id = $(this).val();
        //     if(id != "" && id != 0 && Number(id)){
        //         $.ajax({
        //             type: "GET",
        //             url: "{{ route('select-product') }}",
        //             data: { id : id },
        //             dataType: "json",
        //             success: function(data) {
        //                 var arr = Object.keys(data).map(key => data[key]);
        //                 dataProduct.push(arr[0]);
        //                 var option = '';
        //                 for(let i = 0; i < dataProduct.length; i++){
        //                     option += '<option value="0">-- Chọn sản phẩm --</option>';
        //                     $.each(dataProduct[i], function(key, val){
        //                         option += '<option value="' + val['id'] + '">' + val['name'] + '</option>';
        //                     });
        //                     $('select[name="product"]').html(option);
        //                 }
        //             }
        //         });
        //     }
        // });

        // Get code
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
        
        var arrCode = [];
        $(document).on('click', '#code-random', function(e){
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
                    option += '<label>Phần trăm giảm giá</label>\
                                <input type="number" id="percent" name="percent" class="form-control">';
                }else if(id == 2){
                    option += '<label>Giảm giá tiền</label>\
                                <input type="number" id="price" name="price" class="form-control">';
                }else if(id == 3){
                    option += '<label>Miễn phí vận chuyển</label>\
                                <input type="number" id="price" name="price" class="form-control">';
                }
                arrTypeCode.push(id)
                $('#load-type-code').html(option);
            }
        });

        $(document).on('click', '#insert', function(e){
            e.preventDefault();
            var category_id = $('select[name="category"]').val();
            var product_id = $('select[name="product"]').val();
            var title = $('#title').val();
            var quantity = $('#quantity').val();
            var time = $('select[name="used-time"]').val();
            var code = arrCode.slice(-1)[0];
            var typeCode = arrTypeCode.slice(-1)[0];
            var check = 0;
            if(typeCode == 1){
                check = 1;
                var price = $('#percent').val();
            }else{
                check = 2;
                var price = $('#price').val();
            }
            if(category_id != "" && title != "" && quantity != "" && time != "" && price != "" && check == 1 || check == 2){
                $.ajax({
                    type: "POST",
                    url: "{{ route('insert-code') }}",
                    data: { category_id: category_id, product_id: product_id, title: title, quantity: quantity, time: time, code: code, typeCode: typeCode, price: price, check: check },
                    success: function(data) {
                        // if(data == 0){
                            swal({
                                title: "Đăng ký chương trình thành công!",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: "Close",
                                        value: true,
                                        visible: true,
                                        className: "btn btn-success",
                                        closeModal: true
                                    }
                                },
                                timer: 1000
                            });
                        // }
                        dataCode.ajax.reload(null, false);
                    }
                });
            }
        });

        //* delete program
        var arrProgram = [];
        $(document).on('click', '.delete-program', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrProgram.push(id);
            }
        });

        $(document).on('click', '.confirm', function (e){
            e.preventDefault();
            var id = arrProgram.slice(-1)[0];
            $.ajax({
                type: "GET",
                data: { id: id },
                url: "{{ route('program.delete') }}",
                cache: false,
                success: function() {
                    swal({
                        title: "Chương trình đã bị xóa!",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Close",
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                                closeModal: true
                            }
                        },
                        timer: 1000
                    });
                    dataCode.ajax.reload(null, false);
                }
            });
        });

        //* edit program
        $(document).on('click', '.edit-program', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: "{{ route('program.edit') }}",
                data: { id : id },
                dataType: "html",
                success: function(data) {
                    $('#load-detail').html(data);
                }
            });
        });
        
    });
</script>
@endsection