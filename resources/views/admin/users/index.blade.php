@extends('admin.layouts.frame')

@section('BlockTitle','Users | List')

@section('content')
    <span style="color: #aaa;">[+]&nbsp;Create New User</span>
    <hr/>

    @if($items->count())
        <table class="table">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ !empty($item->Roles())? implode(',',$item->Roles()->pluck('name')->toArray()) : ''}}</td>
                    <td>
                        <a href="{{route('admin_panel.user.edit',[ $item ])}}">Edit</a>
                        &nbsp;|&nbsp;
                        <form action="{{route('admin_panel.user.destroy',[ $item ])}}" style="display: inline-block" method="post">
                            @csrf
                            @method('delete')
                            <a href="javascript:;" onclick="if(confirm('Are you sure to delete user \'{{$item->title}}\' ?')) $(this).closest('form').submit()">Delete</a>
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

