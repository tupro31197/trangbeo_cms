<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class OrderExport implements FromArray,WithHeadings,WithColumnWidths
{
    protected $order;

    public function __construct(array $order)
    {
        $this->order = $order;
    }

    public function array(): array
    {
        return $this->order;
    }

    public function headings(): array
    {
        return ['#',
        'Mã đơn hàng',
        'Mã CTV',
        'Tên người đặt hàng',
        'Địa chỉ',
        'SĐT',
        'Tổng sản phẩm',
        'Tổng tiền',
        'Phí ship',
        'Trạng thái',
        'Tên sản phẩm',
        'Số lượng sản phẩm',
        'Giá'
    ];
    }

    public function columnWidths(): array
    {
        
        return [
            'A' => 5,
            'B' => 5,   
            'C' => 20,
            'D' => 20, 
            'E' => 20,
            'F' => 20,
            'G' => 10,
            'I' => 10,
            'J' => 10,
                  
        ];
    }
    

}