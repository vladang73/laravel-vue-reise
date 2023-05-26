<?php

namespace App\Http\Services;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\App;

class PdfService
{
    /**
     * @var Dompdf
     */
    private $pdf;

    /**
     * @param string $view
     * @param array $data
     * @return $this
     */
    public function build(string $view, array $data)
    {
        $this->pdf = App::make('dompdf.wrapper');
        $this->pdf->loadView($view, $data);
        return $this;
    }

    /**
     * @param string $outputName
     * @return mixed
     */
    public function download(string $outputName)
    {
        return $this->pdf->download($outputName);
    }
}
