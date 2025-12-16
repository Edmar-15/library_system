@php
    use App\Models\Menu;

    $headerMenus = Menu::where('is_active', 1)
        ->orderBy('order')
        ->limit(3)
        ->get();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $menu->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/menu-management.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    @php
    use App\Models\Menu;

    $headerMenus = Menu::where('is_active', 1)
        ->orderBy('order')
        ->limit(3)
        ->get();
@endphp
    <!-- Header -->
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>

        <nav class="header-nav">
            @foreach ($headerMenus as $header)
                @if ($header->type === 'internal')
                    <a href="{{ url($header->url) }}" class="header-link">{{ $header->title }}</a>
                @elseif ($header->type === 'external')
                    <a href="{{ $header->url }}" target="_blank" class="header-link">{{ $header->title }}</a>
                @elseif ($header->type === 'content')
                    <a href="{{ route('menus.show', $header->id) }}" class="header-link">{{ $header->title }}</a>
                @endif
            @endforeach
        </nav>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('show.home') }}"
                            class="nav-link {{ request()->routeIs('show.home') ? 'active' : '' }}" title="Dashboard">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('show.about') }}"
                            class="nav-link {{ request()->routeIs('show.about') ? 'active' : '' }}" title="About">
                            <i class="fas fa-eye nav-icon"></i>
                            <span class="nav-text">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('books.index') }}"
                            class="nav-link {{ request()->routeIs('books.index') ? 'active' : '' }}" title="Books">
                            <i class="fas fa-book nav-icon"></i>
                            <span class="nav-text">Books</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bookmarks.index') }}"
                            class="nav-link {{ request()->routeIs('bookmarks.index') ? 'active' : '' }}"
                            title="Bookmarks">
                            <i class="fas fa-bookmark nav-icon"></i>
                            <span class="nav-text">Bookmark</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.index') }}"
                            class="nav-link {{ request()->routeIs('staff.index') ? 'active' : '' }}" title="Staff">
                            <i class="fas fa-address-card nav-icon"></i>
                            <span class="nav-text">Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('news.index') }}"
                            class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}" title="News">
                            <i class="fas fa-newspaper nav-icon"></i>
                            <span class="nav-text">News</span>
                        </a>
                    </li>
                    @if(auth()->user()->role === 'librarian')
                        <li class="nav-item">
                            <a href="{{ url('/menus') }}" class="nav-link {{ request()->is('menus*') ? 'active' : '' }}"
                                title="Navigation">
                                <i class="fas fa-bars nav-icon"></i>
                                <span class="nav-text">Navigation</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-logout-btn">
                            <i class="fas fa-sign-out-alt sidebar-logout-icon"></i>
                            <span class="sidebar-logout-text">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">{{ $menu->title }}</h1>
            </div>

            @if(auth()->user()->role === 'librarian')
                <div class="edit-button-container" style="margin-bottom: 1rem;">
                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn-edit"
                        style="padding: 0.5rem 1rem; background: #007bff; color: #fff; border-radius: 5px; text-decoration: none;">
                        <i class="fas fa-edit"></i> Edit Page
                    </a>
                </div>
            @endif

            <div class="content-card">
                {!! $menu->content !!}
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; <span id="currentYear"></span> LibrarySystem.
        </div>
    </footer>

    <script>
        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Add active class to current page link in sidebar
        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                const href = link.getAttribute('href');
                if (href && currentPath.includes(href.replace(/\//g, ''))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>