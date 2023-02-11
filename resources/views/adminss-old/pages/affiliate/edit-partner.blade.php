<div class="modal-header">
    <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý đối tác</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <img src="{{ asset('storage/images/affiliate/'.$data[0]->avatar) }}" alt="" style="width: 100%; height: 350px;">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $data[0]->firstname }}">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $data[0]->lastname }}">
                    </div>
                </div>
                <div class="col-md-8">
                    <h2 class="text-center font-weight-bold">Thông tin đối tác</h2>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $data[0]->email }}">
                    </div>
                    <div class="form-group">
                        <label for="profession">Nghề nghiệp</label>
                        <input type="text" id="profession" name="profession" class="form-control" value="{{ $data[0]->profession }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ $data[0]->address }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ $data[0]->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="text" id="password" name="password" class="form-control" value="{{ $data[0]->password }}">
                    </div>
                    <div class="form-group">
                        <label for="total_rose">Tổng tiền hoa hồng</label>
                        <input type="text" id="total_rose" name="total_rose" class="form-control" value="{{ $data[0]->total_rose }}">
                    </div>
                    <div class="form-group">
                        <h5>Trạng thái: <label class="ml-2 text-warning">@if(($data[0]->status) == 1) Chờ phê duyệt @elseif(($data[0]->status) == 2) Đang hoạt động @elseif(($data[0]->status) == 3) Đang khóa @endif</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Được tạo lúc: <label class="ml-2 text-success">{{ $data[0]->created_at }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Cập nhật lúc: <label class="ml-2 text-success">{{ $data[0]->updated_at }}</label></h5>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary approve-partner" data-url="{{ $data[0]->id }}" data-dismiss="modal">Phê duyệt</button>
    <button type="button" class="btn btn-danger lockup-partner" data-url="{{ $data[0]->id }}" data-dismiss="modal">Dừng hoạt động</button>
</div>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var dataPartner = $('#partner-datatables').DataTable();

        $('.approve-partner').click(function(){
            var id = $(this).attr('data-url');
            if(id != ""){
                $.ajax({
                    type: "POST",
                    url: "{{ route('partner.approve') }}",
                    data: { id: id },
                    success: function() {
                        dataPartner.ajax.reload(null, false);
                    }
                });
            }
        });

        $('.lockup-partner').click(function(){
            var id = $(this).attr('data-url');
            if(id != ""){
                $.ajax({
                    type: "POST",
                    url: "{{ route('partner.lockup') }}",
                    data: { id: id },
                    success: function() {
                        dataPartner.ajax.reload(null, false);
                    }
                });
            }
        });
    });
    
 </script>