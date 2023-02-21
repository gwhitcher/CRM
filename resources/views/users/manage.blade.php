@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@if($edit) {{ __('Edit') }} @else {{ __('Add') }} @endif</div>

                    <div class="card-body">
                        <form method="POST" action="@if($edit){{ route('users-edit', $user->id) }}@else{{ route('users-add') }}@endif">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" id="name" value="@if($edit) {{
    __($user->name)
 }} @endif" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control" name="password" id="password" value="" />
                                    <div class="small fst-italic">{{ __('Leave blank to keep the password the same.') }}</div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="email" class="form-control" name="email" id="email" value="@if($edit) {{
    __($user->email)
 }} @endif" />
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-12 text-end">
                                    <input type="submit" name="submit" id="submit" class="btn btn-sm btn-dark" value="Submit" />
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
