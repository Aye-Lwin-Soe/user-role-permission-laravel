<div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">{{ Auth::user()->name }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : 'link-dark' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles*') ? 'active' : 'link-dark' }}">
                Roles
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : 'link-dark' }}">
                Users
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="nav-link link-dark"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>