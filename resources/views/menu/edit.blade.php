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
                    <!-- Sidebar links -->
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
                <h1 class="page-title">Edit Menu: {{ $menu->title }}</h1>
            </div>

            @if(auth()->user()->role === 'librarian')
                <div class="content-card">
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                        </div>

                        @if($menu->type === 'content')
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea id="content" name="content" rows="10" required>{{ old('content', $menu->content) }}</textarea>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select id="type" name="type" required>
                                    <option value="internal" {{ old('type', $menu->type) === 'internal' ? 'selected' : '' }}>Internal</option>
                                    <option value="external" {{ old('type', $menu->type) === 'external' ? 'selected' : '' }}>External</option>
                                    <option value="content" {{ old('type', $menu->type) === 'content' ? 'selected' : '' }}>Content</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" id="url" name="url" value="{{ old('url', $menu->url) }}">
                            </div>

                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" id="order" name="order" value="{{ old('order', $menu->order) }}">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="is_active">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>

                        <button type="submit" class="btn-save">Save Changes</button>
                    </form>
                </div>
            @else
                <div class="content-card">
                    {!! $menu->content !!}
                </div>
            @endif
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; <span id="currentYear"></span> LibrarySystem.
        </div>
    </footer>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
</body>
</html>
