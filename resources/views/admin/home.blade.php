@extends('admin.layouts.frame')

@section('BlockTitle','Home')

@section('content')
    <b>Categories: </b> {{\App\Models\ProductCategory::count()}}<br>
    <b>Products: </b> {{\App\Models\Product::count()}}<br>
@endsection
