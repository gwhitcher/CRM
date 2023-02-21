<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CompanyNote extends Model
{
    use HasFactory;

    public function getAll() {
        return DB::table('company_notes')->orderBy('title','asc')->get();
    }

    public function view($id) {
        return DB::table('company_notes')->where('id','=', $id)->first();
    }

    public function getNotesByCompanyID($id) {
        return DB::table('company_notes')->where('company_id','=', $id)->get();
    }

    public function add(Request $request) {
        $company_id = $request->input('company_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $dateCreated = now();
        return DB::table('company_notes')
            ->insert([
                'company_id' => $company_id,
                'title' => $title,
                'content' => $content,
                'created_at' => $dateCreated,
                'updated_at' => $dateCreated
            ]);
    }

    public function edit($id, Request $request) {
        $company_id = $request->input('company_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $updatedDate = now();
        return DB::table('company_notes')
            ->where('id', $id)
            ->update([
                'company_id' => $company_id,
                'title' => $title,
                'content' => $content,
                'updated_at' => $updatedDate
            ]);
    }

    public function remove($id) {
        return DB::table('company_notes')
            ->where('id', $id)
            ->delete();
    }
}
