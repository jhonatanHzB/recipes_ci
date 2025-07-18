<?php

namespace App\Handlers\Reports;

use App\Handlers\Reports\Strategy\ExcelReportStrategy;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RecipesWithTagsExcelReport implements ExcelReportStrategy
{
    public function generate(array $data, string $fileName): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Titulo de la receta');
        $sheet->setCellValue('C1', 'Creada el');
        $sheet->setCellValue('D1', 'Actualizada el');
        $sheet->setCellValue('E1', 'Etiquetas');

        $rowNumber = 2; // Start from the second row

        foreach ($data as $recipe) {
            $sheet->setCellValue('A' . $rowNumber, $recipe->id);
            $sheet->setCellValue('B' . $rowNumber, $recipe->name);
            $sheet->setCellValue('C' . $rowNumber, $recipe->created_at);
            $sheet->setCellValue('D' . $rowNumber, $recipe->updated_at);
            $sheet->setCellValue('E' . $rowNumber, $recipe->tags);
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return $tempFile;
    }
}
