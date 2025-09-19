<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPassword;
use Illuminate\Http\Request;

class CompanyPasswordsController extends Controller
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

    public function add(Request $request)
    {
        $companies = Company::getAll();
        if (!empty($request->input('submit'))) {
            $request->validate([
                'company_id' => 'required',
                'title' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);

            CompanyPassword::add($request);

            $request->session()->flash('alert-message', 'Company password added!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }

        return view('companies.passwords.manage')
            ->with([
                'edit' => false,
                'companies' => $companies,
            ]);
    }

    public function edit($id, Request $request)
    {
        $password = CompanyPassword::view($id);
        if (!$password) {
            abort(404);
        }
        $company = Company::view($password->company_id);
        $companies = Company::getAll();
        if (!empty($request->input('submit'))) {
            $request->validate([
                'company_id' => 'required',
                'title' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);

            CompanyPassword::edit($id, $request);

            $request->session()->flash('alert-message', 'Company password updated!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }

        return view('companies.passwords.manage')
            ->with([
                'edit' => true,
                'password' => $password,
                'companies' => $companies,
                'company' => $company,
            ]);
    }

    public static function delete($id, Request $request)
    {
        CompanyPassword::remove($id);

        $request->session()->flash('alert-message', 'Company password deleted!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('companies'));
    }
}
