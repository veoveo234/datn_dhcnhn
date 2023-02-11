@extends('index')
@section('content')
<div style="margin-bottom: 240px">
    <div style="width: 100%; margin: 0 auto; background-color: rgb(1, 127, 255); position: fixed; top: 0; z-index: 999;">
        <div class="container">
            <div class="row" style="display: flex; justify-content: space-between; align-items: center; height: 180px;">
                <div class="col-md-4 col-sm-4">
                    <div class="clock">
                        <div class="hour">
                            <div class="hr" id="hr"></div>
                        </div>
                        <div class="min">
                            <div class="mn" id="mn"></div>
                        </div>
                        <div class="sec">
                            <div class="sc" id="sc"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4" style="display: flex; justify-content: center">
                    <div class="dropdown-partner">
                        <button class="dropbtn-partner"><i class="far fa-user" aria-hidden="true"></i></button>
                        <div class="droppartner-content">
                            <a href="{{ route('affiliate.index') }}">Home</a>
                            <a href="{{ route('affiliate.profile') }}">Thông tin tài khoản</a>
                            <a href="{{ route('partner.logout') }}">Thoát tài khoản</a>
                        </div>
                        <div style="color: #fff; text-align: center;">{{ number_format($total_money[0]['total_rose'], 0, '', '.') }} VND</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('content-affiliate')


@endsection
@section('ajax')
<script>
    const deg = 6;
    const hr = document.querySelector('#hr');
    const mn = document.querySelector('#mn');
    const sc = document.querySelector('#sc');

    setInterval(() => {
        let day = new Date();
        let hh = day.getHours() * 30;
        let mm = day.getMinutes() * deg;
        let ss = day.getSeconds() * deg;

        hr.style.transform = `rotateZ(${(hh)+(mm/12)}deg)`;
        mn.style.transform = `rotateZ(${(mm)}deg)`;
        sc.style.transform = `rotateZ(${(ss)}deg)`;
    })
</script>
@endsection