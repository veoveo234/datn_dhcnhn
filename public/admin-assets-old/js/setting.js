function callAjax(url, method, data) {
    return $.ajax({
        type: method,
        url: url,
        data: data,
        processData: false,
        contentType: false,
    });
}

function callApi(url, method, data = {}) {
    return $.ajax({
        data: data,
        url: url,
        method: method,
        contentType: false,
        cache: false,
        processData: false,
    })
}

// debounce
function debounce(func, wait) {
    let timeout;
    return function () {
        let context = this,
            args = arguments;
        let executeFunction = function () {
            func.apply(context, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(executeFunction, wait);
    };
}

function confirmDelete($content) {
    return swal({
        title: "Cảnh báo!",
        text: $content,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
}

function notifySuccess($content)
{
    swal("Thông báo!", $content, "success");
}

function notifyFailed($content)
{
    swal("Thông báo!", $content, "error");
}

