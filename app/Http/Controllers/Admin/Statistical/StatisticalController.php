<?php

namespace App\Http\Controllers\Admin\Statistical;

use App\Http\Controllers\Controller;
use App\Services\StatisticalService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    protected $statisticalService;

    public function __construct(
        StatisticalService $statisticalService
    )
    {
        $this->statisticalService = $statisticalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application
     */
    public function index(Request $request)
    {
        $totalUserNew = $this->statisticalService->getStatisticalUserNew();
        $totalProductSell = $this->statisticalService->getStatisticalTotalProductSell();
        $totalOrder = $this->statisticalService->getStatisticalTotalOrder();
        $totalSales = $this->statisticalService->getStatisticalTotalSales();
        $statisticalOrder = $this->statisticalService->getStatisticalOrder();
        $statisticalUser = $this->statisticalService->getStatisticalUser();
        $statisticalAffiliatePartner = $this->statisticalService->getStatisticalAffiliatePartner();
        return view('admin.pages.statistical.index')->with(
            [
                'statistical_user' => json_encode($statisticalUser, true),
                'statisticalAffiliatePartner' => json_encode($statisticalAffiliatePartner, true),
                'statisticalOrder' => json_encode($statisticalOrder, true),
                'totalOrder' => $totalOrder,
                'totalSales' => $totalSales,
                'totalUserNew' => $totalUserNew,
                'totalProductSell' => $totalProductSell
            ]
        );
    }
}
