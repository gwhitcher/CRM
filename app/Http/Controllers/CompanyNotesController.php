<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLink;
use App\Models\CompanyMeta;
use App\Models\CompanyNote;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CompanyNotesController extends Controller
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
                'title' => 'required'
            ]);

            CompanyNote::add($request);

            $request->session()->flash('alert-message', 'Company note added!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }
        return view('companies.notes.manage')
            ->with([
                'edit' => false,
                'companies' => $companies
            ]);
    }

    public function edit($id, Request $request) {
        $note = CompanyNote::view($id);
        if(!empty($request->input('submit'))) {
            $request->validate([
                'title' => 'required'
            ]);

            CompanyNote::edit($id, $request);

            $request->session()->flash('alert-message', 'Company note updated!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('companies'));
        }
        return view('companies.notes.manage')
            ->with([
                'edit' => true,
                'note' => $note
            ]);
    }

    public static function delete($id, Request $request) {
        CompanyNote::remove($id);

        $request->session()->flash('alert-message', 'Company note deleted!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('companies'));
    }
}
