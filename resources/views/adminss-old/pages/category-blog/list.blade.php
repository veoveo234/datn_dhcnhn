<table class="table" style="text-align: center">
    <thead>
    <tr>
        <th>#</th>
        <th>Tên danh mục blog</th>
        <th>Trạng thái</th>
        <th>Thời gian tạo</th>
        <th colspan="2">Lựa chọn</th>
    </tr>
    </thead>
    <tbody>
    @if(count($categories) > 0)
        @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $category->name_cate }}</td>
                <td>
                    @if($category->status == 1)
                        Hoạt động
                    @else
                        Ngưng hoạt động
                    @endif
                </td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <button class="btn ml-2 mr-2 btn-edit-category-blog" type="button"
                            data-url="{{ route('category-blog.edit', $category->id) }}"><i
                            class="fas fa-edit text-warning"></i></button>
                </td>
                <td>
                    <button class="btn btn-delete" data-url="{{ route('category-blog.delete', $category->id) }}"
                            type="button"><i
                            class="fas fa-trash-alt text-danger"></i></button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">Không có danh mục nào</td>
        </tr>
    @endif
    </tbody>
</table>
<div style="position: absolute; left :47px; top : 450px">
    {{ $categories->links() }}
</div>



