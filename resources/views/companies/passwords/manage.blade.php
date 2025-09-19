@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@if($edit) {{ __('Edit Password') }} @else {{ __('Add Password') }} @endif</div>

                    <div class="card-body">
                        <form method="POST" action="@if($edit){{ route('company-passwords-edit', $password->id) }}@else{{ route('company-passwords-add') }}@endif">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="company_id" class="col-md-3 col-form-label text-md-right">{{ __('Company') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control" name="company_id" id="company_id" required>
                                        @foreach($companies as $companyOption)
                                            <option value="{{ $companyOption->id }}" @if(old('company_id', $edit ? $password->company_id : request('company_id')) == $companyOption->id) selected @endif>{{ $companyOption->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $edit ? $password->title : '') }}" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('Username') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $edit ? $password->username : '') }}" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" required />
                                    @if($edit)
                                        <small class="form-text text-muted">{{ __('Enter a new password to replace the stored credential.') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="notes" class="col-md-3 col-form-label text-md-right">{{ __('Notes') }}</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="notes" id="notes">{{ old('notes', $edit ? $password->notes : '') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
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
@endsection
