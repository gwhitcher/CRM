@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-center text-md-start">
                                {{ __('Companies') }}
                            </div>
                            <div class="col-sm-6 text-center text-md-end">
                                <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('company-add') }}">Add</a>
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
                                <th scope="col" data-field="name" data-sortable="true">Name</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->title }}</td>
                                <td>
                                    <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('company-view', $company->id) }}">View</a>
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
