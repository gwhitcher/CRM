@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-center text-md-start">
                                {{ __('Invoices') }}
                            </div>
                            <div class="col-sm-6 text-center text-md-end">
                                <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('invoice-add') }}">Add</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table
                            id="table"
                            data-pagination="false"
                            data-search="true"
                            data-show-toggle="false"
                            data-toolbar=".toolbar"
                            data-use-row-attr-func="true"
                            data-reorderable-rows="true"
                            class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" data-field="id" data-sortable="true">#</th>
                                <th scope="col" data-field="company" data-sortable="true">Company</th>
                                <th scope="col" data-field="name" data-sortable="true">Name</th>
                                <th scope="col" data-field="due_date" data-sortable="true">Due Date</th>
                                <th scope="col" data-field="status" data-sortable="true">Status</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>
                                        @php
                                            $company = \App\Models\Company::view($invoice->company_id);
                                        @endphp
                                        {{ $company->title }}
                                    </td>
                                    <td>{{ $invoice->title }}</td>
                                    <td>{{ date('F jS, Y', strtotime($invoice->due_date)) }}</td>
                                    <td>
                                        @php
                                        if(strtoupper($invoice->status) == 'COMPLETED') {
                                            $class = 'btn-success';
                                        } else {
                                            $class = 'btn-warning';
                                        }
                                        @endphp
                                        <div class="btn btn-sm {{ $class }} text-white">
                                            {{ strtoupper($invoice->status) }}
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('invoice-view', $invoice->id) }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
