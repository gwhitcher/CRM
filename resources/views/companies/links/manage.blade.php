@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@if($edit) {{ __('Edit') }} @else {{ __('Add') }} @endif</div>

                    <div class="card-body">
                        <form method="POST" action="@if($edit){{ route('company-links-edit', $company->id) }}@else{{ route('company-links-add') }}@endif">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="company_id" class="col-md-2 col-form-label text-md-right">{{ __('Company') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-control" name="company_id" id="company_id" required>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" @if($edit && $company->id == $invoice->company_id) selected @endif @if(isset($_GET['company_id']) && $_GET['company_id'] == $company->id) selected @endif>{{ $company->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" id="title" value="@if($edit) {{
    __($company->title)
 }} @endif" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('URL') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="content" id="content" required>@if($edit) {{
    __($company->content)
 }} @endif</textarea>
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
