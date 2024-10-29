@extends('myLayouts.app')

@section('title', 'Error')


@section('content')

<div class="container error-container">
    <div class="text-center">
        <div class="error-code">Error :{{ $code }}</div>
        <div class="error-message">{{ $message }}</div>
    </div>
</div>

@endsection