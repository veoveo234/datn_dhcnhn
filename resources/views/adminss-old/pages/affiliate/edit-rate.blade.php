<div class="modal-header">
    <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý tỉ lệ hoa hồng</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center font-weight-bold">Thông tin tỉ lệ hoa hồng</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <h5>Tên danh mục: <label class="ml-2 text-success">{{ $data[0]->name_cate }}</label></h5>
                    </div>
                    <div class="form-group">
                        <label for="rose_old">Khách hàng cũ</label>
                        <input type="number" id="rose_old" name="rose_old" class="form-control" value="{{ $data[0]->rose_old }}">
                    </div>
                    <div class="form-group">
                        <label for="rose_new">Khách hàng mới</label>
                        <input type="number" id="rose_new" name="rose_new" class="form-control" value="{{ $data[0]->rose_new }}">
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="1" @if(($data[0]->status) == 1) selected @endif>Đang hoạt động</option>
                            <option value="2" @if(($data[0]->status) == 2) selected @endif>Dừng hoạt động</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h5>Được tạo lúc: <label class="ml-2 text-success">{{ $data[0]->created_at }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Cập nhật lúc: <label class="ml-2 text-success">{{ $data[0]->updated_at }}</label></h5>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary update-rose" data-url="{{ $data[0]->id }}" data-dismiss="modal">Cập nhật</button>
</div>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var dataRose = $('#rose-datatables').DataTable();

        $('.update-rose').click(function(){
            var id = $(this).attr('data-url');
            var rose_old = $('#rose_old').val();
            var rose_new = $('#rose_new').val();
            var status = $('#status').val();
            $.ajax({
                type: "POST",
                url: "{{ route('rose.update') }}",
                data: { id: id, rose_old: rose_old, rose_new: rose_new, status:status },
                success: function() {
                    swal({
                        title: "Cập nhật tỉ lệ hoa hồng thành công!",
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
                    dataRose.ajax.reload(null, false);
                }
            });
        });
    });
    
 </script>