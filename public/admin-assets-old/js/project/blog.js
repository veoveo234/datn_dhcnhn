$(document).ready(function () {

        function getListBlogs() {
            let url = $('.data-url').attr('data-url');
            callAjax(url, 'GET')
                .then(function (data) {
                    $('.list-blogs').html(data);
                });
        }

        getListBlogs();

        $(document).on('click', ".pagination li a", function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                success: function (data) {
                    $('.list-category-blogs').html(data);
                }
            });
        });

        function fillDataEdit(data, url) {
            $('#name_cate_edit').val(data.data.name_cate);
            $('#form-edit-category-blog').attr('action', url);
            $('#btn-update-cate-blog').attr('data-url', url);
        }

// create category

        $(document).on('click', '#new-cate-blog', function () {
            $('#name_cate').val('');
            $('.error-message').html('');
        })

        $(document).on('click', '#btn-add-blog', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            let formData = new FormData($('#form-add-blog')[0]);
            let description = CKEDITOR.instances["description"].getData();
            let content_blog = CKEDITOR.instances["content_blog"].getData();
            formData.append("description", description);
            formData.append("content_blog", content_blog);
            callAjax(url, 'POST', formData)
                .then(function (data) {
                    getListBlogs();
                    $('#add-blog').modal('hide');
                    notifySuccess(data.message);
                })
                .catch(function (error) {
                    let errors = error.responseJSON.errors;
                    let firstErrorKey = Object.keys(errors)[0];
                    $('.error-message').html(errors.name_cate);
                    $('#form-add-cate-blog input[name="' + firstErrorKey + '"]').focus();
                });
        });


// delete category
        $(document).on('click', '.btn-blog-delete', actionDelete);

        function actionDelete(event) {
            event.preventDefault()
            let url = $(this).attr('data-url');
            confirmDelete('Bạn có muốn xóa không?')
                .then((willDelete) => {
                    if (willDelete) {
                        callAjax(url, 'delete')
                            .then(function (data) {
                                notifySuccess(data.message);
                                getListBlogs();
                            })
                            .catch(function () {
                                notifyFailed('Xóa blog thất bại');
                            });
                    }
                });
        }

        $('#main_image').change(function (e) {
            e.preventDefault();
            $('#images').attr({
                'width': '450',
                'height': '450'
            });
            let reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("images").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    }
);

