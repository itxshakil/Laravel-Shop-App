@extends('layouts.app')
@section('title','Payment Failed')
@section('content')
    <div class="container mx-auto">
        <div class="md:mx-auto card max-w-lg p-8 pb-2 m-3">
            <h1 class="text-blue-500 text-xl pb-2">Payment Failed.</h1>
            <hr>
            <p class="text-gray-600 mt-2">Error Occured :</p>
            <p class="font-semibold text-gray-900">{{ $error }}</p>
            <a href="{{ route('order.checkout',[session('order')]) }}" class="btn btn-success">Retry Payment</a>
        </div>
    </div>
@endsection