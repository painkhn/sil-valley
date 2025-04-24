<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\{
    FromCollection, WithHeadings, WithMapping,
    ShouldAutoSize, WithStyles
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FullOrdersReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Order::with(['user', 'items.computer', 'deliveryDetail'])->get();
    }

    public function headings(): array
    {
        return [
            'ID Заказа',
            'Имя пользователя',
            'Email',
            'Статус',
            'Метод оплаты',
            'Метод доставки',
            'Город',
            'Адрес',
            'Телефон',
            'Товары',
            'Общая сумма',
            'Дата заказа',
        ];
    }

    public function map($order): array
    {
        $delivery = $order->deliveryDetail;

        return [
            $order->id,
            $order->user->name,
            $order->user->email,
            $this->translateStatus($order->status),
            $this->translatePayment($order->payment_method),
            $this->translateDelivery($order->delivery_method),
            $delivery->city ?? '-',
            $delivery ? "{$delivery->address} кв.{$delivery->apartment}" : '-',
            $delivery->phone ?? '-',
            $order->items->map(function ($item) {
                return $item->computer->name . " (x{$item->quantity})";
            })->implode(', '),
            $order->items->sum(fn($item) => $item->price),
            $order->created_at->format('Y-m-d H:i'),
        ];
    }

    protected function translateStatus($status)
    {
        return match ($status) {
            'pending' => 'Ожидает',
            'completed' => 'Завершен',
            default => $status
        };
    }

    protected function translatePayment($method)
    {
        return match ($method) {
            'cash' => 'Наличные',
            'non-cash' => 'Безналичный',
            default => $method
        };
    }

    protected function translateDelivery($method)
    {
        return match ($method) {
            'pickup' => 'Самовывоз',
            'delivery' => 'Доставка',
            default => $method
        };
    }

    public function styles(Worksheet $sheet)
    {
        // Заголовки жирные, с заливкой и черной чертой снизу
        $sheet->getStyle('A1:L1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD9EAD3'], // светло-зелёный фон
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FF000000'], // черная линия
                ],
            ],
        ]);

        // Цвет строк в зависимости от статуса
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $status = $sheet->getCell('D' . $row)->getValue();

            if ($status === 'Ожидает') {
                $sheet->getStyle("A{$row}:L{$row}")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFF3CD'); // жёлтый фон
            }

            if ($status === 'Завершен') {
                $sheet->getStyle("A{$row}:L{$row}")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFD4EDDA'); // зелёный фон
            }
        }

        return [];
    }

}
