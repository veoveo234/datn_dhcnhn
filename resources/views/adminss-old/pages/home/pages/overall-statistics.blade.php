<div class="card-body">
    <div class="card-title">Thống kê tổng thể tháng này</div>
    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
        <div class="px-2 pb-2 pb-md-0 text-center">
            <div id="circles-1"></div>
            <h6 class="fw-bold mt-3 mb-0">New Users</h6>
        </div>
        <div class="px-2 pb-2 pb-md-0 text-center">
            <div id="circles-2"></div>
            <h6 class="fw-bold mt-3 mb-0">Orders</h6>
        </div>
        <div class="px-2 pb-2 pb-md-0 text-center">
            <div id="circles-3"></div>
            <h6 class="fw-bold mt-3 mb-0">New User Afiliate</h6>
        </div>
    </div>
</div>


<script>
    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: {{ $dataMember[0]->total }},
        maxValue: 1000,
        width: 7,
        text: {{ $dataMember[0]->total }},
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: {{ $dataOrder[0]->total }},
        maxValue: 10000,
        width: 7,
        text: {{ $dataOrder[0]->total }},
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: {{ $dataPartner[0]->total }},
        maxValue: 1000,
        width: 7,
        text: {{ $dataPartner[0]->total }},
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })
</script>