<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') &middot; BengTix</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.12),_transparent_35%),linear-gradient(180deg,_#f8fbff_0%,_#eef5ff_100%)] text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <aside class="flex w-64 shrink-0 flex-col border-r border-white/10 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.18),_transparent_30%),linear-gradient(135deg,_#0f172a_0%,_#1d4ed8_45%,_#2563eb_100%)] text-white shadow-[18px_0_60px_-35px_rgba(2,6,23,0.75)]">
            <div class="border-b border-white/10 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 shadow-lg shadow-black/20">
                        <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-8 w-8">
                    </div>
                    <div>
                        <p class="text-lg font-semibold leading-tight">BengTix</p>
                        <p class="text-xs uppercase tracking-[0.24em] text-white/50">Admin Center</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 space-y-1 px-3 py-4">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 rounded-2xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-white text-slate-950 shadow-lg shadow-black/10' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('dashboard') ? 'bg-slate-100 text-slate-900' : 'bg-white/10 text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" /></svg>
                    </span>
                    Dashboard
                </a>

                <a href="{{ route('categories.index') }}"
                   class="flex items-center gap-3 rounded-2xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('categories.*') ? 'bg-white text-slate-950 shadow-lg shadow-black/10' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('categories.*') ? 'bg-slate-100 text-slate-900' : 'bg-white/10 text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" /></svg>
                    </span>
                    Manajemen Kategori
                </a>

                <a href="{{ route('admin.events.index') }}"
                   class="flex items-center gap-3 rounded-2xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.events.*') ? 'bg-white text-slate-950 shadow-lg shadow-black/10' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.events.*') ? 'bg-slate-100 text-slate-900' : 'bg-white/10 text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </span>
                    Manajemen Event
                </a>
            </nav>

            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 p-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-sm font-semibold">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold">{{ auth()->user()?->name }}</p>
                        <div class="mt-1 flex items-center gap-2 text-xs text-white/60">
                            <a href="{{ route('profile.edit') }}" class="hover:text-white">Profile</a>
                            <span>&middot;</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="hover:text-white">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/95 backdrop-blur-2xl">
                <div class="flex flex-col gap-3 px-5 py-3 lg:flex-row lg:items-center lg:justify-between lg:px-7">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Control Panel</p>
                        <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-900">@yield('title', 'Dashboard')</h1>
                    </div>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-blue-200 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Home
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto">
                <div class="mx-auto max-w-7xl px-5 py-5">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @if(session('success'))
        <div id="successToast" class="fixed right-4 top-4 z-50 flex items-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-white shadow-xl shadow-emerald-900/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('successToast');
                if (toast) {
                    toast.style.opacity = '0';
                    toast.style.transition = 'opacity 0.3s';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 3000);
        </script>
    @endif
</body>
</html>
