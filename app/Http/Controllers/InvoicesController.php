<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyMeta;
use App\Models\Invoice;
use App\Models\InvoiceLineItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['print']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $invoices = Invoice::getAll();
        return view('invoices.index')
            ->with(['invoices' => $invoices]);
    }

    public function view($id) {
        $invoice = Invoice::view($id);
        $line_items = InvoiceLineItem::lineItemsByInvoiceID($id);
        return view('invoices.view')
            ->with([
                'invoice' => $invoice,
                'line_items' => $line_items,
            ]);
    }

    public function print($id) {
        $invoice = Invoice::view($id);
        $line_items = InvoiceLineItem::lineItemsByInvoiceID($id);
        $company = Company::view($invoice->company_id);
        $first_name = CompanyMeta::getMeta($invoice->company_id, 'first_name');
        $last_name = CompanyMeta::getMeta($invoice->company_id, 'last_name');
        $email = CompanyMeta::getMeta($invoice->company_id, 'email');
        $phone = CompanyMeta::getMeta($invoice->company_id, 'phone');
        $address = CompanyMeta::getMeta($invoice->company_id, 'address');
        $address2 = CompanyMeta::getMeta($invoice->company_id, 'address2');
        $city = CompanyMeta::getMeta($invoice->company_id, 'city');
        $state = CompanyMeta::getMeta($invoice->company_id, 'state');
        $postcode = CompanyMeta::getMeta($invoice->company_id, 'postcode');
        return view('invoices.print')
            ->with([
                'invoice' => $invoice,
                'line_items' => $line_items,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'address2' => $address2,
                'city' => $city,
                'state' => $state,
                'postcode' => $postcode,
                'company' => $company
            ]);
    }

    public function add(Request $request) {
        $companies = Company::getAll();
        if(!empty($request->input('submit'))) {
            $request->validate([
                'title' => 'required'
            ]);

            Invoice::add($request);

            $request->session()->flash('alert-message', 'Invoice added!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('invoices'));
        }
        return view('invoices.manage')
            ->with([
                'edit' => false,
                'companies' => $companies
            ]);
    }

    public function edit($id, Request $request) {
        $invoice = Invoice::view($id);
        $line_items = InvoiceLineItem::lineItemsByInvoiceID($id);
        $companies = Company::getAll();
        if(!empty($request->input('submit'))) {
            $request->validate([
                'title' => 'required'
            ]);

            Invoice::edit($id, $request);

            $request->session()->flash('alert-message', 'Invoice updated!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('invoices'));
        }
        return view('invoices.manage')
            ->with([
                'edit' => true,
                'invoice' => $invoice,
                'line_items' => $line_items,
                'companies' => $companies
            ]);
    }

    public static function delete($id, Request $request) {
        Invoice::remove($id);
        $line_items = InvoiceLineItem::lineItemsByInvoiceID($id);
        foreach($line_items as $line_item) {
            InvoiceLineItem::remove($line_item->id);
        }

        $request->session()->flash('alert-message', 'Invoice deleted!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('invoices'));
    }

    public static function email($id, Request $request) {
        //PDF
        $body = $request->input('body');
        if(empty($body)) {
            $body = env('INVOICE_DEFAULT_BODY');
        }
        $invoice = Invoice::view($id);
        $line_items = InvoiceLineItem::lineItemsByInvoiceID($id);
        $company = Company::view($invoice->company_id);
        $first_name = CompanyMeta::getMeta($invoice->company_id, 'first_name');
        $last_name = CompanyMeta::getMeta($invoice->company_id, 'last_name');
        $email = CompanyMeta::getMeta($invoice->company_id, 'email');
        $phone = CompanyMeta::getMeta($invoice->company_id, 'phone');
        $address = CompanyMeta::getMeta($invoice->company_id, 'address');
        $address2 = CompanyMeta::getMeta($invoice->company_id, 'address2');
        $city = CompanyMeta::getMeta($invoice->company_id, 'city');
        $state = CompanyMeta::getMeta($invoice->company_id, 'state');
        $postcode = CompanyMeta::getMeta($invoice->company_id, 'postcode');
        $pdf = PDF::loadView('invoices.print', [
            'invoice' => $invoice,
            'line_items' => $line_items,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'postcode' => $postcode,
            'company' => $company
        ])->setOption('defaultFont', 'sans-serif');
        $output = $pdf->output();
        $file = 'invoices/invoice_' . $id . '.pdf';
        Storage::put($file, $output);

        $emailData = [
            'id' => $id,
            'invoice' => $invoice,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'postcode' => $postcode,
            'company' => $company->title,
            'file' => $file,
            'body' => $body
        ];

        //send email
        Mail::send('invoices.email', ["emailData" => $emailData], function($message) use ($emailData) {
            $message->to($emailData['email'], $emailData['company'])
                ->subject('Invoice #'.$emailData['id'], $emailData['id'])
                ->replyTo(env('ADMIN_EMAIL'), env('ADMIN_COMPANY'))
                ->bcc(env('ADMIN_EMAIL'), env('ADMIN_COMPANY'))
                ->from(env('ADMIN_EMAIL'), env('ADMIN_COMPANY'))
                ->attach(storage_path('app/'.$emailData['file']));
            ;
        });

        //delete invoice
        Storage::delete($file);

        $request->session()->flash('alert-message', 'Invoice sent!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('invoices'));
    }
}
