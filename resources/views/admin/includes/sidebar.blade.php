@php
    $items = [
        'admin_panel.home' => 'Home',
        'admin_panel.csv.create' => 'CSV',
    ];
@endphp

@if(auth()->check())
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <ul class="sidebar">
                    @foreach($items as $route => $title)
                        @if(is_null($title))
                            <li><hr/></li>
                            @continue(1)
                        @endif
                        <li>
                        @if(\Request::route()->getName() == "admin_panel.$route.index" || \Request::route()->getName() == $route)
                            <li><b>{{ $title }}</b></li>
                        @else
                            <li><a href="{{ route::has("admin_panel.$route.index") ? route("admin_panel.$route.index") : (route::has($route) ? route($route) : 'javascript:;') }}">{{ $title }}</a></li>
                            @endif
                            </li>
                            @endforeach
                            <li><hr/></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
@endif
