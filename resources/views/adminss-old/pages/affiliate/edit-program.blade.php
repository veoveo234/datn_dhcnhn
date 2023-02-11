<div class="modal-header">
    <h3 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Quản lý chương trình</h3>
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
                        <img src="{{ asset('storage/images/affiliate/'.$data[0]->image) }}" alt="" style="width: 100%; height: 350px;">
                        <input type="file" id="img" name="img" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="category">Tên danh mục</label>
                        <input type="text" id="category" name="category" class="form-control" value="{{ $data[0]->name_cate }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $data[0]->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <h2 class="text-center font-weight-bold">Thông tin chương trình</h2>
                    <div class="form-group">
                        <label for="title-program">Tiêu đề</label>
                        <input type="text" id="title-program" name="title-program" class="form-control" value="{{ $data[0]->title }}">
                    </div>
                    <div class="form-group">
                        <label for="rose_old">Khách hàng cũ</label>
                        <input type="text" id="rose_old" name="rose_old" class="form-control" value="{{ $data[0]->rose_old }} %" readonly>
                    </div>
                    <div class="form-group">
                        <label for="rose_new">Khách hàng mới</label>
                        <input type="text" id="rose_new" name="rose_new" class="form-control" value="{{ $data[0]->rose_new }} %" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editor1">Mô tả</label>
                        <textarea name="description" class="form-control" id="editor1">{{ $data[0]->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
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
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary update-program" data-url="{{ $data[0]->id }}" data-dismiss="modal">Cập nhật</button>
</div>


<script>
    CKEDITOR.replace('editor1');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var dataProgram = $('#program-datatables').DataTable();

        $(document).on('click', '.update-program', function(e){
            e.preventDefault();
            var form_data = new FormData();
            var id = $(this).attr('data-url');
            var file = $('#img')[0].files[0];
            var title = $('#title-program').val();
            var description = CKEDITOR.instances.editor1.getData();
            var status = $('#status').val();
            var validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            // console.log(fileType);
            if(id != "" && title != "" && description != "" || status == 1 || status == 2){
                if(file != undefined){
                    var fileType = file['type'];
                    if (validImageTypes.includes(fileType)) {
                        form_data.append('id', id);
                        form_data.append('title', title);
                        form_data.append('file', file);
                        form_data.append('status', status);
                        form_data.append('description', description);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('program.update') }}",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function() {
                                dataProgram.ajax.reload(null, false);
                            }
                        });
                    }else{
                        
                    }
                }else{
                    $.ajax({
                        type: "POST",
                        url: "{{ route('program.update') }}",
                        data: { id: id, title: title, description: description, status: status },
                        success: function() {
                            dataProgram.ajax.reload(null, false);
                        }
                    });
                }
                swal({
                    title: "Chương trình đã được cập nhật!",
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
            }else{
                
            }
        });
    });
    
 </script>