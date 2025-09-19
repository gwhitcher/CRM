<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CompanyPassword extends Model
{
    protected $table = 'company_passwords';

    protected static function decryptRecord($record)
    {
        if ($record && isset($record->password_encrypted)) {
            try {
                $record->password = Crypt::decryptString($record->password_encrypted);
            } catch (\Throwable $throwable) {
                $record->password = null;
            }
            unset($record->password_encrypted);
        }

        return $record;
    }

    public static function getAll()
    {
        return DB::table('company_passwords')
            ->orderBy('title', 'asc')
            ->get()
            ->map(function ($password) {
                return static::decryptRecord($password);
            });
    }

    public static function view($id)
    {
        $password = DB::table('company_passwords')
            ->where('id', '=', $id)
            ->first();

        return static::decryptRecord($password);
    }

    public static function getPasswordsByCompanyID($id)
    {
        return DB::table('company_passwords')
            ->where('company_id', '=', $id)
            ->orderBy('title', 'asc')
            ->get()
            ->map(function ($password) {
                return static::decryptRecord($password);
            });
    }

    public static function add(Request $request)
    {
        $dateCreated = now();

        return DB::table('company_passwords')
            ->insert([
                'company_id' => $request->input('company_id'),
                'title' => $request->input('title'),
                'username' => $request->input('username'),
                'password_encrypted' => Crypt::encryptString($request->input('password')),
                'notes' => $request->input('notes'),
                'created_at' => $dateCreated,
                'updated_at' => $dateCreated,
            ]);
    }

    public static function edit($id, Request $request)
    {
        $updatedDate = now();

        return DB::table('company_passwords')
            ->where('id', $id)
            ->update([
                'company_id' => $request->input('company_id'),
                'title' => $request->input('title'),
                'username' => $request->input('username'),
                'password_encrypted' => Crypt::encryptString($request->input('password')),
                'notes' => $request->input('notes'),
                'updated_at' => $updatedDate,
            ]);
    }

    public static function remove($id)
    {
        return DB::table('company_passwords')
            ->where('id', $id)
            ->delete();
    }
}
