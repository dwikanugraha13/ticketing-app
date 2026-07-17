<!DOCTYPE html>
<html lang="id" data-theme="winter">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="BengTix — Platform tiket event modern. Temukan konser, seminar, dan workshop favoritmu. Booking cepat, aman, dan elegan.">
  <title>{{ $title ?? 'BengTix — Beli Tiket, Auto Asik' }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- DaisyUI -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <x-navbar />

  <main>
    {{ $slot }}
  </main>

  <x-footer />

  @if(session('success') || session('error') || session('info'))
    <div id="flash-toast" class="toast-modern" role="alert" aria-live="polite">
      @if(session('success'))
        <div class="toast-item toast-success">
          <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif
      @if(session('error'))
        <div class="toast-item toast-error">
          <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
          <span>{{ session('error') }}</span>
        </div>
      @endif
      @if(session('info'))
        <div class="toast-item toast-info">
          <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>{{ session('info') }}</span>
        </div>
      @endif
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const t = document.getElementById('flash-toast');
        if (!t) return;
        setTimeout(() => {
          t.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
          t.style.opacity = '0';
          t.style.transform = 'translateX(20px)';
          setTimeout(() => t.remove(), 450);
        }, 4500);
      });
    </script>
  @endif

  <script>
    // Navbar scroll effect
    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.querySelector('.bengtix-navbar');
      if (!navbar) return;
      const handler = () => navbar.classList.toggle('navbar-scrolled', window.scrollY > 40);
      window.addEventListener('scroll', handler, { passive: true });
      handler();
    });
  </script>
</body>

</html>