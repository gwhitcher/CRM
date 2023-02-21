@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-center text-md-start">
                                {{ __($invoice->title) }}
                            </div>
                            <div class="col-sm-6 text-center text-md-end">
                                <a class="btn btn-sm btn-dark text-white" href="{{ route('invoice-print', $invoice->id) }}">Print</a>
                                <a class="btn btn-sm btn-dark text-white" href="{{ route('invoice-edit', $invoice->id) }}">Edit</a>
                                <a class="btn btn-sm btn-danger text-white confirm" href="{{ route('invoice-delete', $invoice->id) }}">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $invoice->content }}

                        <table class="table w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                                $total = 0;
                            @endphp
                            @foreach($line_items as $line_item)
                                @php
                                    $i++;
                                    $price = $line_item->quantity * $line_item->price;
                                    $total += $price;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $line_item->title }}</td>
                                    <td>{{ $line_item->quantity }}</td>
                                    <td>${{ number_format($line_item->price, 2) }}</td>
                                    <td>${{ number_format($price, 2) }}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td class="text-end" colspan="5">
                                        Total: ${{ number_format($total, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
