<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto w-16 h-16 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg mb-4">
            <span class="text-white text-2xl font-bold">JS</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-800">
            Data-Driven Predatory Journal Screening System
        </h1>

        <p class="text-sm text-gray-500 mt-2">
            Login to evaluate journal credibility, detect predatory journals,
            and generate trust scoring analysis
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email Address" />
            <x-text-input id="email"
                class="block mt-2 w-full rounded-xl"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password"
                class="block mt-2 w-full rounded-xl"
                type="password"
                name="password"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline"
                   href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center rounded-xl bg-indigo-600 hover:bg-indigo-700 py-3">
            Login
        </x-primary-button>
    </form>
</x-guest-layout>