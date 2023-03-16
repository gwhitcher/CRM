<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Invoice extends Model
{
    public static function getAll() {
        return DB::table('invoices')->orderBy('id','desc')->get();
    }

    public static function view($id) {
        return DB::table('invoices')->where('id','=', $id)->first();
    }

    public static function getInvoicesByCompanyID($id) {
        return DB::table('invoices')->where('company_id','=', $id)->get();
    }

    public static function getInvoicesPastDue() {
        $date = now()->toDateString();
        return DB::table('invoices')
            ->where('due_date','<=', $date)
            ->orderBy('due_date','asc')
            ->get();
    }

    public static function add(Request $request) {
        $company_id = $request->input('company_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $due_date = $request->input('due_date');
        $status = $request->input('status');
        $line_items = $request->input('line_items');
        $current_date_time = Carbon::now()->toDateTimeString();
        if(!empty($line_items)) {
            $invoice_id = DB::table('invoices')
                ->insertGetId([
                    'company_id' => $company_id,
                    'title' => $title,
                    'content' => $content,
                    'due_date' => $due_date,
                    'status' => $status,
                    'created_at' => $current_date_time,
                    'updated_at' => $current_date_time
                ]);


            foreach($line_items as $line_item) {
                InvoiceLineItem::add($invoice_id, $line_item);
            }
        }
        return '';
    }

    public static function edit($id, Request $request) {
        $company_id = $request->input('company_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $due_date = $request->input('due_date');
        $status = $request->input('status');
        $line_items = $request->input('line_items');
        $current_date_time = Carbon::now()->toDateTimeString();
        if(!empty($line_items)) {
            DB::table('invoices')
                ->where('id', $id)
                ->update([
                    'company_id' => $company_id,
                    'title' => $title,
                    'content' => $content,
                    'due_date' => $due_date,
                    'status' => $status,
                    'updated_at' => $current_date_time
                ]);

            $line_item_id_array = [];
            foreach($line_items as $key => $line_item) {
                $line_item_id_array[] = $key;
            }

            $old_line_item_id_array = [];
            $old_line_items = InvoiceLineItem::lineItemsByInvoiceID($id);
            foreach($old_line_items as $old_line_item) {
                $old_line_item_id_array[] = $old_line_item->id;
            }
            foreach($old_line_item_id_array as $old_line_item_id_array_item) {
                if(!in_array($old_line_item_id_array_item, $line_item_id_array)) {
                    InvoiceLineItem::remove($old_line_item_id_array_item);
                }
            }

            foreach($line_items as $key => $line_item) {
                if(str_contains($key, 'new')) {
                    InvoiceLineItem::add($id, $line_item);
                } else {
                    InvoiceLineItem::edit($id, $key, $line_item);
                }
            }

        }
        return '';
    }
    public static function remove($id) {
        return DB::table('invoices')
            ->where('id', $id)
            ->delete();
    }
}
