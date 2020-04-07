@extends('admin.layouts.frame')

@section('BlockTitle','Product Categories | List')

@section('content')
    <span style="color: #aaa;">[+]&nbsp;Create New Category</span>
    <hr/>

    @if($items->count())
        <table class="table">
            <thead>
            <tr>
                <th>Category ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <a href="{{route('admin_panel.product_category.edit',[ $item ])}}">Edit</a>
                        &nbsp;|&nbsp;
                        <form action="{{route('admin_panel.product_category.destroy',[ $item ])}}" style="display: inline-block" method="post">
                            @csrf
                            @method('delete')
                            <a href="javascript:;" onclick="if(confirm('Are you sure to delete category \'{{$item->title}}\' ?')) $(this).closest('form').submit()">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $items->links() }}
    @else
        <i>Nothing to show</i>
    @endif

@endsection

