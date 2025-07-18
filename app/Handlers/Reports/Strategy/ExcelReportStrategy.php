<?php

namespace App\Handlers\Reports\Strategy;

interface ExcelReportStrategy
{

    public function generate(array $data, string $fileName): string;

}