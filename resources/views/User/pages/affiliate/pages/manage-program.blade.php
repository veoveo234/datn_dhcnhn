@php
    function substr_word($str, $limit){
        if (stripos($str, " ")) {
            $ex_str = explode(" ", $str);
            $str_s = "";
            if (count($ex_str) > $limit) {
                for ($i = 0; $i < $limit; $i++) {
                    $str_s .= $ex_str[$i] . " ";
                }
                return $str_s . " ...";
            } else {
                return $str;
            }
        } else {
            return $str;
        }
    }
@endphp
<div class="container p-4" style="border: 1px solid rgba(0, 0, 0, .125);">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Thông tin các chương trình bạn đăng kí</h3>
        </div>
    </div>
    {{-- <div id="load-content">
        <div class="content"> --}}
            @if(!empty($data))
                @foreach ($data as $value)
                    <div class="card flex-md-row box-shadow mb-4" style="background: repeating-linear-gradient( #c4c4c4, #c4c4c4 8px, transparent 0, transparent 28px, #c4c4c4 0, #c4c4c4 42px) 0/1px 100% no-repeat, radial-gradient( circle at 0 18px, transparent, transparent 10px, #c4c4c4 0, #c4c4c4 11px, currentColor 0) 1px 0/100% 42px repeat-y; background-clip: padding-box; height: 300px; color: #eee; border: 1px solid #c4c4c4; border-left: none !important; border-radius: 2px;">
                        <div class="card-body d-flex flex-column align-items-start justify-content-between pl-5" style="border-right: 2px solid #c4c4c4; border-style: dashed; border-left: none; ">
                            <h5 style="font-size: 1.75rem; letter-spacing: 1.5px; line-height: 1.25;">@php echo substr_word($value->title, 10); @endphp</h5>
                            <h6 style="color: red;">Hoa hồng {{ $value->rose_old }} % - {{ $value->rose_new }} %</h6>
                            @if(($value->gender_product) == 1)
                                <h6 style="font-size: 1.5em;"><a href="{{ route('men.show', $value->product_id) }}" target="_blank">Sản phẩm: {{ $value->name }}</a></h6>
                            @elseif (($value->gender_product) == 2)
                                <h6 style="font-size: 1.5em;"><a href="{{ route('women.show', $value->product_id) }}" target="_blank">Sản phẩm: {{ $value->name }}</a></h6>
                            @endif
                            <span style="font-size: 1em; color: rgb(117, 117, 117);">Có hiệu lực từ: {{ $value->created_at }}</span>
                            <button type="button" class="btn btn-outline-success view-qrcode" data-toggle="modal" data-target="#programModalCenter" style="width: 100px; height: 50px;" data-url="{{ $value->id }}">Link code</button>
                        </div>
                        <img class="card-img-right flex-auto d-none d-md-block p-4" src="{{ asset('storage/images/affiliate/'. $value->image) }}" style="width: 250px; border-radius: 40px">
                    </div>
                @endforeach
            @endif
        {{-- </div>
    </div> --}}
</div>

<!-- Modal -->
<div class="modal fade" id="programModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>
