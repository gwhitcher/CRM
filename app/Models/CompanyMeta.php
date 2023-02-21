<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CompanyMeta extends Model
{
    use HasFactory;

    public static function getAll($id) {
        return DB::table('company_meta')->where('company_id', $id)->get();
    }

    public static function getMeta($id, $key) {
        $meta = DB::table('company_meta')->where(['company_id' => $id, 'meta_key' => $key])->first();
        if(isset($meta)) {
            return $meta->meta_value;
        } else {
            return '';
        }
    }
}
