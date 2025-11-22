<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\TableOrder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportFile implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = TableOrder::all();
        return $orders;
    }

    public function columnWidths(): array
    {
        return [
            'Tên khách hàng' => 300,
            'Địa chỉ nhận' => 500,
            'Số điện thoại' => 200,
            'Email' => 500,
        ];
    }

    public function headings(): array {
        return [
            "Mã hoá đơn",
            'Tên khách hàng',
            "Email",
            "Số điện thoại",
            "Địa chỉ nhận",
            "Ghi chú",
            "Phương thức thanh toán",
            "Tổng giá trị hoá đơn",
            "Ngày đặt",
        ];
    }

    public function map($order): array {
        return [
            $order->code,
            $order->fullname,
            $order->email,
            $order->phone,
            $order->address,
            $order->content,
            $order->payment,
            $order->total_price,
            $order->created_at->format('d/m/Y'),
        ];
    }
}
