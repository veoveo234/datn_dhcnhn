<table class="table" style="text-align: center">
    <thead>
    <tr>
        <th>#</th>
        <th>Danh mục blog</th>
        <th>Tên người viết</th>
        <th>Tiêu đề</th>
        <th>Ảnh</th>
        <th>Lượt xem</th>
        <th>Trạng thái</th>
        <th colspan="2">Lựa chọn</th>
    </tr>
    </thead>
    <tbody>
    @if(count($blogs) > 0)
        @foreach ($blogs as $blog)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $blog->categoryBlog->name_cate }}</td>
                <td>{{ $blog->user->name }}</td>
                <td>{{ $blog->title }}</td>
                <td><img src="{{ asset('admin-assets/uploads/blog/' . $blog->main_image) }}" alt="" width="50px"
                         height="50px"></td>
                <td>{{ $blog->views }}</td>
                <td>{{ $blog->status }}</td>
                <td>
                    <button class="btn ml-2 mr-2" type="button"><a
                            href="{{ route('blog.show', $blog->id) }}"><i
                                class="fas fa-edit text-warning"></i></a></button>
                </td>
                <td>
                    <button class="btn btn-delete btn-blog-delete" data-url="{{ route('blog.delete', $blog->id) }}"
                            type="button"><i
                            class="fas fa-trash-alt text-danger"></i></button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="9">Không có blog mục nào</td>
        </tr>
    @endif
    </tbody>
</table>
<div style="position: absolute; left :47px; top : 450px">
    {{ $blogs->links() }}
</div>
