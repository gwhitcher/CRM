<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLink;
use Illuminate\Http\Request;

class CompanyLinksController extends Controller
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

    public function add(Request $request) {
        $companies = Company::getAll();
        if(!empty($request->input('submit'))) {
            $request->validate([
                'company_id' => 'required',
                'title' => 'required',
                'content' => 'required',
            ]);

            CompanyLink::add($request);

            $request->session()->flash('alert-message', 'Company link added!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }
        return view('companies.links.manage')
            ->with([
                'edit' => false,
                'companies' => $companies
            ]);
    }

    public function edit($id, Request $request) {
        $companies = Company::getAll();
        $link = CompanyLink::view($id);
        if(!empty($request->input('submit'))) {
            $request->validate([
                'company_id' => 'required',
                'title' => 'required',
                'content' => 'required',
            ]);

            CompanyLink::edit($id, $request);

            $request->session()->flash('alert-message', 'Company link updated!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }
        return view('companies.links.manage')
            ->with([
                'edit' => true,
                'link' => $link,
                'companies' => $companies
            ]);
    }

    public static function delete($id, Request $request) {
        CompanyLink::remove($id);

        $request->session()->flash('alert-message', 'Company link deleted!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('companies'));
    }
}
