@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@if($edit) {{ __('Edit') }} @else {{ __('Add') }} @endif</div>

                    <div class="card-body">
                        <form method="POST" action="@if($edit){{ route('invoice-edit', $invoice->id) }}@else{{ route('invoice-add') }}@endif">
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
    __($invoice->title)
 }} @endif" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="content" id="content">@if($edit) {{
    __($invoice->content)
 }} @endif</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="due_date" class="col-md-2 col-form-label text-md-right">{{ __('Due Date') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control" name="due_date" id="due_date" value="@if($edit){{__($invoice->due_date)}}@endif" required />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="status" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}<span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="pending" @if($edit && $invoice->status == 'pending') selected @endif>Pending</option>
                                        <option value="completed" @if($edit && $invoice->status == 'completed') selected @endif>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div id="line_items">
                                @if($edit)
                                    @foreach($line_items as $line_item)
                                        <div class="row mb-2" id="line_item_row_{{ $line_item->id }}">
                                            <div class="col-sm-6 fst-italic">Line Item</div>
                                            <div class="col-sm-6 text-center text-md-end">
                                                <a href="#" data-id="{{ $line_item->id }}" class="deleteRow text-danger">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="line_items[{{ $line_item->id }}][title]">Title</label>
                                                <input class="form-control" type="text" value="{{ $line_item->title }}" name="line_items[{{ $line_item->id }}][title]" />
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="line_items[{{ $line_item->id }}][content]">Content</label>
                                                <input class="form-control" type="text" value="{{ $line_item->content }}" name="line_items[{{ $line_item->id }}][content]" />
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="line_items[{{ $line_item->id }}][quantity]">Quantity</label>
                                                <input class="form-control" type="text" value="{{ $line_item->quantity }}" name="line_items[{{ $line_item->id }}][quantity]" />
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="line_items[{{ $line_item->id }}][price]">Price</label>
                                                <input class="form-control" type="text" value="{{ $line_item->price }}" name="line_items[{{ $line_item->id }}][price]" />
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div id="new_line_items"></div>
                                <div class="text-end">
                                    <a href="#" class="addRow text-success">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
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
