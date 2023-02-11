<form id="update-cate-blog">
    <div class="form-group">
        <label for="update-name-brand" class="my-input">Tên danh mục</label>
        <input type="text" id="update-name-brand" name="name_cate" class="form-control" value="{{ $cateBlogs->name_cate ?? null }}">
        <div class="error_name_cate notify-error"></div>
    </div>
    <div class="form-group d-flex flex-column">
        <label for="images" class="my-input">Ảnh danh mục</label>
        <img src="{{ asset('storage/images/cate_blogs/' . $cateBlogs->image ?? null) }}" alt="" style="width: 300px">
    </div>
    <div class="form-group">
        <label for="update-images" class="my-input">Thay ảnh mới</label>
        <input type="file" class="form-control" id="update-images" name="image" accept="image/*">
        <div class="error_image notify-error"></div>
    </div>
    <div class="form-group">
        <label for="status" class="my-input">Trạng thái</label>
        <select name="status" id="status" class="form-control">
            @foreach(STATUS_ACTIVE as $key => $status)
                @if($cateBlogs->status == $key)
                    <option value="{{ $key }}" selected>{{ $status }}</option>
                @else
                    <option value="{{ $key }}">{{ $status }}</option>
                @endif
            @endforeach
        </select>
    </div>
</form>
