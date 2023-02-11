@extends('index')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tổng doanh số bán hàng theo tháng</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="multipleLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-5 m-3">
            <label></label>
            <div id="date_range" class="border border-primary text-center" style="cursor: pointer; width: 100%; height: 50px; line-height: 50px;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
            <input type="hidden" id="start_date" value="" />
            <input type="hidden" id="end_date" value="" />
        </div>
        {{-- <div class="col-md-4 m-3 d-flex flex-column justify-content-end">
            <label></label>
            <select name="status-program" id="status-program" class="form-control border border-primary text-center" style="width: 100%; height: 50px; line-height: 50px;">
                <option value="">-- Trạng thái sản phẩm --</option>
                <option value="Sản phẩm mới">Sản phẩm mới</option>
                <option value="Đang bán">Đang bán</option>
                <option value="Bán chạy nhất">Bán chạy nhất</option>
                <option value="Giảm giá sốc">Giảm giá sốc</option>
                <option value="Đã hết hàng">Đã hết hàng</option>
            </select>
        </div> --}}
    </div>

            <!-- Table -->
    <div class="row mt-4">
        <div class="col-md-12 mb-5 p-0">
            <div class="table-responsive">
                <table id="product-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên chương trình</th>
                            <th>Tên sản phẩm</th>
                            <th>Hoa hồng (%)</th>
                            <th>Tổng tiền hoa hồng nhận được</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('admin-assets-old/js/plugin/chart.js/chart.min.js') }}"></script>
{{-- Date Range Picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
    var myMultipleLineChart = new Chart(multipleLineChart, {
        type: 'line',
        data: {
            labels: {!! $arrMonth !!} ,
            datasets: [{
                label: "Tổng",
                borderColor: "#1d7af3",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1d7af3",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: {!! $arrTotal !!} 
            }]
        },
        options : {
            responsive: true, 
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10,
                callbacks: {
                    label: function(tooltipItem, data) {
                        return Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                        }) + " VND";
                    }
                }
            },
            layout:{
                padding:{left:15,right:15,top:15,bottom:15}
            }
        }
    });

    var start = moment().subtract(29, 'days');
    var end = moment().subtract(-1, 'days');

    function callbackDateRange(start, end) {
        $('#start_date').val(start.format('YYYY-MM-DD'));
        $('#end_date').val(end.format('YYYY-MM-DD'));

        $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#date_range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, callbackDateRange);

    callbackDateRange(start, end);

    var dataProduct = $('#product-datatables').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        searching: true,
        bPaginate: true,
        "bStateSave": true,
        "order": [[ 0, "DESC" ]],
        ajax: {
            url  : '{{ route('detail.data') }}',
            type : 'GET',
            data: function(param) {
                param.start_date = $('#start_date').val();
                param.end_date = $('#end_date').val();
            }
        },
        // "targets": 0,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        "oLanguage": {
            "sLengthMenu": "Hiển thị _MENU_ đơn hàng",
            "sZeroRecords": "Không tìm thấy đơn hàng nào",
            "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ đơn hàng",
            // "sInfoEmpty": "Showing 0 to 0 of 0 records",
            // "sInfoFiltered": "(filtered from _MAX_ total records)"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'name', name: 'name'},
            {
                data: 'rose', render: function (data, type, row) {
                    return data+' %';
                }
            },
            {
                data: 'total_rose', render: function (data, type, row) {
                    return data.toLocaleString()+' VND';
                }
            }
        ]
    });

    $('#date_range').on('apply.daterangepicker', function(event, picker) {
        dataProduct.ajax.reload(null, false);
    });

    $('input[type=search]').focus(function() {
        $(this).select();
    });


</script>