@extends('admin.layouts.frame')

@section('BlockTitle','CSV | Upload new CSV')

@section('content')
    <a href="{{ route('admin_panel.home') }}">[X]&nbsp;Cancel</a>
    <hr/>
    <form action="{{route('admin_panel.csv.upload')}}" method="post" enctype="multipart/form-data">
        @csrf

        <b>File: </b>
        <input type="file" name="file"/>
        <br><br>
        <input type="submit" value="Upload File"/>
    </form>
@endsection
