@extends('index')
@section('content')
<div class="container-fluid">
    <div class="row" style="display: flex; justify-content: center; align-items: center; height: 180px; background-color: rgb(1, 127, 255);">
        <div class="col-md-4" style="display: flex; justify-content: flex-end;">
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
        <div class="col-md-4"></div>
        <div class="col-md-4" style="display: flex; justify-content: flex-start; align-items: center;">
            <div class="dropdown-partner">
                <button class="dropbtn-partner"><i class="far fa-user" aria-hidden="true"></i></button>
                <div class="droppartner-content">
                    <a href="{{ route('affiliate.program') }}">Home</a>
                    <a href="#">Thông tin tài khoản</a>
                    <a href="{{ route('affiliate.manage') }}">Quản lý chương trình</a>
                    <a href="#">Quản lý doanh thu</a>
                    <a href="#">Đổi mã</a>
                    <a href="#">Thoát tài khoản</a>
                </div>
                <div style="color: #fff;">16.000.000VND</div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin: 50px auto;">
    <div class="row">
        <div class="col-md-12">
            <h3>Thông tin các chương trình bạn đăng kí</h3>
        </div>
    </div>
    <div id="load-content">
        <div class="content">
            @if(!empty($data))
                @foreach ($data as $value)
                    <div class="row card-affiliate">
                        <div class="col-md-4 col-sm-4 left-cotent-img">
                            <a href="#">
                                <img src="{{ asset('storage/images/affiliate/'. $value->image) }}" class="img-card" alt="">
                            </a>
                        </div>
                        <div class="col-md-8 col-sm-8 right-content-text" style="width: 65%; height: 330px;">
                            <div class="card-text-content" style="width: 75%; color: rgb(117, 117, 117); height: 75%; display: flex; flex-direction: column; justify-content: center; padding-left: 20px">
                                <input type="hidden" class="program_id" value="">
                                <input type="hidden" class="affiliate_id" value="">
                                <h5 style="font-size: 1.75rem; letter-spacing: 1.5px; line-height: 1.25;">{{ $value->title }}</h5>
                                <h6 style="color: red;">Hoa hồng {{ $value->rose_old }} % - {{ $value->rose_new }} %</h6>
                                @if(($value->gender_product) == 1)
                                    <h6 style="font-size: 1.5em;"><a href="{{ route('men.show', $value->product_id) }}" target="_blank">Sản phẩm: {{ $value->name }}</a></h6>
                                @elseif (($value->gender_product) == 2)
                                    <h6 style="font-size: 1.5em;"><a href="{{ route('women.show', $value->product_id) }}" target="_blank">Sản phẩm: {{ $value->name }}</a></h6>
                                @endif
                                <span style="font-size: 1em;">Có hiệu lực từ: {{ $value->created_at }}</span>
                            </div>
                            <div style="width: 25%; text-align: center">
                                <button type="button" class="btn btn-outline-success view-qrcode" data-toggle="modal" data-target="#programModalCenter" style="width: 100px; height: 50px;" data-url="{{ $value->id }}">Link code</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="programModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>

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

    $(document).ready(function(){
        $(document).on('click', '.view-qrcode', function(e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != '' && id > 0){
                $.ajax({
                    type: "POST",
                    url: "{{ route('view.linkqr') }}",
                    data: { id: id },
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        $('#load-detail').html(data);
                    }
                });
            }
        });
    });
</script>
@endsection