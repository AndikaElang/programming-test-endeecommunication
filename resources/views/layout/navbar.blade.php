<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="d-flex navbar-brand" href="#"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{ route('client.index') }}" class="nav-link">Client</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link">Order</a>
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
