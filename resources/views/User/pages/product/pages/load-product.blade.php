@php
function substr_word($str, $limit){
    if (stripos($str, ' ')) {
        $ex_str = explode(' ', $str);
        $str_s = '';
        if (count($ex_str) > $limit) {
            for ($i = 0; $i < $limit; $i++) {
                $str_s .= $ex_str[$i] . ' ';
            }
            return $str_s . ' ...';
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}
@endphp
<div class="row">
    @if (!empty($data))
        @foreach ($data as $value)
            <div class="col-md-6 col-lg-4" title="{{ $value->name }}">
                <div class="card text-center card-product">
                    <div class="card-product__img">
                        @if($gender == 1)
                            <a href="{{ route('men.show', $value->id) }}" class="update-view" data-url="{{ route('men.update', $value->id) }}" style="width: 100%; position: relative;">
                        @elseif($gender == 2)
                            <a href="{{ route('women.show', $value->id) }}" class="update-view" data-url="{{ route('women.update', $value->id) }}" style="width: 100%; position: relative;">
                        @endif
                                <img class="card-img" src="{{ asset('storage/images/product/'.$value->main_image) }}" alt="">
                            </a>
                            @if(($value->status) == 1)
                                @if(($value->sale) != 0)
                                    <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Giảm giá {{ $value->sale }}%</p>
                                @else
                                    <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Mới</p>
                                @endif
                            @elseif(($value->status) == 3)
                                @if(($value->sale) != 0)
                                    <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Giảm giá {{ $value->sale }}%</p>
                                @else
                                    <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Bán chạy</p>
                                @endif
                            @elseif(($value->status) == 4)
                                @if(($value->sale) != 0)
                                    <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Giảm giá {{ $value->sale }}%</p>
                                @endif
                            @elseif(($value->status) == 5)
                                <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Hết hàng</p>
                            @else
                            @endif
                        <ul class="card-product__imgOverlay">
                            <li>
                                @if($gender == 1)
                                    <button type="button" class="modal-product" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('men.edit', $value->id) }}"><i class="ti-search"></i></button>
                                @elseif($gender == 2)
                                    <button type="button" class="modal-product" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('women.edit', $value->id) }}"><i class="ti-search"></i></button>
                                @endif
                            </li>
                            <li>
                                <button><i class="ti-shopping-cart"></i></button>
                            </li>
                            <li>
                                <button><i class="ti-heart"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @if($gender == 1)
                            <a href="{{ route('men.show', $value->id) }}" class="update-view" data-url="{{ route('men.update', $value->id) }}">
                        @elseif($gender == 2)
                            <a href="{{ route('women.show', $value->id) }}" class="update-view" data-url="{{ route('women.update', $value->id) }}">
                        @endif
                                <h4 class="card-product__title">{{ substr_word($value->name, 6) }}</h4>
                            </a>
                        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                            @if(($value->sale) != 0)
                            <del><p class="card-product__price" style="font-size: 14px">{{ number_format($value->price, 0, '', '.') }} VND</p></del>
                            @endif
                            <p class="card-product__price">@php $total = ($value->price) * ((100 - ($value->sale)) / 100) @endphp  {{ number_format($total, 0, '', '.') }} VND</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<nav aria-label="Page navigation example" id="paginate">
    <ul class="pagination">
        <li class="page-item">
            {{ $data->links() }}
        </li>
    </ul>
</nav>