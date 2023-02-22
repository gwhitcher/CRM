<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $latestCompanies = Company::getLatest();
        $pastDueInvoices = Invoice::getInvoicesPastDue();
        return view('home')
            ->with([
                'latestCompanies' => $latestCompanies,
                'pastDueInvoices' => $pastDueInvoices
            ]);
    }
}
