@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')
    <link href="{{ asset('admin_assets/vendors/morris.js/morris.css') }}" rel="stylesheet" />
@endsection

@section('script')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $totalOrder ?? '0' }}</h2>
                    <div class="m-b-5">ĐƠN HÀNG MỚI</div><i class="ti-shopping-cart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>chi tiết</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $totalProductSell ?? '0' }}</h2>
                    <div class="m-b-5">SẢN PHẨM BÁN RA (trong 30 ngày)</div><i class="ti-bar-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>chi tiết</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{  number_format($totalSales, 0, '', ',') ?? 0 }}đ</h2>
                    <div class="m-b-5">DOANH THU (trong 30 ngày)</div><i class="fa fa-money widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>chi tiết</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $totalUserNew ?? '0' }}</h2>
                    <div class="m-b-5">NGƯỜI DÙNG MỚI</div><i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-down m-r-5"></i><small>chi tiết</small></div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Số lượng cộng tác viên tham gia bán hàng trong 7 ngày qua</div>
                    </div>
                    <div class="ibox-body">
                        <div id="flot_bar_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Số lượng người dùng đăng ký trong 10 ngày gần nhất</div>
                    </div>
                    <div class="ibox-body">
                        <div id="flot_area_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Area Chart example</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_area_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Doanh số bán hàng trong 10 ngày gần nhất</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_line_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Bar Chart example</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_bar_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Donut Chart example</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_donut_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Line Chart example</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_line_chart_2" style="height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
    </style>
@endsection
@section('library-js')
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('admin_assets/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('admin_assets/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.time.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/flot.tooltip/js/jquery.flot.tooltip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.categories.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.stack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/Flot/jquery.flot.selection.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/flot-orderBars/js/jquery.flot.orderBars.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('admin_assets/vendors/morris.js/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/vendors/raphael/raphael.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/js/scripts/charts_morris_demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/js/scripts/charts_flot_demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/js/statistical.js') }}" type="text/javascript"></script>
    <script>
        let data = {
            statisticalUser : {{ $statistical_user }},
            statisticalAffiliatePartner : {{ $statisticalAffiliatePartner }},
            statisticalOrder : []
        }
        let statisticalOrder = {{ $statisticalOrder }};
        $.each(statisticalOrder, function(key, value) {
            data.statisticalOrder.push({ day: value[0], price: value[1] });
        });

    </script>
@endsection
@section('after-js')

@endsection
