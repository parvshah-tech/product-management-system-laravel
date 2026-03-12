@extends('layouts.header')

@section('content')
    <div class="max-w-4xl mx-auto py-6">
        <x-product-content :product="$product" />
    </div>
@endsection
