@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-center text-md-start">
                                {{ __('Users') }}
                            </div>
                            <div class="col-sm-6 text-center text-md-end">
                                <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('users-add') }}">Add</a>
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
                                <th scope="col" data-field="due_date" data-sortable="true">Email</th>
                                <th scope="col">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-secondary text-white ts-9" href="{{ route('users-edit', $user->id) }}">Edit</a>
                                        <a class="btn btn-sm btn-danger text-white ts-9 confirm" href="{{ route('users-delete', $user->id) }}">Delete</a>
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
