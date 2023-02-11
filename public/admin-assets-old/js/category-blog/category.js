$(document).ready(function () {

        function getListCategories() {
            let url = $('.data').attr('data-url');
            callAjax(url, 'GET')
                .then(function (data) {
                    $('.list-category-blogs').html(data);
                });
        }
        getListCategories();

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

        $(document).on('click', '#btn-add-cate-blog', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            let formData = new FormData($('#form-add-cate-blog')[0]);
            callAjax(url, 'POST', formData)
                .then(function (data) {
                    getListCategories();
                    $('#modal-add-cate-blog').modal('hide');
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
        $(document).on('click', '.btn-delete', actionDelete);

        function actionDelete(event) {
            event.preventDefault()
            let url = $(this).attr('data-url');
            confirmDelete('Bạn có muốn xóa không?')
                .then((willDelete) => {
                    if (willDelete) {
                        callAjax(url, 'delete')
                            .then(function (data) {
                                notifySuccess(data.message);
                                getListCategories();
                            })
                            .catch(function () {
                                notifyFailed('Xóa blog thất bại');
                            });
                    }
                });
        }

//update category
        $(document).on('click', '.btn-edit-category-blog', function () {
            $('#modal-update-cate-blog').modal('show');
            $('#form-edit-category-blog')[0].reset();
            $('.error-message').html('');
            let url = $(this).attr('data-url');
            callAjax(url, 'GET')
                .then(function (data) {
                    fillDataEdit(data, url);
                })
        });

        $(document).on('click', '#btn-update-cate-blog', function (e) {
            e.preventDefault();
            let url = $(this).attr('data-url');
            let formData = new FormData($('#form-edit-category-blog')[0]);
            callAjax(url, 'POST', formData)
                .then(function (data) {
                    getListCategories();
                    $('#modal-update-cate-blog').modal('hide');
                    notifySuccess(data.message);
                })
                .catch(function (error) {
                    let errors = error.responseJSON.errors;
                    let firstErrorKey = Object.keys(errors)[0];
                    $('.error-message').html(errors.name_cate);
                    $('#form-edit-category-blog input[name="' + firstErrorKey + '"]').focus();
                });
        });
// end update
    }
);

