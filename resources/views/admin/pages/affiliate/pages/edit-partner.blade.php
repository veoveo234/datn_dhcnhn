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
                    <div class="form-group mb-4">
                        <img src="{{ asset('storage/images/affiliate/'.$data[0]['avatar']) }}" alt="" style="width: 100%; height: 350px;">
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="my-input">Firstname</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $data[0]['firstname'] }}">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="my-input">Lastname</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $data[0]['lastname'] }}">
                    </div>
                </div>
                <div class="col-md-8">
                    <h2 class="text-center font-weight-bold">Thông tin đối tác</h2>
                    <div class="form-group">
                        <label for="email" class="my-input">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $data[0]['email'] }}">
                    </div>
                    <div class="form-group">
                        <label for="profession" class="my-input">Nghề nghiệp</label>
                        <input type="text" id="profession" name="profession" class="form-control" value="{{ $data[0]['profession'] }}">
                    </div>
                    <div class="form-group">
                        <label for="address" class="my-input">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ $data[0]['address'] }}">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="my-input">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ $data[0]['phone'] }}">
                    </div>
                    <div class="form-group">
                        <label for="total_rose" class="my-input">Tổng tiền hoa hồng</label>
                        <input type="text" id="total_rose" name="total_rose" class="form-control" value="{{ number_format($data[0]['total_rose'], 0, '', ',') }}">
                    </div>
                    <div class="form-group">
                        <h5 class="my-input">Trạng thái: <label class="ml-2 text-warning">@if(($data[0]['status']) == 1) Chờ phê duyệt @elseif(($data[0]['status']) == 2) Đang hoạt động @elseif(($data[0]['status']) == 3) Đang khóa @endif</label></h5>
                    </div>
                    <div class="form-group">
                        <h5 class="my-input">Được tạo lúc: <label class="ml-2 text-success">{{ $data[0]['created_at'] }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5 class="my-input">Cập nhật lúc: <label class="ml-2 text-success">{{ $data[0]['updated_at'] }}</label></h5>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    @if(($data[0]['status']) == 1)
        <button type="button" class="btn btn-primary approve-partner" data-url="{{ $data[0]['id'] }}" data-dismiss="modal">Phê duyệt</button>
    @elseif(($data[0]['status']) == 2)
        <button type="button" class="btn btn-danger lockup-partner" data-url="{{ $data[0]['id'] }}" data-dismiss="modal">Khóa tài khoản</button>
    @elseif(($data[0]['status']) == 3)
        <button type="button" class="btn btn-warning unlockup-partner" data-url="{{ $data[0]['id'] }}" data-dismiss="modal">Mở khóa</button>
    @endif
</div>
