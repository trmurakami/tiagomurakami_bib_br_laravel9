<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $data = $request->all();

        $pdf = Pdf::loadView('fichaPDF', $data);

        return $pdf->download('fichaPDF.pdf');
    }
}
