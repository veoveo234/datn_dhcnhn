$(document).ready(function() {
    let blog = {
        id : null,
        status : null
    };
    let dataBlogs = $('#datatables').DataTable({
        dom: 'rtp',
        processing: true,
        serverSide: true,
        responsive: true,
        searching: true,
        bPaginate: true,
        // "bStateSave": true,
        autofill: true,
        "order": [
            [0, "ASC"]
        ],
        ajax: {
            type: "GET",
            url: page.index_page,
            data: (params) => {

            }
        },
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"]
        ],
        "oLanguage": {
            "sLengthMenu": "Hiển thị _MENU_ danh mục",
            "sZeroRecords": "Không tìm thấy danh mục nào",
            "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ danh mục",
            // "sInfoEmpty": "Showing 0 to 0 of 0 records",
            // "sInfoFiltered": "(filtered from _MAX_ total records)"
        },
        columns: [
            {
                data: 'id',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'title', render: function (data, type, row) {
                    if(row.title.length > 100){
                        return row.title.substring(0, 100) + '...' ;
                    }
                    return row.title;
                }
            },
            {
                data: 'description', render: function (data, type, row) {
                    if(row.description.length > 100){
                        return row.description.substring(0, 100) + '...' ;
                    }
                    return row.description;
                }
            },
            {
                data: 'views', name: 'views'
            },
            {data: 'status', render: function (data, type, row) {
                    if(row.status === 1) {
                        return 'Đang hoạt động';
                    }
                    return 'Dừng hoạt động';
                }
            },
            {
                data: '', render: function (data, type, row) {
                    return row.created_at;
                }
            },
            {
                data: '',
                render: function(data, type, row) {
                    return `<button type="button" class="btn btn-warning edit-cate" data-url="${row.id}" data-toggle="modal" data-target="#updateBrand"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-danger delete-cate" data-toggle="modal" data-target="#destroyBrand" data-url="${row.id}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>`;
                }
            }
        ]
    });

    //insert
    function insertblog(form)
    {
        $.ajax({
            type: "POST",
            url: page.insert_url,
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.code === 200) {
                    notification('center', 'success', response.message, 500, false, 1500);
                    $('#addRowModal').modal('hide');
                    dataBlogs.ajax.reload(null, false);
                } else {
                    notification('center', 'warning', response.message, 500, false, 1500);
                }
            },
            error : function (response) {
                if ('status' in response && response.status === 422) {
                    showError(response.responseJSON.errors, '#create-blog');
                }
            }
        });
    }

    function showError(data = {}, workspace) {
        $('html,body').find('.border-error').removeClass('border-error');
        $('.notify-error').find('.error-text').remove().end();
        if (Object.keys(data).length > 0) {
            $.each(data, function (index, value) {
                $(workspace).find(`input[name="${index}"]`).addClass('border-error');
                $(workspace).find(`select[name="${index}"]`).addClass('border-error');
                $(workspace).find(`textarea[name="${index}"]`).addClass('border-error');
                $(workspace).find(`.error_${index}`).append(`
                     <div class="error-text">${value[0]}</div>
                `);
            });
        }
    }

    $(document).on('click', '.create-blog', function () {
        $('#create-blog')[0].reset();
        CKEDITOR.instances["ckeditor"].setData('');
    });

    $(document).on('click', '#insert', function(){
        const form = new FormData($('#create-blog')[0]);
        let content_blog = CKEDITOR.instances["ckeditor"].getData();
        form.append('content_blog', content_blog);
        insertblog(form);
    });

    $(document).on('show.bs.modal', '#addRowModal', function (e) {
        showError({}, '#create-blog');
    });

    //delete
    $(document).on('click', '.delete-cate', function () {
        let id = $(this).data('url');
        if(id !== "" && id > 0 && id !== String){
            blog.id = id;
        }
    });

    $(document).on('click', '.confirm',function (){
        $.ajax({
            type: "DELETE",
            url: page.delete_url + blog.id,
            data: {
              id : blog.id
            },
            cache:false,
            success: function(response) {
                if (response.code === 200) {
                    notification('center', 'success', response.message, 500, false, 1500);
                    dataBlogs.ajax.reload(null, false);
                }
            }
        });
    });

    //edit
    $(document).on('click', '.edit-cate', function (){
        let id = $(this).data('url');
        if(id !== "" && Number(id)){
            $.ajax({
                type: "GET",
                url: page.edit_url + id,
                data: { id : id },
                dataType: "json",
                success: function(response) {
                    $('#load-edit').html(response.data);
                    blog.id = id;
                }
            });
        }
    });

    function updateblog(form)
    {
        $.ajax({
            type: "POST",
            url: page.edit_url + blog.id,
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.code === 200) {
                    notification('center', 'success', response.message, 500, false, 1500);
                    $('#updateBrand').modal('hide');
                    dataBlogs.ajax.reload(null, false);
                } else {
                    notification('center', 'warning', response.message, 500, false, 1500);
                }
            },
            error : function (response) {
                if ('status' in response && response.status === 422) {
                    showError(response.responseJSON.errors, '#update-cate-blog');
                }
            }
        });
    }

    $(document).on('click', '.update-cate', function (e){
        e.preventDefault();
        const form = new FormData($('#update-cate-blog')[0]);
        $('<input>').attr({
            type: 'hidden',
            name: 'id',
            value: blog.id
        }).appendTo('form#update-cate-blog');
        updateblog(form);
    });

    //search
    $(document).on('click', '.search-store', function(){
        let name_cate = $('#name-cate').val();
        $('#datatables').DataTable().search(name_cate).draw();
    });

    $(document).on('change', '#status-active', function(){
        blog.status = $(this).val();
        dataBlogs.ajax.reload(null, false);
    });
});

