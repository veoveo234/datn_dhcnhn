@if(isset($data) && !empty($data))
    @if(count($data) < 5)
        @foreach($data as $value)
        <div class="col-md-3 col-sm-3" style="border-right: 2px solid #000; border-bottom: 2px solid #000;">
            <img src="{{ asset('storage/images/product/'.$value['main_image']) }}" alt="" style="width: 100%; height: 300px;">
        </div>
        @endforeach
    @else
        @foreach($data as $value)
        <div class="col" style="border-right: 2px solid #000; border-bottom: 2px solid #000;">
            <img src="{{ asset('storage/images/product/'.$value['main_image']) }}" alt="" style="width: 100%; height: 300px;">
        </div>
        @endforeach
    @endif

@else
    <div class="col" style="border-right: 2px solid #000; border-bottom: 2px solid #000;">
        <img src="https://bom.to/bQ4tQ3DOGyBxL" alt="" style="width: 100%">
    </div>
    <div class="col" style="border-right: 2px solid #000; border-bottom: 2px solid #000;">
        <img src="https://bom.to/hndv61ImJIstP" alt="" style="width: 100%">
    </div>
    <div class="col" style="border-right: 2px solid #000; border-bottom: 2px solid #000;">
        <img src="https://bom.to/5fzB4CzmS8CeE" alt="" style="width: 100%">
    </div>
    <div class="col" style="border-right: 2px solid #000; border-bottom: 2px solid #000;">
        <img src="https://bom.to/uHB4lZZemJ1PZ" alt="" style="width: 100%">
    </div>
    <div class="col" style="border-bottom: 2px solid #000;">
        <img src="https://bom.to/wT6VM5aH1h5sB" alt="" style="width: 100%;">
    </div>
@endif

