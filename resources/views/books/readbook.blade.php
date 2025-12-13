<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Read: {{ $book->title }} - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/readbook.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="font-medium">
    <!-- Reading Progress -->
    <div class="reading-progress">
        <div class="progress-bar" id="progressBar" style="width: {{ ($page / $totalPages) * 100 }}%">
            <span class="progress-text" id="progressText">{{ $page }} / {{ $totalPages }}</span>
        </div>
    </div>

    <!-- Header -->
    <header class="reader-header">
        <div class="header-content">
            <a href="{{ route('books.show', $book) }}" class="back-btn" title="Back to Book Details">
                <i class="fas fa-arrow-left"></i>
                <span class="back-text">Back</span>
            </a>

            <h1 class="book-title">
                <i class="fas fa-book-open"></i>
                {{ Str::limit($book->title, 50) }}
            </h1>

            <div class="header-actions">
                <a href="{{ route('books.download', $book) }}" class="download-btn" title="Download Book">
                    <i class="fas fa-download"></i>
                    <span class="download-text">Download</span>
                </a>
            </div>
        </div>
    </header>

    <div class="reading-controls">
        <div class="control-group">
            <div class="control-label">
                <i class="fas fa-text-height"></i>
                <span>Text Size</span>
            </div>

            <div class="font-controls">
                <button class="font-btn" id="fontDecrease" title="Decrease font size" aria-label="Decrease font size">
                    <i class="fas fa-minus"></i>
                </button>

                <div class="font-scale">
                    <div class="font-option" data-size="small" title="Small" aria-label="Small font size">S</div>
                    <div class="font-option active" data-size="medium" title="Medium" aria-label="Medium font size">M</div>
                    <div class="font-option" data-size="large" title="Large" aria-label="Large font size">L</div>
                    <div class="font-option" data-size="xlarge" title="Extra Large" aria-label="Extra large font size">XL</div>
                </div>

                <div class="font-size-display" id="fontSizeDisplay" aria-live="polite">Medium</div>

                <button class="font-btn" id="fontIncrease" title="Increase font size" aria-label="Increase font size">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <main class="reader-main">
        <div class="reader-container">
            <!-- Book Info -->
            <div class="book-info-bar">
                <span class="author">
                    <i class="fas fa-user-pen"></i>
                    {{ Str::limit($book->author, 30) }}
                </span>

                @if($book->pages)
                <span class="pages">
                    <i class="fas fa-file"></i>
                    {{ $book->pages }} pages
                </span>
                @endif

                @if($book->language)
                <span class="language">
                    <i class="fas fa-language"></i>
                    {{ $book->language }}
                </span>
                @endif
            </div>

            <!-- Book Content -->
            <div class="book-content" id="bookContent" role="article" aria-label="Book content">
                <pre id="bookText">{{ $content }}</pre>
            </div>

            <!-- Pagination -->
            <div class="pagination-controls">
                <span class="page-indicator" aria-live="polite">
                    <i class="fas fa-bookmark"></i>
                    <div class="page-numbers">
                        <span class="current-page" id="currentPage">{{ $page }}</span>
                        <span class="page-separator">/</span>
                        <span class="total-pages">{{ $totalPages }}</span>
                    </div>
                    <div class="page-progress" id="pageProgress">
                        {{ round(($page / $totalPages) * 100) }}% complete
                    </div>
                </span>

                <div class="pagination-buttons">
                    @if ($page > 1)
                        <a class="pagination-btn prev-btn"
                           href="{{ route('books.readbook', ['book' => $book->id, 'page' => $page - 1]) }}"
                           id="prevPage"
                           aria-label="Previous page">
                            <i class="fas fa-angle-left"></i> Previous
                        </a>
                    @else
                        <span class="pagination-btn prev-btn disabled" aria-disabled="true">
                            <i class="fas fa-angle-left"></i> Previous
                        </span>
                    @endif

                    @if ($page < $totalPages)
                        <a class="pagination-btn next-btn"
                           href="{{ route('books.readbook', ['book' => $book->id, 'page' => $page + 1]) }}"
                           id="nextPage"
                           aria-label="Next page">
                            Next <i class="fas fa-angle-right"></i>
                        </a>
                    @else
                        <span class="pagination-btn next-btn disabled" aria-disabled="true">
                            Next <i class="fas fa-angle-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <div class="pagination-controls">

        <button id="saveBookmark" class="pagination-btn">
            <i class="fas fa-bookmark"></i> Save Bookmark
        </button>

        <span class="page-indicator">
            Page {{ $page }} of {{ $totalPages }}
        </span>
    </div>

    <!-- Floating Scroll Down -->
    <div class="scroll-down-arrow" id="scrollDownArrow" title="Scroll down">
        <i class="fas fa-chevron-down"></i>
    </div>

    <!-- Footer -->
    <footer class="reader-footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} LibrarySystem. All rights reserved.</p>
            <p class="footer-sub">
                <i class="fas fa-heart" style="color: #E07B16;"></i>
                Happy Reading from LibrarySystem
            </p>
        </div>
    </footer>

    <script>
        document.getElementById('saveBookmark').addEventListener('click', function () {
        fetch('{{ route('books.bookmark', $book->id) }}', {
            method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            body: JSON.stringify({
                page: {{ $page }}
            })
            }).then(res => res.json())
            .then(() => alert('Bookmark saved!'));
        });
    </script>

    <!-- Toast Notification Container -->
    <div class="toast" id="toast"></div>

    <script>
        // Font Size Control
        class FontSizeControl {
            constructor() {
                this.currentSize = 2; // 1: small, 2: medium, 3: large, 4: xlarge
                this.sizes = ['small', 'medium', 'large', 'xlarge'];
                this.displayNames = ['Small', 'Medium', 'Large', 'Extra Large'];
                this.fontSizes = ['14px', '16px', '18px', '20px'];
                this.lineHeights = ['1.5', '1.6', '1.8', '2.0'];

                this.init();
            }

            init() {
                this.loadPreference();
                this.setupEventListeners();
                this.updateDisplay();
            }

            setupEventListeners() {
                // Font decrease button
                document.getElementById('fontDecrease').addEventListener('click', () => this.changeSize(-1));

                // Font increase button
                document.getElementById('fontIncrease').addEventListener('click', () => this.changeSize(1));

                // Font scale options
                document.querySelectorAll('.font-option').forEach(option => {
                    option.addEventListener('click', (e) => {
                        const size = e.target.dataset.size;
                        const sizeIndex = this.sizes.indexOf(size);
                        if (sizeIndex !== -1) {
                            this.currentSize = sizeIndex;
                            this.updateDisplay();
                            this.savePreference();
                            this.showToast(`Font size: ${this.displayNames[this.currentSize]}`);
                        }
                    });
                });

                // Keyboard shortcuts
                document.addEventListener('keydown', (e) => {
                    if (e.ctrlKey) {
                        if (e.key === '+' || e.key === '=') {
                            e.preventDefault();
                            this.changeSize(1);
                        } else if (e.key === '-' || e.key === '_') {
                            e.preventDefault();
                            this.changeSize(-1);
                        }
                    }
                });

                // Touch events for mobile
                let touchStartX = 0;
                let touchEndX = 0;

                const bookContent = document.getElementById('bookContent');
                if (bookContent) {
                    bookContent.addEventListener('touchstart', (e) => {
                        touchStartX = e.changedTouches[0].screenX;
                    });

                    bookContent.addEventListener('touchend', (e) => {
                        touchEndX = e.changedTouches[0].screenX;
                        this.handleSwipe(touchStartX, touchEndX);
                    });
                }
            }

            handleSwipe(startX, endX) {
                const swipeThreshold = 50;
                const swipeDistance = endX - startX;

                if (Math.abs(swipeDistance) > swipeThreshold) {
                    if (swipeDistance > 0 && {{ $page }} > 1) {
                        // Swipe right - previous page
                        document.getElementById('prevPage')?.click();
                    } else if (swipeDistance < 0 && {{ $page }} < {{ $totalPages }}) {
                        // Swipe left - next page
                        document.getElementById('nextPage')?.click();
                    }
                }
            }

            changeSize(delta) {
                const newSize = this.currentSize + delta;
                if (newSize >= 0 && newSize < this.sizes.length) {
                    this.currentSize = newSize;
                    this.updateDisplay();
                    this.savePreference();
                    this.showToast(`Font size: ${this.displayNames[this.currentSize]}`);
                }
            }

            updateDisplay() {
                document.body.className = `font-${this.sizes[this.currentSize]}`;

                document.querySelectorAll('.font-option').forEach((option, index) => {
                    option.classList.toggle('active', index === this.currentSize);
                });

                document.getElementById('fontSizeDisplay').textContent = this.displayNames[this.currentSize];

                document.getElementById('fontDecrease').disabled = this.currentSize === 0;
                document.getElementById('fontIncrease').disabled = this.currentSize === this.sizes.length - 1;

                // Announce change for screen readers
                this.speakToScreenReader(`Font size changed to ${this.displayNames[this.currentSize]}`);
            }

            savePreference() {
                localStorage.setItem('readerFontSize', this.currentSize);
            }

            loadPreference() {
                const savedSize = localStorage.getItem('readerFontSize');
                if (savedSize !== null) {
                    this.currentSize = parseInt(savedSize);
                }
            }

            showToast(message, type = 'info') {
                const toast = document.getElementById('toast');
                toast.className = `toast toast-${type} show`;
                toast.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                `;

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 2000);
            }

            speakToScreenReader(message) {
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.setAttribute('aria-atomic', 'true');
                announcement.className = 'sr-only';
                announcement.textContent = message;
                document.body.appendChild(announcement);
                setTimeout(() => announcement.remove(), 1000);
            }
        }

        // Scroll Down Arrow Controller
        class ScrollDownArrow {
            constructor() {
                this.arrow = document.getElementById('scrollDownArrow');
                this.bookContent = document.getElementById('bookContent');
                this.init();
            }

            init() {
                if (!this.arrow || !this.bookContent) return;

                // Show/hide arrow based on scroll position
                this.bookContent.addEventListener('scroll', () => this.checkScrollPosition());

                // Arrow click event
                this.arrow.addEventListener('click', () => this.scrollDown());

                // Initial check
                this.checkScrollPosition();

                // Hide on desktop
                if (window.innerWidth >= 768) {
                    this.arrow.style.display = 'none';
                }
            }

            checkScrollPosition() {
                const scrollTop = this.bookContent.scrollTop;
                const scrollHeight = this.bookContent.scrollHeight;
                const clientHeight = this.bookContent.clientHeight;

                // Show arrow if not at bottom
                if (scrollHeight - scrollTop - clientHeight > 100) {
                    this.arrow.classList.add('visible');
                } else {
                    this.arrow.classList.remove('visible');
                }
            }

            scrollDown() {
                const currentScroll = this.bookContent.scrollTop;
                const scrollAmount = this.bookContent.clientHeight * 0.8;

                this.bookContent.scrollTo({
                    top: currentScroll + scrollAmount,
                    behavior: 'smooth'
                });

                if (navigator.vibrate) {
                    navigator.vibrate(50);
                }
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize font control
            window.fontControl = new FontSizeControl();

            // Initialize scroll down arrow
            window.scrollArrow = new ScrollDownArrow();

            // Save reading progress
            saveReadingProgress();

            // Update progress elements
            updateProgressElements();

            // Setup keyboard navigation
            setupKeyboardNavigation();

            // Handle orientation changes
            setupOrientationHandler();

            // Setup mobile gesture hints
            setupGestureHints();
        });

        function saveReadingProgress() {
            const bookId = {{ $book->id }};
            const currentPage = {{ $page }};
            const totalPages = {{ $totalPages }};

            const readingProgress = JSON.parse(localStorage.getItem('readingProgress') || '{}');
            readingProgress[bookId] = {
                page: currentPage,
                timestamp: new Date().toISOString(),
                bookTitle: "{{ addslashes($book->title) }}"
            };
            localStorage.setItem('readingProgress', JSON.stringify(readingProgress));
        }

        function updateProgressElements() {
            const currentPage = {{ $page }};
            const totalPages = {{ $totalPages }};
            const progress = (currentPage / totalPages) * 100;

            // progress bar
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');

            if (progressBar) {
                progressBar.style.width = `${progress}%`;
            }

            if (progressText) {
                progressText.textContent = `${currentPage} / ${totalPages}`;
            }

            // page progress text
            const pageProgress = document.getElementById('pageProgress');
            if (pageProgress) {
                pageProgress.textContent = `${Math.round(progress)}% complete`;
            }

            // current page in indicator
            const currentPageElement = document.getElementById('currentPage');
            if (currentPageElement) {
                currentPageElement.textContent = currentPage;
            }
        }

        function setupKeyboardNavigation() {
            document.addEventListener('keydown', function(e) {
                // Previous page (Left arrow)
                if (e.key === 'ArrowLeft' && {{ $page }} > 1 &&
                    !e.target.matches('input, textarea, button')) {
                    e.preventDefault();
                    document.getElementById('prevPage')?.click();
                }

                // Next page (Right arrow or Space)
                if ((e.key === 'ArrowRight' || e.key === ' ') &&
                    {{ $page }} < {{ $totalPages }} &&
                    !e.target.matches('input, textarea, button')) {
                    e.preventDefault();
                    document.getElementById('nextPage')?.click();
                }

                // Scroll down with down arrow
                if (e.key === 'ArrowDown' && window.scrollArrow) {
                    e.preventDefault();
                    window.scrollArrow.scrollDown();
                }
            });
        }

        function setupOrientationHandler() {
            window.addEventListener('orientationchange', function() {
                setTimeout(() => {
                    const bookContent = document.getElementById('bookContent');
                    if (bookContent) {
                        bookContent.scrollTop = 0;
                    }
                }, 100);
            });
        }

        function setupGestureHints() {
            // Only show on mobile
            if (window.innerWidth < 768) {
                // Show swipe hint on first visit
                const swipeHintShown = localStorage.getItem('swipeHintShown');
                if (!swipeHintShown) {
                    setTimeout(() => {
                        if (window.fontControl) {
                            window.fontControl.showToast('💡 Swipe left/right to navigate pages', 'info');
                            localStorage.setItem('swipeHintShown', 'true');
                        }
                    }, 2000);
                }
            }
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            // Hide scroll arrow on desktop
            const scrollArrow = document.getElementById('scrollDownArrow');
            if (scrollArrow) {
                if (window.innerWidth >= 768) {
                    scrollArrow.style.display = 'none';
                } else {
                    scrollArrow.style.display = 'flex';
                }
            }
        });

        // CSS for screen reader
        const srOnlyStyle = document.createElement('style');
        srOnlyStyle.textContent = `
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
        `;
        document.head.appendChild(srOnlyStyle);
    </script>
</body>
</html>
