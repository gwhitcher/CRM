@extends('layouts.print')

@section('content')
    <div class="container" style="max-width: 600px;">

        <div class="row mb-3">
            <div class="col-6">
                <h1>Invoice</h1>
            </div>
            <div class="col-6 text-end">
                <h3>George Whitcher</h3>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6 fw-bold">
                <div class="">Invoice Number: {{ $invoice->id }}</div>
                <div class="">Date Issued: {{ $invoice->created_at }}</div>
                <div class="">Date Due: {{ $invoice->created_at }}</div>
            </div>
            <div class="col-6">
                {{ $invoice->content }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                @if(env('ADMIN_COMPANY') !== null)
                    <div class="fw-bold">{{ env('ADMIN_COMPANY') }}</div>
                @endif
                @if(env('ADMIN_ADDRESS1') !== null)
                    <div>{{ env('ADMIN_ADDRESS1') }}</div>
                @endif
                @if(env('ADMIN_ADDRESS2') !== null)
                    <div>{{ env('ADMIN_ADDRESS2') }}</div>
                @endif
                <div>
                    @if(env('ADMIN_CITY') !== null)
                        {{ env('ADMIN_CITY') }}
                    @endif
                    @if(env('ADMIN_STATE') !== null)
                        {{ env('ADMIN_STATE') }},
                    @endif
                    @if(env('ADMIN_POSTCODE') !== null)
                        {{ env('ADMIN_POSTCODE') }}
                    @endif
                </div>
                @if(env('ADMIN_PHONE') !== null)
                    <div>{{ env('ADMIN_PHONE') }}</div>
                @endif
                @if(env('ADMIN_EMAIL') !== null)
                    <div>{{ env('ADMIN_EMAIL') }}</div>
                @endif
            </div>
            <div class="col-6">
                <div class="fw-bold">Bill To</div>
                <div>{{ $first_name }} {{ $last_name }}</div>
                @if(isset($address))
                    <div>{{ $address }}</div>
                @endif
                @if(isset($address2))
                    <div>{{ $address2 }}</div>
                @endif
                <div>
                    @if(isset($city))
                        {{ $city }}
                    @endif
                    @if(isset($state))
                        {{ $state }},
                    @endif
                    @if(isset($postcode))
                        {{ $postcode }}
                    @endif
                </div>
                @if(isset($phone))
                    <div>{{ $phone }}</div>
                @endif
                @if(isset($email))
                    <div>{{ $email }}</div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
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
@endsection
