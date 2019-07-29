<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InvoiceController extends Controller
{
    public function manage () {
        $invoices = new Collection;
        if (auth()->user()->stripe_id) {
            $invoices = auth()->user()->invoices();
        }
        return view('invoices.manage', compact('invoices'));
    }

    public function download ($id) {
        return request()->user()->downloadInvoice($id, [
            "vendor" => "Sancailong",
            "product" => __("Suscripción")
        ]);
    }
}
