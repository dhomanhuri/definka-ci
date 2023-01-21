<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alumni;
use \Barryvdh\DomPDF\Facade\Pdf;


class PDFController extends Controller
{
    public function generate_pdf()
    {
        $today = Carbon::now()->format('d-m-Y');
        $rawData = Alumni::all()->sortBy('name');
        $data = [
            'title' => 'DATA ALUMNI',
            'date' => $today,
            'users' => $rawData
        ];
        $pdf = PDF::loadView('pdf', $data); 
        return $pdf->download($today . '.pdf');

    }
}
