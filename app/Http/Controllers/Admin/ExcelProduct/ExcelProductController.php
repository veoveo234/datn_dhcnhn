<?php

namespace App\Http\Controllers\Admin\ExcelProduct;
use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ExcelProduct\Sheets\ProductExport;
class ExcelProductController extends Controller
{
    public function export(Request $request){
        return Excel::download(new ProductExport(), 'don hang Report.xlsx');
    }
}
