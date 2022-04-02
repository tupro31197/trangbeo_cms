<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PacketExport implements FromArray,WithHeadings,WithColumnWidths
{
    protected $packet;

    public function __construct(array $packet)
    {
        $this->packet = $packet;
    }

    public function array(): array
    {
        return $this->packet;
    }

    public function headings(): array
    {
        return ['#',
        'Mã gói',
        'Tên gói',
        'Giá mua',
        'Mã người đặt hàng',
        'Tên người đặt hàng',
        'Địa chỉ',
        'SĐT',
        'Trạng thái',
        'Nội dung mua'
    
    ];
    }

    public function columnWidths(): array
    {
        
        return [
            'A' => 5,
            'B' => 5,   
            'C' => 20,
            'D' => 10, 
            'E' => 10,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 15,
            'J' => 30,
                  
        ];
    }
    

}