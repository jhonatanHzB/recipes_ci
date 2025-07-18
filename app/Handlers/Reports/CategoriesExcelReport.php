<?php

namespace App\Handlers\Reports;

use App\Handlers\Reports\Strategy\ExcelReportStrategy;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CategoriesExcelReport implements ExcelReportStrategy
{
    public function generate(array $data, string $fileName): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre de la categoría');
        $sheet->setCellValue('C1', 'Recetas con esta categoría');

        $rowNumber = 2; // Start from the second row

        foreach ($data as $category) {
            $sheet->setCellValue('A' . $rowNumber, $category->id);
            $sheet->setCellValue('B' . $rowNumber, $category->name);
            $sheet->setCellValue('C' . $rowNumber, $category->count);
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return $tempFile;
    }
}