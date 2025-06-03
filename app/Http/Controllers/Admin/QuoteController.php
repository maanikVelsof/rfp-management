<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RfpQuote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = RfpQuote::with(['rfp', 'vendor'])
            ->select('rfp_quotes.*')
            ->join('rfp_details', 'rfp_quotes.rfp_id', '=', 'rfp_details.id')
            ->orderBy('rfp_quotes.submitted_at', 'desc')
            ->paginate(10);

        return view('admin.quotes.index', compact('quotes'));
    }
}
