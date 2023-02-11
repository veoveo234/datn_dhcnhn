<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\User\Member\Member;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/pages/home.home');
    }

    public function loadOverall()
    {
        if (request()->ajax()) {
            $presentMonth = Carbon::now()->month;
            $dataMember = DB::table('members')->select(DB::raw('COUNT(id) as total'))->where('created_at', 'LIKE', '%'.$presentMonth.'%')->get()->toArray();
            $dataOrder = DB::table('orders')->select(DB::raw('COUNT(id) as total'))->where('created_at', 'LIKE', '%'.$presentMonth.'%')->get()->toArray();
            $dataPartner = DB::table('affiliate_partners')->select(DB::raw('COUNT(id) as total'))->where('created_at', 'LIKE', '%'.$presentMonth.'%')->get()->toArray();


            return view('admin/pages/home/pages.overall-statistics', [
                'dataMember' => $dataMember,
                'dataOrder' => $dataOrder,
                'dataPartner' => $dataPartner,
            ]);
        }
    }

    public function loadSales()
    {
        if (request()->ajax()) {
            $presentMonth = Carbon::now()->month;
            $dataSales = DB::table('orders')->select(DB::raw('SUM(total_money) as total'), DB::raw('DAY(created_at) as day'))->where('created_at', 'LIKE', '%'.$presentMonth.'%')->groupBy('day')->orderBy('day', 'asc')->get()->toArray();
            $arrDay = [0];
            $arrTotal = [0];
            foreach($dataSales as $value){
                $arrDay[] = 'Ngày '.$value->day;
                $arrTotal[] = $value->total;
            }

            return view('admin/pages/home/pages.load-sales', [
                'arrDay' => json_encode($arrDay),
                'arrTotal' => json_encode($arrTotal)
            ]);
        }
    }

    public function loadMonthsale()
    {
        if (request()->ajax()) {
            $presentYear = Carbon::now()->year;
            $dataSales = DB::table('orders')->select(DB::raw('SUM(total_money) as total'), DB::raw('MONTH(created_at) as month'))->where('created_at', 'LIKE', '%'.$presentYear.'%')->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
            $arrMonth = [0];
            $arrTotal = [0];
            $presentMonth = end($dataSales);
            foreach($dataSales as $value){
                $arrMonth[] = 'Tháng '.$value->month;
                $arrTotal[] = $value->total;
            }
            // dd($presentMonth->total);
            return view('admin/pages/home/pages.monthly-sales', [
                'arrMonth' => json_encode($arrMonth),
                'arrTotal' => json_encode($arrTotal),
                'presentMonth' => $presentMonth
            ]);
        }
    }


}
