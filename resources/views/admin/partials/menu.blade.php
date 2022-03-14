<aside class="side-menu">
    <ul>
        <li>
            <a href="{{ route('admin.home') }}" class="@if(Request::route()->getName() == 'admin.home') active @endif">
                <i class="fas fa-tachometer-alt icon"></i> <span class="d-none d-lg-inline ml-2">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}" class="@if(Request::route()->getName() == 'admin.orders.index') active @endif">
                <i class="fas fa-shipping-fast icon"></i> <span class="d-none d-lg-inline ml-2">Ordini</span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.restaurant.index')}}" class="@if(preg_match('/admin.restaurant/', Request::route()->getName())) active @endif">
                <i class="fas fa-blender icon"></i> <span class="d-none d-lg-inline ml-2">Il tuo ristorante</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dishes.index') }}" class= "@if(preg_match('/admin.dishes/', Request::route()->getName())) active @endif">
                <i class="fas fa-utensils icon"></i> <span class="d-none d-lg-inline ml-2">Il tuo menù</span>
            </a>
        </li>
    </ul>
</aside>