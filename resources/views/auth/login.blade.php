<x-guest-layout>
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-blue-700 transition hover:text-blue-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <div class="mb-6">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-700">Selamat datang kembali</p>
        <h2 class="mt-2 text-3xl font-black text-slate-800">Masuk ke akun Anda</h2>
        <p class="mt-2 text-sm text-slate-500">Lanjutkan perjalanan booking tiketmu dengan pengalaman yang lebih cepat dan aman.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-900 shadow-sm focus:ring-blue-900" name="remember">
                <span class="ms-2 text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="font-medium text-blue-700 transition hover:text-blue-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6 flex items-center justify-between gap-3">
            <a class="text-sm font-medium text-slate-500 transition hover:text-slate-700" href="{{ route('register') }}">
                Belum punya akun?
            </a>
            <x-primary-button class="rounded-full px-5 py-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
