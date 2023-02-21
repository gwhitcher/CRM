<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    use HasFactory;

    public function getAll() {
        return DB::table('users')->orderBy('id','asc')->get();
    }

    public function view($id) {
        return DB::table('users')->where('id','=', $id)->first();
    }

    //add user from seeder
    public static function create($user) {
        $updatedDate = now();
        return DB::table('users')
            ->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'created_at' => $updatedDate,
                'updated_at' => $updatedDate
            ]);
    }

    public static function add(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password = Hash::make($password);
        $updatedDate = now();
        return DB::table('users')
            ->insert([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'updated_at' => $updatedDate
            ]);
    }

    public function edit($id, Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        if(!empty($password = $request->input('password'))) {
            $password = Hash::make($password);
            $updatedDate = now();
            return DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'updated_at' => $updatedDate
                ]);
        } else {
            $updatedDate = now();
            return DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                    'updated_at' => $updatedDate
                ]);
        }
    }

    public function remove($id) {
        return DB::table('users')
            ->where('id', $id)
            ->delete();
    }
}
