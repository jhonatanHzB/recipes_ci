<?php

namespace App\Handlers\Reports;

use App\Handlers\Reports\Strategy\ExcelReportStrategy;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TagsExcelReport implements ExcelReportStrategy
{
    public function generate(array $data, string $fileName): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre de la etiqueta');
        $sheet->setCellValue('C1', 'Cantidad de recetas con etiqueta');
        $sheet->setCellValue('D1', 'Creada el');

        $rowNumber = 2; // Start from the second row

        foreach ($data as $tag) {
            $sheet->setCellValue('A' . $rowNumber, $tag->id);
            $sheet->setCellValue('B' . $rowNumber, $tag->name);
            $sheet->setCellValue('C' . $rowNumber, $tag->count);
            $sheet->setCellValue('D' . $rowNumber, $tag->created_at);
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return $tempFile;
    }
}