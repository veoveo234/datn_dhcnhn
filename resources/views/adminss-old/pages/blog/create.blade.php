<div class="modal fade" id="add-blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Thêm mới</span>
                    <span class="text-uppercase font-weight-bold">Blog</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form-add-blog" action="{{ route('blog.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="cate_id">Danh mục</label>
                                <select name="cate_id" id="cate_id" class="form-control">
                                    @foreach ($categoryBlogs as $cate)
                                        <option value="{{ $cate['id'] }}">{{ $cate['name_cate'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Tiêu đề blog</label>
                                <input type="text" class="form-control" id="title" placeholder="Nhập tiêu đề blog ..."
                                       name="title">
                            </div>
                            <div class="form-group">
                                <label for="main_image">Ảnh blog</label>
                                <input type="file" class="form-control" id="main_image" name="main_image"
                                       accept="image/*">
                            </div>
                            <div class="form-group">
                                <img id="images" style="margin: 10px; border-radius:10px; box-shadow: 3px 3px 7px grey"
                                     alt=""
                                     src=""/>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả blog</label>
                                <textarea name="description" class="form-control ckeditor"
                                          id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content_blog">Nội dung blog</label>
                                <textarea name="content_blog" class="form-control ckeditor"
                                          id="content_blog"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="btn-add-blog" data-url="{{ route('blog.store') }}"
                            class="btn btn-primary">Thêm mới
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>
