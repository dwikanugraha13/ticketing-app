<x-app-layout>
    <div class="min-h-[70vh] bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.10),_transparent_35%),linear-gradient(180deg,_#f8fbff_0%,_#eef5ff_100%)] py-10">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-700 transition hover:text-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>

            <!-- Profile hero -->
            <div class="relative overflow-hidden rounded-[28px] p-6 text-white shadow-[0_20px_60px_-30px_rgba(37,99,235,0.45)] sm:p-8"
                 style="background: radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 35%), linear-gradient(135deg, #0f172a 0%, #1d4ed8 45%, #2563eb 100%);">
                <div class="flex flex-col items-start gap-5 sm:flex-row sm:items-center">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-3xl bg-white/12 text-2xl font-bold shadow-inner shadow-black/10 ring-1 ring-white/20">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/60">Profil Saya</p>
                        <h1 class="mt-1 truncate text-2xl font-bold sm:text-3xl">{{ auth()->user()->name }}</h1>
                        <p class="mt-1 truncate text-sm text-white/75">{{ auth()->user()->email }}</p>
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && auth()->user()->hasVerifiedEmail())
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-300 ring-1 ring-emerald-400/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Email terverifikasi
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-400/15 px-3 py-1 text-xs font-semibold text-amber-300 ring-1 ring-amber-400/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.999 3.75h.008v.008h-.008v-.008z"/></svg>
                                    Email belum diverifikasi
                                </span>
                            @endif
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white/80 ring-1 ring-white/15">
                                Bergabung {{ auth()->user()->created_at?->translatedFormat('F Y') ?? '—' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Akun -->
            <div class="overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-[0_20px_60px_-32px_rgba(15,23,42,0.35)]">
                <div class="flex items-start gap-3 border-b border-slate-100 bg-slate-50/60 px-6 py-5 sm:px-8">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-800">Informasi Akun</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Perbarui nama dan alamat email akun kamu.</p>
                    </div>
                </div>
                <div class="px-6 py-6 sm:px-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Keamanan -->
            <div class="overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-[0_20px_60px_-32px_rgba(15,23,42,0.35)]">
                <div class="flex items-start gap-3 border-b border-slate-100 bg-slate-50/60 px-6 py-5 sm:px-8">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-800">Keamanan</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Gunakan kata sandi yang panjang dan acak agar akun tetap aman.</p>
                    </div>
                </div>
                <div class="px-6 py-6 sm:px-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Zona Bahaya -->
            <div class="overflow-hidden rounded-[24px] border border-rose-200 bg-white shadow-[0_20px_60px_-32px_rgba(225,29,72,0.25)]">
                <div class="flex items-start gap-3 border-b border-rose-100 bg-rose-50/60 px-6 py-5 sm:px-8">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-rose-700">Zona Bahaya</h2>
                        <p class="mt-0.5 text-sm text-rose-500/90">Tindakan berikut bersifat permanen dan tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <div class="px-6 py-6 sm:px-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
