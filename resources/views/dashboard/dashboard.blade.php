<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Library Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <!-- Header -->
  <header class="dashboard-header">
    <div class="logo-section">
      <div class="logo-icon">📚</div>
      <div class="logo-text">LibrarySystem</div>
    </div>

    <div class="search-section">
      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" placeholder="Search books, authors, categories...">
        <button class="search-btn">
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>

    <div class="user-section">
      <div class="user-info">
        <div class="user-avatar">🥺</div>
        <div class="user-name">{{ Auth::user()->name }}</div>
      </div>
    </div>
  </header>

  <div class="dashboard-container">
    <nav class="sidebar">
      <div class="sidebar-content">
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="#dashboard" class="nav-link active" title="Dashboard">
              <i class="fas fa-home nav-icon"></i>
              <span class="nav-text">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#books" class="nav-link" title="Books">
              <i class="fas fa-book nav-icon"></i>
              <span class="nav-text">Books</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#edit" class="nav-link" title="Edit">
              <i class="fas fa-edit nav-icon"></i>
              <span class="nav-text">Edit</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#bookmarks" class="nav-link" title="Bookmarks">
              <i class="fas fa-bookmark nav-icon"></i>
              <span class="nav-text">Bookmark</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#settings" class="nav-link" title="Settings">
              <i class="fas fa-cog nav-icon"></i>
              <span class="nav-text">Settings</span>
            </a>
          </li>
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

    <main class="main-content">
      <!-- Page Header -->
      <div class="page-header">
        <h1 class="page-title">Welcome Back, {{ Auth::user()->name }}</h1>
        <p class="page-subtitle">
          Here's what's happening with your library today. Continue your reading journey or explore new
          releases.
        </p>
      </div>

      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Currently Reading</h3>
            <div class="stat-icon">
              <i class="fas fa-book-open"></i>
            </div>
          </div>
          <div class="stat-value">3</div>
          <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>+1 this week</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Books Read</h3>
            <div class="stat-icon">
              <i class="fas fa-check-circle"></i>
            </div>
          </div>
          <div class="stat-value">42</div>
          <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>+5 this month</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Reading Hours</h3>
            <div class="stat-icon">
              <i class="fas fa-clock"></i>
            </div>
          </div>
          <div class="stat-value">156</div>
          <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>+12 this week</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Wishlist</h3>
            <div class="stat-icon">
              <i class="fas fa-heart"></i>
            </div>
          </div>
          <div class="stat-value">18</div>
          <div class="stat-change negative">
            <i class="fas fa-arrow-down"></i>
            <span>-2 this week</span>
          </div>
        </div>
      </div>

      <div class="content-grid">
        <!-- Book of the Month -->
        <div class="content-card">
          <h2><i class="fas fa-crown"></i> Book of the Month</h2>
          <div class="book-of-month">
            <div class="book-cover">
              <i class="fas fa-book"></i>
            </div>
            <div class="book-info">
              <h3 class="book-title">The Journey to the West</h3>
              <p class="book-author">By Litewaran</p>
              <p class="book-description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen
                book.
              </p>
              <div class="book-actions">
                <a href="#read" class="book-btn primary">
                  <i class="fas fa-play"></i> Start Reading
                </a>
                <a href="#details" class="book-btn secondary">
                  <i class="fas fa-info-circle"></i> View Details
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Popular Releases -->
        <div class="content-card">
          <h2><i class="fas fa-fire"></i> Popular Releases</h2>
          <div class="releases-grid">
            @for($i = 1; $i <= 4; $i++) <div class="release-item">
              <div class="release-cover">
                <i class="fas fa-book"></i>
              </div>
              <div class="release-info">
                <h4 class="release-title">New Selection {{ $i }}</h4>
                <p class="release-author">Author Name</p>
                <div class="release-rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
              </div>
          </div>
          @endfor
        </div>
      </div>
  </div>
  </main>
  </div>

  <!-- Footer -->
  <footer class="dashboard-footer">
    <div class="copyright">
      &copy; {{ date('Y') }} LibrarySystem.
    </div>
    </div>
  </footer>

  <script>
      cument.querySelector('.sidebar-logout-btn').addEventListener('click', function (e) { }
        document.querySelectorAll('.nav-link').forEach(link => {
        nk.addEventListener('click', function (e) {
          preventDefault();
          cument.querySelectorAll('.nav-link').forEach(item => {
            em.classList.remove('active');
          ;
          is.classList.add('active');
        ;
      ;

       Search functionality
      cument.querySelector('.search-input').addEventListener('keypress', function (e) {
         (e.key === 'Enter') {
          nst query = this.value.trim();
           (query) {
            ert(`Searching for: "${query}"`);
                        ;

      cument.querySelector('.search-btn').addEventListener('click', function () {
        nst query = document.querySelector('.search-input').value.trim();
         (query) {
          ert(`Searching for: "${query}"`);
              ;
  </script>
</body>

</html>
