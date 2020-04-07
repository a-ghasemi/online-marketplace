@extends('admin.layouts.frame')

@section('BlockTitle','Products | List')

@section('content')
    <a href="{{ route('admin_panel.csv.create') }}">[+]&nbsp;Upload CSV File</a><br/>
    <span style="color: #aaa;">[+]&nbsp;Create New Product</span>
    <hr/>

    @if($items->count())
        <table class="table">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Category</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->category->title ?? '---'}}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{route('admin_panel.product.edit',[ $item ])}}">Edit</a>
                        &nbsp;|&nbsp;
                        <form action="{{route('admin_panel.product.destroy',[ $item ])}}" style="display: inline-block" method="post">
                            @csrf
                            @method('delete')
                            <a href="javascript:;" onclick="if(confirm('Are you sure to delete product \'{{$item->title}}\' ?')) $(this).closest('form').submit()">Delete</a>
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

