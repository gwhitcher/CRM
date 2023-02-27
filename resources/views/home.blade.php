@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <div class="card mb-3">
                        <div class="card-header">Latest Companies</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($latestCompanies as $latestCompany)
                                    <tr>
                                        <td>{{ $latestCompany->id }}</td>
                                        <td>{{ $latestCompany->title }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('company-view', $latestCompany->id) }}">View</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">Past Due Invoices</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Due Date</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pastDueInvoices as $pastDueInvoice)
                                    <tr>
                                        <td>{{ $pastDueInvoice->id }}</td>
                                        <td>{{ $pastDueInvoice->title }}</td>
                                        <td>{{ $pastDueInvoice->due_date }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('invoice-view', $pastDueInvoice->id) }}">View</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
