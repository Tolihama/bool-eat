<aside class="side-menu">
    <ul>
        <li>
            <a href="{{ route('admin.home') }}" class="@if(Request::route()->getName() == 'admin.home') active @endif">
                <i class="fas fa-tachometer-alt icon mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#" class="disabled">
                <i class="fas fa-shipping-fast icon mr-2"></i> Ordini
            </a>
        </li>
        <li>
            <a href="{{route('admin.restaurant.index')}}" class="@if(preg_match('/admin.restaurant/', Request::route()->getName())) active @endif">
                <i class="fas fa-blender icon mr-2"></i> Il tuo ristorante
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dishes.index') }}" class= "@if(preg_match('/admin.dishes/', Request::route()->getName())) active @endif">
                <i class="fas fa-utensils icon mr-2"></i> Il tuo menù
            </a>
        </li>
        <li>
            <a href="#" class="disabled">
                <i class="fa-solid fa-user-gear icon mr-2"></i> Profilo utente
            </a>
        </li>
        <li>
            <a href="#" class="disabled">
                <i class="fas fa-chart-bar icon mr-2"></i> Statistiche
            </a>
        </li>
    </ul>
</aside>