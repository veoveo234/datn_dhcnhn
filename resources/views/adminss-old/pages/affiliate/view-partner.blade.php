@extends('admin-index')
@section('content')

<div class="container-fluid mt-3">
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
            <select name="status-partner" id="status-partner" class="border border-primary text-center" style="width: 100%; height: 50px; line-height: 50px;">
                <option value="">-- Trạng thái đối tác --</option>
                <option value="Chờ phê duyệt">Chờ phê duyệt</option>
                <option value="Đang hoạt động">Đang hoạt động</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="partner-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh đại diện</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Phê duyệt</th>
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
<div class="modal fade" id="updatePartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>

<!-- Modal destroy -->
<div class="modal fade" id="destroyPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý đối tác</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4 class="font-weight-bold">Bạn có chắc chắn muốn xóa đối tác này không ?</h4>
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
        // Date ranger picker
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

        var dataPartner = $('#partner-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            "bStateSave": true,
            "order": [[ 0, "asc" ]],
            ajax: {
                url  : '{{ route('partner.index') }}',
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
                "sLengthMenu": "Hiển thị _MENU_ đối tác",
                "sZeroRecords": "Không tìm thấy đối tác nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ đối tác",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {data: 'id', name: 'id'},
                {
                    data: 'avatar', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/affiliate') }}/'+row.avatar+'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return ''+row.firstname+' '+row.lastname+'';
                    }
                },
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'status', name: 'status'},
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-partner" data-url='+ row.id +' data-toggle="modal" data-target="#updatePartner"><i class="fas fa-edit"></i></button>';
                    }
                },
                {
                    data: '', render: function (data, type, row) {
                        return '<button type="button" class="btn btn-danger delete-partner" data-toggle="modal" data-target="#destroyPartner" data-url='+ row.id +'><i class="fas fa-times-circle"></i></button>';
                    }
                }
            ]
        });

        // data.on( 'order.dt search.dt', function () {
        //     data.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //         cell.innerHTML = i+1;
        //     } );
        // } ).draw();
        
        $('#date_range').on('apply.daterangepicker', function(event, picker) {
            dataPartner.ajax.reload(null, false);
        });

        $('input[type=search]').focus(function() {
            $(this).select();
        });

        $('#status-partner').on('change', function(){
            var valFilter = $("#status-partner").val();
            $('#partner-datatables').DataTable().search(valFilter).draw();   
        });

        //* delete rose
        $(document).on('click', '.delete-partner', function (e){
            var id = $(this).attr('data-url');
            $('.confirm').click(function(){
                $.ajax({
                    type: "GET",
                    data: { id: id },
                    url: "{{ route('partner.delete') }}",
                    success: function() {
                        dataPartner.ajax.reload(null, false);
                    }
                });
            });
        });

        // //* Edit record
        $(document).on('click', '.edit-partner', function (e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: "{{ route('partner.edit') }}",
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