<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\User\Member\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class MemberControler extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $member = Member::select('id', 'avatar', 'name', 'phone', 'address', 'email', 'password', 'point', 'status','created_at')->where('status',1)->get()->toArray();
            // dd($data);
            return Datatables::of($member)->make(true);
        }
        return view('admin/pages/member/view-member');
    }
    public function edit($id){
        if(!empty($id) && is_numeric($id)){
            $data = DB::table('members')->select('id', 'avatar', 'name', 'phone', 'address', 'email', 'password', 'point', 'status','created_at')->where('id',$id)->get()->toArray();
            return view('admin/pages/member/edit-member', [
                'data' => $data,
            ]);
        }
    }
    public function destroy(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $id = $request->id;
                $product = Member::select('avatar')->where('id', '=', $id)->get()->toArray();
                $des_path = 'storage/images/avatar/' . $product[0]['avatar'];
                if (file_exists($des_path)) {
                    unlink($des_path);
                }
                Member::where('id', '=', $request->id)->update(['status' => 0]);
            }
        }
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|min:1',
            'name_member' => 'required',
            'phone_member' => 'required',
            'email_member' => 'required',
            'address_member' => 'required',
        ]);
        // var_dump($request->all());
        $id = $request->id;
        $checkProduct = Member::select('id')->where('id', $id)->get()->toArray();
        if(!empty($checkProduct)){

            $member = Member::find($id);
            $member->name = $request->name_member;
            $member->phone = $request->phone_member;
            $member->email = $request->email_member;
            $member->address = $request->address_member;
            if ($request->hasFile('main_image')) {
                $path = 'storage/images/avatar/' . $member->avatar;
                if (file_exists($path)) {
                    unlink($path);
                }
                $image = $request->file('main_image')->hashName();
                Storage::putFile('public/images/avatar', $request->file('main_image'));
                $member->avatar = $image;

            }
            $member->save();
            return 1;
        }else{
            return 0;
        }
    }
}
