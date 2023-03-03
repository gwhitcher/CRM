<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLink;
use App\Models\CompanyMeta;
use App\Models\CompanyNote;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::getAll();
        return view('companies.index')
            ->with(['companies' => $companies]);
    }

    public function view($id) {
        $company = Company::view($id);
        $first_name = CompanyMeta::getMeta($id, 'first_name');
        $last_name = CompanyMeta::getMeta($id, 'last_name');
        $email = CompanyMeta::getMeta($id, 'email');
        $phone = CompanyMeta::getMeta($id, 'phone');
        $address = CompanyMeta::getMeta($id, 'address');
        $address2 = CompanyMeta::getMeta($id, 'address2');
        $city = CompanyMeta::getMeta($id, 'city');
        $state = CompanyMeta::getMeta($id, 'state');
        $postcode = CompanyMeta::getMeta($id, 'postcode');
        $invoices = Invoice::getInvoicesByCompanyID($id);
        $notes = CompanyNote::getNotesByCompanyID($id);
        $links = CompanyLink::getLinksByCompanyID($id);
        return view('companies.view')
            ->with([
                'company' => $company,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'address2' => $address2,
                'city' => $city,
                'state' => $state,
                'postcode' => $postcode,
                'invoices' => $invoices,
                'notes' => $notes,
                'links' => $links
            ]);
    }

    public function add(Request $request) {
        if(!empty($request->input('submit'))) {
            $request->validate([
                'title' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required'
            ]);

            Company::add($request);

            $request->session()->flash('alert-message', 'Company added!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }
        return view('companies.manage')
            ->with(['edit' => false]);
    }

    public function edit($id, Request $request) {
        $company = Company::view($id);
        $first_name = CompanyMeta::getMeta($id, 'first_name');
        $last_name = CompanyMeta::getMeta($id, 'last_name');
        $email = CompanyMeta::getMeta($id, 'email');
        $phone = CompanyMeta::getMeta($id, 'phone');
        $address = CompanyMeta::getMeta($id, 'address');
        $address2 = CompanyMeta::getMeta($id, 'address2');
        $city = CompanyMeta::getMeta($id, 'city');
        $state = CompanyMeta::getMeta($id, 'state');
        $postcode = CompanyMeta::getMeta($id, 'postcode');
        if(!empty($request->input('submit'))) {
            $request->validate([
                'title' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required'
            ]);

            Company::edit($id, $request);

            $request->session()->flash('alert-message', 'Company updated!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }
        return view('companies.manage')
            ->with([
                'edit' => true,
                'company' => $company,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'address2' => $address2,
                'city' => $city,
                'state' => $state,
                'postcode' => $postcode,
            ]);
    }

    public static function delete($id, Request $request) {
        Company::remove($id);

        $request->session()->flash('alert-message', 'Company deleted!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('companies'));
    }
}
