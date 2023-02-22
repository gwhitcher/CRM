<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    public function getAll() {
        return DB::table('invoices')->orderBy('id','desc')->get();
    }

    public function view($id) {
        return DB::table('invoices')->where('id','=', $id)->first();
    }

    public function getInvoicesByCompanyID($id) {
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

        $invoice_id = DB::table('invoices')
            ->insertGetId([
                'company_id' => $company_id,
                'title' => $title,
                'content' => $content,
                'due_date' => $due_date,
                'status' => $status
            ]);

        $line_items = $request->input('line_items');
        foreach($line_items as $line_item) {
            InvoiceLineItem::add($invoice_id, $line_item);
        }

        return '';
    }

    public static function edit($id, Request $request) {
        $company_id = $request->input('company_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $due_date = $request->input('due_date');
        $status = $request->input('status');
        DB::table('invoices')
            ->where('id', $id)
            ->update([
                'company_id' => $company_id,
                'title' => $title,
                'content' => $content,
                'due_date' => $due_date,
                'status' => $status
            ]);


        $line_items = $request->input('line_items');

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

        return '';
    }

    public function remove($id) {
        return DB::table('invoices')
            ->where('id', $id)
            ->delete();
    }
}
