@if(isset($dataComment) && !empty($dataComment))
    <div class="comments-area">
        <div class="comment_list">
            {{-- @if(isset($dataComment) &&!empty($dataComment)) --}}
                @foreach ($dataComment as $value)
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    @if(($value->member_id) == null)
                                        <img src="https://www.gravatar.com/avatar/{{ md5($value->email) }}.jpg?s=64" style="width: 60px; height: 60px" alt="">
                                    @else
                                        <img src="{{ asset('storage/images/avatar/'.$value->avatar) }}" style="width: 60px; height: 60px" alt="">
                                    @endif
                                </div>
                                <div class="desc">
                                    @if(($value->member_id) == null)
                                        <h5>
                                            <a>{{ $value->name }}</a>
                                        </h5>
                                    @else
                                        <h5>
                                            <a>{{ $value->member_name }}</a>
                                        </h5>
                                    @endif
                                    <p class="date">{{ $value->updated_at }}</p>
                                    <p class="comment">
                                        @php echo $value->comment; @endphp
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                @if(session()->has('member_id'))
                                    @if(session('member_id') == 1)
                                        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample{{ $value->id }}" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-reply"></i></button>
                                        <button type="button" class="btn btn-warning edit-cmt" data="{{ $value->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger delete-cmt" data="{{ $value->id }}" data-toggle="modal" data-target="#deleteComment"><i class="fas fa-trash-alt"></i></button>
                                    @else
                                        @if(session('member_id') == $value->member_id)
                                            <button type="button" class="btn btn-warning edit-cmt" data="{{ $value->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger delete-cmt" data="{{ $value->id }}" data-toggle="modal" data-target="#deleteComment"><i class="fas fa-trash-alt"></i></button>
                                        @endif
                                    @endif
                                @else
                                    <button type="button" class="btn btn-danger commentNoAccount" data="{{ $value->id }}" data-toggle="modal" data-target="#commentNoAccount"><i class="fas fa-trash-alt"></i></button>
                                @endif
                            </div>
                        </div>
                        <div class="collapse mt-4" id="collapseExample{{ $value->id }}">
                            @if(session()->has('member_id'))
                                <div class="card card-body">
                                    <textarea name="comment" id="editor{{ $value->id }}" class="form-control" cols="30" rows="10"></textarea>
                                    <div>
                                        <button type="button" class="btn btn-primary mt-3 reply-account" data="{{ $value->id }}">Submit</button>
                                    </div>
                                </div>
                            @else
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label>Họ tên</label>
                                        <input type="text" name="name" id="name{{ $value->id }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email{{ $value->id }}" class="form-control">
                                    </div>
                                    <textarea name="comment" id="editor{{ $value->id }}" class="form-control" cols="30" rows="10"></textarea>
                                    <div>
                                        <button type="button" class="btn btn-primary mt-3 reply-comment" data="{{ $value->id }}">Submit</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <script>
                            CKEDITOR.replace('editor{{ $value->id }}');
                        </script>
                    </div>

                    {{-- reply comment --}}
                    @foreach ($value->replies as $rep)
                        <div class="comment-list left-padding">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        @if(($rep->member_id) == null)
                                            <img src="https://www.gravatar.com/avatar/{{ md5($rep->email) }}.jpg?s=64" style="width: 60px; height: 60px" alt="">
                                        @else
                                            <img src="{{ asset('storage/images/avatar/'.$rep->member->avatar) }}" style="width: 60px; height: 60px" alt="">
                                        @endif
                                    </div>
                                    <div class="desc">
                                        <h5>
                                            <a>{{ $rep->member->name }}</a>
                                        </h5>
                                        <p class="date">{{ $rep->updated_at }}</p>
                                        <p class="comment">
                                            @php echo $rep->reply_comment; @endphp
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                    @if(session()->has('member_id'))
                                        @if(session('member_id') == 1)
                                            <button type="button" class="btn btn-warning edit-reply" data="{{ $rep->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger delete-reply" data="{{ $rep->id }}" data-toggle="modal" data-target="#deleteComment"><i class="fas fa-trash-alt"></i></button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            {{-- @endif --}}
            <nav aria-label="Page navigation example" id="paginate">
                <ul class="pagination">
                    <li class="page-item">
                        {!! $dataComment->links() !!}
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px">
            <div class="modal-content" id="load-edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa bình luận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="comment" id="editorEdit" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary updateComment" data-dismiss="modal">Lưu bình luận</button>
                </div>
                <script>
                    CKEDITOR.replace('editorEdit');
                </script>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="load-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Bạn có chắc chắn muốn xóa bình luận này không ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger deleteComment" data-dismiss="modal">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="commentNoAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="load-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Bạn có chắc chắn muốn xóa bình luận này không ?</h4>
                    <input type="email" class="form-control" id="accuracyEmail" name="accuracyEmail" placeholder="Nhập Email để xác thực">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger deleteComment" data-dismiss="modal">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    

@endif