<?php

namespace App\Http\Controllers\Admin\ExcelProduct\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\admin\ManageStorage;
use App\Models\user\PayPrincipal;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Sheet;
use IlluminateSupportFacadesApp;
use MaatwebsiteExcelFacadesExcel;

class ProductSheet  extends Controller implements FromCollection, WithStyles, WithEvents, WithColumnWidths,WithHeadings,WithColumnFormatting,WithMapping,ShouldAutoSize,WithStrictNullComparison
{
    
    public $store_id_request,$name_borrow;
    protected $test_data_export;
    public function registerEvents(): array
    {
        // dd($this->type_asset_id,$this->start_date, $this->end_date,$this->store_id_request,$this->type_filter );
        $styleArray = [
            //Set font style
            'font' => [
                'size'      =>  23,
                'bold'      =>  true,
                'color' => ['argb' => 'EB2B02'],
            ],
        ];
        $styleArrayD6F7 = [
        'fill' => 
            [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'DCE6F1']
            ]
        ];
        $styleBold = [
            'font' => [
                'bold'      =>  true,
            ],
        ];
        return [
            BeforeSheet::class    => function (BeforeSheet $event) use ($styleArray,$styleArrayD6F7) {
                $event->sheet->getStyle('A1')->applyFromArray($styleArray);
                $event->sheet->setCellValue('A1', 'Báo cáo đơn hàng ');
                $event->sheet->getDelegate()->mergeCells('A1:F1');
            },

            AfterSheet::class    => function (AfterSheet $event) use ($styleBold) {
                $data_export =  $this->test_data_export;
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(55);
                $event->sheet->getDelegate()->getStyle('A:K')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->freezePane('A3');
                $event->sheet->getDelegate()->setAutoFilter('B2:J2');
            },

        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [

            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            '2'    => ['font' => ['bold' => true]],
            'A:K'    =>
            [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
    public function collection()
    {
        // $data_re = new CustomerReportController();
        // $data_show = $data_re->dataTableCustomerReport($this->store_id_request,$this->name_borrow);
        $data_show = session('ssProductSheet');
        // dd($data_show);
        $this->test_data_export = $data_show;
        return collect($data_show);
        
    }
    public function map($data): array
    {
        $status = '';
        if(($data->status) == 1){
            $status = 'Chờ xử lý';
        }elseif(($data->status) == 2){
            $status = 'Đã xác nhận';
        }elseif(($data->status) == 3){
            $status = 'Chờ lấy hàng';
        }elseif(($data->status) == 4){
            $status = 'Đang giao hàng';
        }elseif(($data->status) == 5){
            $status = 'Đã giao hàng';
        }elseif(($data->status) == 6){
            $status = 'Đã hoàn tất';
        }elseif(($data->status) == 7){
            $status = 'Đã hủy';
        }
        return [
            $data->order,
            $data->name,
            $data->phone,
            $data->total_money,
            $data->created_at,
            $status,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'G' => '#,##0',
            'K' => '#,##0',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 25,
            'I' => 15,
            'J' => 15,
            'K' => 15,
        ];  
    }
    public function headings(): array
    {
        return [
            "STT",
            "Khách hàng",
            "Số điện thoại",
            "Tổng tiền",
            "Ngày đặt hàng",
            "Trạng thái",
        ];
    }
    function generateAlphabet($na) {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }

}
