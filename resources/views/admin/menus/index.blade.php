<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Menu Management</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-management.css') }}">
</head>

<body>

    <!-- HEADER -->
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>

        <a href="{{ route('show.home') }}" class="book-btn secondary"
            style="margin-left: 15px; display:flex; align-items:center;">
            <i class="fas fa-house" style="margin-right:5px;"></i> Back to Dashboard
        </a>
    </header>

    <div class="main-content menu-page">
        <div class="content-card" style="margin-bottom: 10px;">
            <h1 class="page-title">Menu Management</h1>
            <p class="page-subtitle">Add, edit, or remove navigation links (maximum of 3 active).</p>
        </div>

        <!-- ADD MENU FORM -->
        <div class="content-card" style="margin-bottom: 10px;">
            <h2>Add Menu</h2>
            <form method="POST" action="{{ route('menus.store') }}">
                @csrf
                <table class="menu-table">
                    <tr>
                        <td><input class="menu-input" name="title" placeholder="Menu title" required></td>
                        <td>
                            <select class="menu-select" name="type" required>
                                <option value="internal">Internal</option>
                                <option value="external">External</option>
                                <option value="content">Content</option>
                            </select>
                        </td>
                        <td><input class="menu-input" name="url" placeholder="/books or https://example.com"></td>
                        <td><textarea class="menu-textarea" name="content"
                                placeholder="Content (for content type only)"></textarea></td>
                        <td><input class="menu-input" type="number" name="order" value="1" min="1" max="3"></td>
                        <td><button type="submit" class="menu-btn add">Add</button></td>
                    </tr>
                </table>
            </form>
        </div>

        <!-- MENU LIST -->
        <div class="content-card" style="margin-bottom: 10px;">
            <h2>Existing Menus</h2>
            <table class="menu-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>URL</th>
                        <th>Order</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>
                                <form method="POST" action="{{ route('menus.update', $menu->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input class="menu-input" name="title" value="{{ $menu->title }}">
                            </td>
                            <td>
                                <select class="menu-select" name="type">
                                    <option value="internal" @selected($menu->type == 'internal')>Internal</option>
                                    <option value="external" @selected($menu->type == 'external')>External</option>
                                    <option value="content" @selected($menu->type == 'content')>Content</option>
                                </select>
                            </td>
                            <td><input class="menu-input" name="url" value="{{ $menu->url }}"></td>
                            <td><input class="menu-input" type="number" name="order" value="{{ $menu->order }}" min="1"
                                    max="3"></td>
                            <td>
                                <input class="menu-checkbox" type="checkbox" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <button type="submit" class="menu-btn save">Save</button>
                                </form>

                                <form method="POST" action="{{ route('menus.destroy', $menu->id) }}"
                                    class="menu-inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="menu-btn delete"
                                        onclick="return confirm('Delete this menu?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; {{ date('Y') }} LibrarySystem.
        </div>
        </div>
    </footer>

</body>

</html>