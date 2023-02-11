<div class="modal-header">
    <h4 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Thông tin chương trình</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-5">
                        <img src="{{ asset('storage/images/affiliate/'.$data[0]->image) }}" alt="" style="width: 100%; height: 350px;">
                    </div>
                    <div class="form-group">
                        <h5>Tên danh mục: <label class="ml-2 text-success">{{ $data[0]->name_cate }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Tên sản phẩm: <label class="ml-2 text-success">{{ $data[0]->name }}</label></h5>
                    </div>
                </div>
                <div class="col-md-8">
                    <h5 class="text-center font-weight-bold mb-3">Thông tin chương trình</h5>
                    <div class="form-group">
                        <h5>Tiêu đề: <label class="ml-2 text-success">{{ $data[0]->title }}</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Khách hàng cũ: <label class="ml-2 text-success">{{ $data[0]->rose_old }} %</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Khách hàng mới: <label class="ml-2 text-success">{{ $data[0]->rose_new }} %</label></h5>
                    </div>
                    <div class="form-group">
                        <h5>Mô tả: </h5>
                        <label class="ml-2">@php echo $data[0]->description; @endphp</label>
                    </div>
                    <div class="form-group">
                        <h5>Có hiệu lực từ: <label class="ml-2 text-success">{{ $data[0]->created_at }}</label></h5>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="register-program" program-id="{{ $data[0]->id }}" data-dismiss="modal">Đăng ký ngay</button>
</div>


<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $(document).on('click', '#register-program', function(e){
        $('#register-program').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('program-id');
            if(id != "" && id > 0){
                $.ajax({
                    type: "POST",
                    url: "{{ route('program.register') }}",
                    data: { id: id },
                    cache: false,
                    success: function(data) {
                        // $('#load-content').load(' .content');
                        if(data == 'success'){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Bạn đã đăng ký chương trình thành công !',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }else if(data == 'error'){
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Bạn đã đăng ký chương trình này rồi !',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    }
                });
            }else{
                
            }
        });
    });
    
 </script>