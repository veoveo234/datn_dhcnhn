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
                        Blog
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="create-blog">
                            <div class="form-group">
                                <label for="title" class="my-input">Tiêu đề</label>
                                <input type="text" id="title" name="title" class="form-control">
                                <div class="error_title notify-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="cate-id" class="my-input">Danh mục</label>
                                <select name="cate_id" id="cate-id" class="form-control">
                                    <option value="">- Lựa chọn -</option>
                                    @foreach($cateBlog as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name_cate }}</option>
                                    @endforeach
                                </select>
                                <div class="error_cate_id notify-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="main-image" class="my-input">Ảnh blog</label>
                                <input type="file" class="form-control" id="main-image" name="image" accept="image/*">
                                <div class="error_image notify-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="my-input">Mô tả blog</label>
                                <textarea id="description" name="description" class="form-control" style="height: 100px"></textarea>
                                <div class="error_description notify-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="ckeditor" class="my-input">Nội dung blog</label>
                                <textarea name="content_blog" class="form-control ckeditor" id="ckeditor"></textarea>
                                <div class="error_content_blog notify-error"></div>
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
