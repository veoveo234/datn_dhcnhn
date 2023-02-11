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
    <div class="col-md-12">
        <div class="row mb-25">
            <div class="col-md-4 p-0 d-flex align-items-center">
                <h3 class="text-dark font-weight-700">Quản lý khách hàng</h3>
            </div>
            <div class="col-md-8 p-0 d-flex justify-content-end">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row d-flex align-items-center bg-white m-0">
                <div class="col-md-3 mt-25 mb-25">
                    <label class="my-input" for="name-member">Tìm kiếm khách hàng</label>
                    <input class="form-control" type="text" name="name-member" id="name-member" placeholder="Tên danh mục">
                </div>
                <div class="col-md-3 mt-25 mb-25 custom-search">
                    <div class="input-group">
                        <button class="btn btn-info search-member" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="col-md-2 mt-25 mb-25 custom-search justify-content-end">
                    <div class="input-group" style="width: 60px">
                        <button class="btn btn-warning refresh-data" style="width: 60px; height: 38px;" type="button"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Table -->
    <div class="row mt-4">
        <div class="col-md-12 mb-5 p-0">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Avatar</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Point</th>
                            <th>Ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal delete member -->
<div class="modal fade" id="delete-member" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-700" id="exampleModalCenterTitle">Thông tin khách hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc chắn muốn xóa khách hàng này không ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Xóa</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('library-js')

@endsection
@section('after-js')
<script>
    $(document).ready(function() {
        var dataMember = $('#datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            // "bStateSave": true,
            autofill: true,
            "order": [
                [0, "ASC"]
            ],
            ajax: {
                url: '{{ route('member.index') }}',
                type: 'GET',
                data: function(param) {
                }
            },
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ khách hàng",
                "sZeroRecords": "Không tìm thấy khách hàng nào",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",
                // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                // "sInfoFiltered": "(filtered from _MAX_ total records)"
            },
            columns: [
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'avatar', render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images/avatar') }}/'+ data +'" alt="" style="width:100px; height: 100px;">';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address'},
                {data: 'email', name: 'email'},
                {data: 'point', name: 'point'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: '',
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-warning edit-member" data-url='+ row.id +' data-toggle="modal" data-target="#edit-member"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>\
                        <button type="button" class="btn btn-danger destroy-member" data-toggle="modal" data-target="#delete-member" data-url='+ row.id +'><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                }
            ]
        });

        $(document).on('click', '.search-member', function(){
            var filter = $('#name-member').val();
            $('#datatables').DataTable().search(filter).draw();
        });

        $(document).on('click', '.edit-member', function(){
            var id = $(this).attr('data-url');
            if(id != "" && id > 0){
                window.open("member-edit/"+id);
            }
        });

        $(document).on('click', '.refresh-data', function(){
            dataMember.ajax.reload(null, false);
        });

        //* delete member
        var arrMember = [];
        $(document).on('click', '.destroy-member', function(e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != "" && id > 0 && id != String){
                arrMember.push(id);
            }
        });
        $(document).on('click', '.confirm', function(e){
            e.preventDefault();
            var id = arrMember.slice(-1)[0];
            $.ajax({
                type: "GET",
                url: "{{ route('member.destroy') }}",
                data: { id: id },
                cache: false,
                success: function() {
                    notification('center', 'success', 'Xóa khách hàng thành công!', 500, false, 1500);
                    dataMember.ajax.reload(null, false);
                }
            });
        });

    });
</script>
@endsection
