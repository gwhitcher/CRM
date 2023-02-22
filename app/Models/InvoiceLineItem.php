<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceLineItem extends Model
{
    public function getAll() {
        return DB::table('invoice_line_items')->orderBy('title','asc')->get();
    }

    public function view($id) {
        return DB::table('invoice_line_items')->where('id','=', $id)->first();
    }

    public static function lineItemsByInvoiceID($id) {
        return DB::table('invoice_line_items')->where('invoice_id', '=', $id)->get();
    }

    public static function add($invoice_id, $line_item) {
        $title = $line_item['title'];
        $content = $line_item['content'];
        $quantity = $line_item['quantity'];
        $price = $line_item['price'];
        return DB::table('invoice_line_items')
            ->insert([
                'invoice_id' => $invoice_id,
                'title' => $title,
                'content' => $content,
                'quantity' => $quantity,
                'price' => $price
            ]);
    }

    public static function edit($invoice_id, $id, $line_item) {
        $title = $line_item['title'];
        $content = $line_item['content'];
        $quantity = $line_item['quantity'];
        $price = $line_item['price'];
        return DB::table('invoice_line_items')
            ->where('id', $id)
            ->update([
                'invoice_id' => $invoice_id,
                'title' => $title,
                'content' => $content,
                'quantity' => $quantity,
                'price' => $price
            ]);
    }

    public static function remove($id) {
        return DB::table('invoice_line_items')
            ->where('id', $id)
            ->delete();
    }


}
