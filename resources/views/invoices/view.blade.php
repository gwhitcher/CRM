@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-center text-md-start">
                                {{ $company->title }} - {{ __($invoice->title) }}
                            </div>
                            <div class="col-sm-6 text-center text-md-end">
                                <a class="btn btn-sm btn-secondary text-white" href="{{ route('invoice-print', $invoice->id) }}">Print</a>
                                <button class="btn btn-sm btn-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmail" aria-expanded="false" aria-controls="collapseEmail">
                                    Email
                                </button>
                                <a class="btn btn-sm btn-secondary text-white" href="{{ route('invoice-edit', $invoice->id) }}">Edit</a>
                                <a class="btn btn-sm btn-danger text-white confirm" href="{{ route('invoice-delete', $invoice->id) }}">Delete</a>

                                <div class="collapse mt-2" id="collapseEmail">
                                    <div class="card card-body">
                                        <form method="POST" action="{{ route('invoice-email', $invoice->id) }}">
                                            @csrf
                                            <div class="form-group row mb-3">
                                                <label for="body" class="col-md-2 col-form-label text-md-right">{{ __('Body') }}</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" id="body" name="body"></textarea>
                                                    <small class="fst-italic">Leave blank to use default.</small>
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <div class="col-md-12 text-end">
                                                    <input type="submit" name="submit" id="submit" class="btn btn-sm btn-secondary" value="Submit" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

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
