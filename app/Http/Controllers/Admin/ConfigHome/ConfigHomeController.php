<?php

namespace App\Http\Controllers\Admin\ConfigHome;

use App\Http\Controllers\Controller;
use App\Models\Admin\ImgHome\ImageHome;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
class ConfigHomeController extends Controller
{
    public function edit(){
        // if(!empty($id) && is_numeric($id)){
            $data = DB::table('image_home')->select(
                'id', 'img_banner', 'name_banner', 'title_banner', 'des_banner', 'img_bottom_banner_1', 'name_bottom_banner_1', 'title_bottom_banner_1', 'img_bottom_banner_2', 'name_bottom_banner_2', 'title_bottom_banner_2', 'img_bottom_banner_3', 'name_bottom_banner_3', 'title_bottom_banner_3', 'img_footer_banner', 'name_footer_banner', 'title_footer_banner', 'des_footer_banner', 'status', 'created_at', 'updated_at'
            )->get()->toArray();
            return view('admin/pages/configHome/config-home', [
                'data' => $data,
            ]);
        // }
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'img_banner' => 'required',
            'name_banner' => 'required',
            'title_banner' => 'required',
            'des_banner' => 'required',
            'img_bottom_banner_1' => 'required',
            'name_bottom_banner_1' => 'required',
            'title_bottom_banner_1' => 'required',
            'img_bottom_banner_2' => 'required',
            'name_bottom_banner_2' => 'required',
            'title_bottom_banner_2' => 'required',
            'img_bottom_banner_3' => 'required',
            'name_bottom_banner_3' => 'required',
            'title_bottom_banner_3' => 'required',
            'img_footer_banner' => 'required',
            'name_footer_banner' => 'required',
            'title_footer_banner' => 'required',
            'des_footer_banner' => 'required',
        ]);
        // dd($request->all());
        if(true){
            $check = ImageHome::where('id', 1)->get()->toArray();
            // dd($check);
            if(!empty($check)){
                if ($request->hasFile('img_banner')) {
                    $path = 'storage/images/home/' . $check[0]['img_banner'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                if ($request->hasFile('img_bottom_banner_1')) {
                    $path = 'storage/images/home/' . $check[0]['img_bottom_banner_1'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                if ($request->hasFile('img_bottom_banner_2')) {
                    $path = 'storage/images/home/' . $check[0]['img_bottom_banner_2'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                if ($request->hasFile('img_bottom_banner_3')) {
                    $path = 'storage/images/home/' . $check[0]['img_bottom_banner_3'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                if ($request->hasFile('img_footer_banner')) {
                    $path = 'storage/images/home/' . $check[0]['img_footer_banner'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            Storage::putFile('public/images/home', $request->file('img_banner'));
            Storage::putFile('public/images/home', $request->file('img_bottom_banner_1'));
            Storage::putFile('public/images/home', $request->file('img_bottom_banner_2'));
            Storage::putFile('public/images/home', $request->file('img_bottom_banner_3'));
            Storage::putFile('public/images/home', $request->file('img_footer_banner'));
            ImageHome::updateOrCreate(
                [
                    'id' => 1,
                ],
                [
                    'img_banner' => $request->file('img_banner')->hashName(),
                    'name_banner' => $request->name_banner,
                    'title_banner' => $request->title_banner,
                    'des_banner' => $request->des_banner,
                    'img_bottom_banner_1' => $request->file('img_bottom_banner_1')->hashName(),
                    'name_bottom_banner_1' => $request->name_bottom_banner_1,
                    'title_bottom_banner_1' => $request->title_bottom_banner_1,
                    'img_bottom_banner_2' => $request->file('img_bottom_banner_2')->hashName(),
                    'name_bottom_banner_2' => $request->name_bottom_banner_2,
                    'title_bottom_banner_2' => $request->title_bottom_banner_2,
                    'img_bottom_banner_3' => $request->file('img_bottom_banner_3')->hashName(),
                    'name_bottom_banner_3' => $request->name_bottom_banner_3,
                    'title_bottom_banner_3' => $request->title_bottom_banner_3,
                    'img_footer_banner' => $request->file('img_footer_banner')->hashName(),
                    'name_footer_banner' => $request->name_footer_banner,
                    'title_footer_banner' => $request->title_footer_banner,
                    'des_footer_banner' => $request->des_footer_banner,
                ]
            );

            return 1;
        }else{
            return 0;
        }
    }
}
