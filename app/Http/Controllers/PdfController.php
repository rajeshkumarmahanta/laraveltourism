<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PdfController extends Controller
{

 public function savePDF($id)
    {
        $booking = Booking::findOrFail($id);
        $tour = Tour::findOrFail($booking->tour_id);
        $data = compact('booking', 'tour');
        // Generate PDF
        $pdf = Pdf::loadView('pdf.invoice', $data);

        // Set file name
        $fileName = 'invoice_' . time() . '.pdf';

        // Path: public/invoices/
        $path = public_path('invoices/' . $fileName);

        // Create folder if not exists
        if (!file_exists(public_path('invoices'))) {
            mkdir(public_path('invoices'), 0777, true);
        }

        // Save PDF in folder
        file_put_contents($path, $pdf->output());

        return $pdf->download($fileName);
    }
}
