<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="d-flex navbar-brand" href="#"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            @if (Auth::user()->id_role == 1)
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">Users</a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('client.index') }}" class="nav-link">Clients</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link">Orders</a>
            </li>
        </ul>
    </div>
    <div>
        <span class="navbar-text">
            ＼(＾▽＾)／ Haloo... {{ Auth::user()->name }}!!!
        </span>
        <a href="{{ route('actionlogout') }}" class="btn btn-outline-info btn-sm">Log out</a>
    </div>
</header>
