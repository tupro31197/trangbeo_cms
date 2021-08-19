<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class UsersExport implements FromArray,WithHeadings,WithColumnWidths
{
    protected $user;

    public function __construct(array $user)
    {
        $this->user = $user;
    }

    public function array(): array
    {
        return $this->user;
    }

    public function headings(): array
    {
        return ['#',
        'Id',
        'Tên',
        'Email',
        'Số điện thoại',
        'Chứng minh thư',
        'Địa chỉ',
        'Mã code',
        'Tên định danh',
        'Id người giới thiệu',
        'Tổng tiền mua'
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
            'G' => 20,
            'I' => 10,
            'J' => 10,
            'K' => 10,        
        ];
    }

}