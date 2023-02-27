@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@if($edit) {{ __('Edit') }} @else {{ __('Add') }} @endif</div>

                    <div class="card-body">
                        <form method="POST" action="@if($edit){{ route('company-edit', $company->id) }}@else{{ route('company-add') }}@endif">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" id="title" value="@if($edit) {{
    __($company->title)
 }} @endif" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="content" id="content">@if($edit) {{
    __($company->content)
 }} @endif</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row mb-3">
                                        <label for="first_name" class="col-md-12 col-form-label text-md-right">{{ __('First Name') }}<span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="@if($edit) {{
    __($first_name)
 }} @endif" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row mb-3">
                                        <label for="last_name" class="col-md-12 col-form-label text-md-right">{{ __('Last Name') }}<span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="@if($edit) {{
    __($last_name)
 }} @endif" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row mb-3">
                                        <label for="phone" class="col-md-12 col-form-label text-md-right">{{ __('Phone') }}</label>
                                        <div class="col-md-12">
                                            <input type="tel" class="form-control" name="phone" id="phone" value="@if($edit) {{
    __($phone)
 }} @endif" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row mb-3">
                                        <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('Email') }}<span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="email" id="email" value="@if($edit) {{
    __($email)
 }} @endif" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="address" id="address" value="@if($edit) {{
    __($address)
 }} @endif" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address 2') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="address2" id="address2" value="@if($edit) {{
    __($address2)
 }} @endif" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="city" class="col-md-2 col-form-label text-md-right">{{ __('City') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="city" id="city" value="@if($edit) {{
    __($city)
 }} @endif" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="state" class="col-md-2 col-form-label text-md-right">{{ __('State') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="state" id="state" value="@if($edit) {{
    __($state)
 }} @endif" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="postcode" class="col-md-2 col-form-label text-md-right">{{ __('Postcode') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="postcode" id="postcode" value="@if($edit) {{
    __($postcode)
 }} @endif" />
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
