@extends('index')
@section('content')
<section style="background: #ececec url('{{ asset('images/affiliate/bg-bot.92224b5f.png') }}') no-repeat 100% 100%/90% auto; width: 100%; height: 100vh;">
    <div class="container col-affiliate">
        <div class="row">
            <div class="col-md-5 ctent-affiliate">
                <a href="{{ route('fashion.mix', 1) }}" class="btn btn-info">THỜI TRANG NAM</Table></a>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 ctent-affiliate">
                <a href="{{ route('fashion.mix', 2) }}" class="btn btn-pink">THỜI TRANG NỮ</a>
            </div>
        </div>
    </div>
</section>
@endsection