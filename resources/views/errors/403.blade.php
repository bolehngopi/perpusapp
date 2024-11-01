@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
    <div class="text-center py-20">
        <h1 class="text-4xl font-bold text-red-500 mb-4">403</h1>
        <p class="text-lg text-gray-700">You don't have permission to access this page.</p>
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mt-4">Go back to homepage</a>
    </div>
@endsection
