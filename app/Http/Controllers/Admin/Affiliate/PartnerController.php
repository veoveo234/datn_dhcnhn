<?php

namespace App\Http\Controllers\Admin\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\User\Affiliate\AffiliatePartner;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|in:0,1,2,3',
            ]);
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $status = $request->status;
            if($status == 0){
                $operatorStatus = '<>';
            }else{
                $operatorStatus = '=';
            }
        
            if(($start_date) == ($end_date)){
                $data = AffiliatePartner::select('id', 'avatar', 'firstname', 'lastname', 'email', 'phone', 'status', 'created_at')->whereDate('created_at', '=', $start_date)->where('status', $operatorStatus, $status)->get()->toArray();
            }else{
                $data = AffiliatePartner::select('id', 'avatar', 'firstname', 'lastname', 'email', 'phone', 'status', 'created_at')->whereBetween('created_at', array($start_date, $end_date))->where('status', $operatorStatus, $status)->get()->toArray();
            }
            if(!empty($data)){
                foreach($data as $key => $value){
                    $data[$key]['created_at'] = date('d-m-Y', strtotime($value['created_at']));
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/affiliate.view-partner');
    }

    public function delete(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->id) && is_numeric($request->id)) {
                $deleteAvatar = AffiliatePartner::select('avatar')->where('id', '=', $request->id)->get()->toArray();
                $des_path = 'storage/images/affiliate/' . $deleteAvatar[0]['avatar'];
                if (file_exists($des_path)) {
                    unlink($des_path);
                }
                AffiliatePartner::find($request->id)->delete();
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $data = AffiliatePartner::select('*')->where('id', $request->id)->get()->toArray();
                if(!empty($data)){
                    foreach($data as $key => $value){
                        $data[$key]['created_at'] = date('d-m-Y', strtotime($value['created_at']));
                        $data[$key]['updated_at'] = date('d-m-Y', strtotime($value['updated_at']));
                    }
                }
                return view('admin/pages/affiliate/pages.edit-partner',[
                    'data' => $data
                ]);
            }
        }
    }

    public function approve(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $partner = AffiliatePartner::find($request->id);
                $partner->status = 2;
                $partner->save();
            }
        }
    }

    public function lockup(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $partner = AffiliatePartner::find($request->id);
                $partner->status = 3;
                $partner->save();
            }
        }
    }

    public function unlockup(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $partner = AffiliatePartner::find($request->id);
                $partner->status = 2;
                $partner->save();
            }
        }
    }
}
