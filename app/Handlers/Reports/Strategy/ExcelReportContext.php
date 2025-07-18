<?php

namespace App\Handlers\Reports\Strategy;

class ExcelReportContext
{

    private ExcelReportStrategy $strategy;

    public function setStrategy(ExcelReportStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(array $data, string $fileName): string
    {
        return $this->strategy->generate($data, $fileName);
    }

}