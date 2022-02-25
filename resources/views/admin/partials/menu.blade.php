<aside class="side-menu">
    <ul>
        <li class="@if(Request::route()->getName() == 'admin.home') active @endif">
            <a href="{{ route('admin.home') }}">Dashboard</a>
        </li>
        <li>
            <a href="#">User</a>
        </li>
        <li>
            <a href="{{route('admin.restaurant.index')}}">Restaurant</a>
        </li>
        <li class= "@if(Request::route()->getName() == 'admin.dishes.index') active @endif">
            <a href="{{ route('admin.dishes.index') }}">Dishes</a>
        </li>
    </ul>
</aside>