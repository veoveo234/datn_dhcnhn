<!-- Modal add new -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm mới</span>
                    <span class="text-uppercase font-weight-bold text-info">
                        Danh mục Blog
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="create-cate-blog">
                            <div class="form-group">
                                <label for="name-cate" class="my-input">Tên Danh mục</label>
                                <input type="text" id="name-cate" name="name_cate" class="form-control">
                                <div class="error_name_cate notify-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="my-input">Ảnh danh mục</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <div class="error_image notify-error"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <button type="button" id="insert" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </div>
</div>
