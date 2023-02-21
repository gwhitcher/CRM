<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    public function getAll() {
        return DB::table('companies')->orderBy('title','asc')->get();
    }

    public function view($id) {
        return DB::table('companies')->where('id','=', $id)->first();
    }

    public function add(Request $request) {
        $title = $request->input('title');
        $content = $request->input('content');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $postcode = $request->input('postcode');
        $id = DB::table('companies')
            ->insertGetId([
               'title' => $title,
               'content' => $content
            ]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'first_name', 'meta_value' => $first_name]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'last_name', 'meta_value' => $last_name]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'phone', 'meta_value' => $phone]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'email', 'meta_value' => $email]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'address', 'meta_value' => $address]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'address2', 'meta_value' => $address2]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'city', 'meta_value' => $city]);
        DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'state', 'meta_value' => $state]);
        return DB::table('company_meta')->insert(['company_id' => $id, 'meta_key' => 'postcode', 'meta_value' => $postcode]);
    }

    public function edit($id, Request $request) {
        $title = $request->input('title');
        $content = $request->input('content');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $postcode = $request->input('postcode');
        DB::table('companies')
            ->where('id', $id)
            ->update([
                'title' => $title,
                'content' => $content
            ]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'first_name'])->update(['meta_value' => $first_name]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'last_name'])->update(['meta_value' => $last_name]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'phone'])->update(['meta_value' => $phone]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'email'])->update(['meta_value' => $email]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'address'])->update(['meta_value' => $address]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'address2'])->update(['meta_value' => $address2]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'city'])->update(['meta_value' => $city]);
        DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'state'])->update(['meta_value' => $state]);
        return DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => 'postcode'])->update(['meta_value' => $postcode]);
    }

    public function remove($id) {
        return DB::table('companies')
            ->where('id', $id)
            ->delete();
    }
}
