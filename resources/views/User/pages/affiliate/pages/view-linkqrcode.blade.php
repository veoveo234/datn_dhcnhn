<div class="modal-header">
    <h4 class="modal-title text-uppercase font-weight-bold" id="exampleModalCenterTitle">Thông tin mã code</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h3 style="color: red">Link code</h3>
                    <div class="d-flex">
                        <input id="myInput" type="text" value="{{ $data[0]->link_code }}" style="border: none; font-size: 30px; width: 100%; outline: none" readonly>
                        <button onclick="copyClipboard()" type="button" class="btn btn-info btn-lg ml-3"><i class="fa fa-link" aria-hidden="true"></i> Copy</button>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h3 style="width: 100%; text-align: left; color: red">Mã Qrcode</h3>
                    <div>
                        {{-- <img src="data:image/png;base64, {!! base64_encode($qrcode) !!}"> --}}
                    </div>
                </div>
                <div>
                    {{-- <button class="btn btn-warning" type="button"><a href="data:image/png;base64, {!! base64_encode($qrcode) !!}" download style="color: #fff"><i class="fas fa-download"></i> Tải xuống mã QR code </a></button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    
</div>


<script>
    function copyClipboard() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    }
 </script>