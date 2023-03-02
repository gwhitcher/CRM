@extends('layouts.email')

@section('content')
    <div style="">
        {{ $emailData['body'] }}
    </div>
@endsection
