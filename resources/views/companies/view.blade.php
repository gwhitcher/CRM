@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-center text-md-start fw-bold">
                                {{ __($company->title) }}
                            </div>
                            <div class="col-sm-6 text-center text-md-end">
                                <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('company-edit', $company->id) }}">Edit</a>
                                <a class="btn btn-sm btn-danger text-white ts-9 confirm" href="{{ route('company-delete', $company->id) }}">Delete</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-9">

                                <div>{{ $company->content }}</div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-md-start">
                                                Invoices
                                            </div>
                                            <div class="col-sm-6 text-center text-md-end">
                                                <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('invoice-add', [ 'company_id' => $company->id ]) }}">Add Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <table class="table w-100">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->id }}</td>
                                                    <td>{{ $invoice->title }}</td>
                                                    <td>{{ $invoice->due_date }}</td>
                                                    <td>{{ strtoupper($invoice->status) }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('invoice-view', $invoice->id) }}">View</a>
                                                        <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('invoice-edit', $invoice->id) }}">Edit</a>
                                                        <a class="btn btn-sm btn-danger text-white ts-9 confirm" href="{{ route('invoice-delete', $invoice->id) }}">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-md-start">
                                                Links
                                            </div>
                                            <div class="col-sm-6 text-center text-md-end">
                                                <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('company-links-add', [ 'company_id' => $company->id ]) }}">Add Link</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <table class="table w-100">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($links as $link)
                                                <tr>
                                                    <td>{{ $link->id }}</td>
                                                    <td>{{ $link->title }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-dark text-white ts-9" href="{{ $link->content }}" target="_blank">View</a>
                                                        <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('company-links-edit', $link->id) }}">Edit</a>
                                                        <a class="btn btn-sm btn-danger text-white ts-9 confirm" href="{{ route('company-links-delete', $link->id) }}">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-md-start">
                                                Notes
                                            </div>
                                            <div class="col-sm-6 text-center text-md-end">
                                                <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('company-notes-add', [ 'company_id' => $company->id ]) }}">Add Note</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <table class="table w-100">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                        @foreach($notes as $note)
                                            <tr>
                                                <td>{{ $note->id }}</td>
                                                <td>{{ $note->title }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-dark text-white ts-9" data-bs-toggle="modal" data-bs-target="#noteModal{{ $note->id }}">
                                                        View
                                                    </button>
                                                    <a class="btn btn-sm btn-dark text-white ts-9" href="{{ route('company-notes-edit', $note->id) }}">Edit</a>
                                                    <a class="btn btn-sm btn-danger text-white ts-9 confirm" href="{{ route('company-notes-delete', $note->id) }}">Delete</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="noteModal{{ $note->id }}" tabindex="-1" aria-labelledby="noteModal{{ $note->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="noteModal{{ $note->id }}Label">{{ $note->title }}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="badge bg-secondary">Created: {{ $note->created_at }}</span>
                                                            <span class="badge bg-secondary">Updated: {{ $note->updated_at }}</span>
                                                            <div>{{ $note->content }}</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="card mt-3 mt-md-0">
                                    <div class="card-header">Contact</div>
                                    <div class="card-body">
                                        <div>{{ $first_name }} {{ $last_name }}</div>
                                        @if(isset($phone))<div>{{ $phone }}</div>@endif
                                        @if(isset($email))<div><a href="mailto:{{ $email }}">{{ $email }}</a></div>@endif
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">Address</div>
                                    <div class="card-body">
                                        @if(isset($address))<div>{{ $address }}</div>@endif
                                        @if(isset($address2))<div>{{ $address2 }}</div>@endif
                                        <div>
                                            @if(isset($city)){{ $city }}@endif
                                            @if(isset($state)){{ $state }}, @endif
                                            @if(isset($postcode)){{ $postcode }}@endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
