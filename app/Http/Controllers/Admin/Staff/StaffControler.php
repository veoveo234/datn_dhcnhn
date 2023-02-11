<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class StaffControler extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $staff = User::select('id', 'avatar', 'name', 'phone', 'email', 'password','created_at')->get()->toArray();
            
            return Datatables::of($staff)->make(true);
        }
        // dd(Auth::id());
        return view('admin/pages/staff/view-staff');
    }
    
    public function edit($id){
        if(!empty($id) && is_numeric($id)){
            $data = DB::table('users')->select('id', 'avatar', 'name', 'phone', 'email', 'password','created_at')->where('id',$id)->get()->toArray();
            return view('admin/pages/staff/edit-staff', [
                'data' => $data,
            ]);
        }
    }
    
    public function destroy(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $id = $request->id;
                $staff = User::select('avatar')->where('id', '=', $id)->get()->toArray();
                $des_path = 'storage/images/avatar/' . $staff[0]['avatar'];
                if (file_exists($des_path)) {
                    unlink($des_path);
                }
                User::find($id)->delete();
            }
        }
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|min:1',
            'name_staff' => 'required',
            'phone_staff' => 'required',
            'email_staff' => 'required',
        ]);
        // dd($request->all());
        $id = $request->id;
        $checkProduct = User::select('id')->where('id', $id)->get()->toArray();
        if(!empty($checkProduct)){

            $staff = User::find($id);
            $staff->name = $request->name_staff;
            $staff->phone = $request->phone_staff;
            $staff->email = $request->email_staff;
            if ($request->hasFile('main_image')) {
                if(!empty($staff->avatar)){
                    $path = 'storage/images/avatar/'. $staff->avatar;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $image = $request->file('main_image')->hashName();
                Storage::putFile('public/images/avatar', $request->file('main_image'));
                $staff->avatar = $image;

            }
            $staff->save();
            return 1;
        }else{
            return 0;
        }
    }
    
    public function viewAddNew(){
        return view('admin/pages/staff.add-staff',[
            
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required|min:1|max:150',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'phone' => 'required'
        ]);
        // var_dump($request->all());
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image')->hashName();
            // dd($image);
            Storage::putFile('public/images/avatar', $request->file('main_image'));

            $staff = new User;
            $staff->name = $request->name;
            $staff->avatar = $image;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            $staff->password = bcrypt($request->password);
            $staff->save();
            return 1;
        }
    }
}
