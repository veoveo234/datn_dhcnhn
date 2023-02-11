<?php

namespace App\Http\Controllers\Admin\ExcelProduct\Sheets;
use App\Http\Controllers\Controller;

use Excel;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
Use Maatwebsite\Excel\Sheet;

class ProductExport extends Controller implements WithMultipleSheets
{
   
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new ProductSheet();
        // $sheets[] = new LoanReport($this->type_asset_id);
        // $sheets[] = new UserSheettttt();
        return $sheets;
    }
}
