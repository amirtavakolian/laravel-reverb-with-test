<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color: #343a40;
            color: white;
            padding: 1rem 0;
        }

        .sidebar a, .sidebar button {
            display: block;
            color: white;
            padding: 0.75rem 1rem;
            text-decoration: none;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 1rem;
        }

        .sidebar a:hover, .sidebar button:hover {
            background-color: #495057;
        }

        .submenu {
            display: none;
            padding-left: 1rem;
            background-color: #3e444a;
        }

        .submenu a {
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
        }

        .main {
            flex: 1;
            padding: 2rem;
        }

        .panel {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1.25rem;
            background-color: #ffffff;
        }

        .panel-header {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.5rem;
        }

        .panel-body {
            font-size: 1rem;
            color: #333;
        }

        .alert {
            position: relative;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.375rem;
            font-size: 1rem;
        }

        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }
    </style>
    @yield('style')

</head>
<body>
@if(session()->has('successfully_login'))
    <div class="alert alert-success">
        <p>{{ session()->get('successfully_login') }}</p>
    </div>
@endif
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#">Home</a>
        <hr>
        <a href="">My Posts</a>
        <hr>
        <a href="#">My Comments</a>
        <hr>
        <a href="{{ route('tag-index') }}">My Tags</a>
        <hr>

        @auth()
            @if(auth()->user()->isAdmin())
            <button onclick="toggleMenu()">Site 👇</button>
            <div id="submenu" class="submenu">
                <a href="#">Users</a>
                <hr>

                <a href="#">Posts</a>
                <hr>

                <a href="#">Categories</a>
                <hr>

                <a href="#">Tags</a>
            </div>
            @endif
        @endauth

    </div>

    <!-- Main content -->
    <div class="main">
        @yield('outside-panel')
        <div class="panel">
            @yield('panel')
        </div>
    </div>
</div>

<script>
    function toggleMenu() {
        const submenu = document.getElementById('submenu');
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }
</script>
@yield('script')
@vite(['resources/js/app.js'])
<script>
</script>
</body>
</html>
