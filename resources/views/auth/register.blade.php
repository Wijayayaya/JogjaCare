<x-guest-layout>
    <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">{{ __('Create an Account') }}</h1>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-user"></i>
                </span> 
                <x-text-input id="name" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200" 
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span> 
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200" 
                    type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="password" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Password must be at least 8 characters and contain letters and numbers</p>
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors duration-200"
                    type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-5">
            <div class="flex items-center">
                <input id="terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer">
                <label for="terms" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">
                    {{ __('I agree to the') }} <a href="#" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">{{ __('Terms of Service') }}</a> {{ __('and') }} <a href="#" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">{{ __('Privacy Policy') }}</a>
                </label>
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200 text-white font-medium rounded-lg">
                <i class="fas fa-user-plus mr-2"></i> {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Social Login Section -->
    <div class="mt-6 pt-5 border-t border-gray-200 dark:border-gray-700">
        <div class="text-center mb-4">
            <span class="px-2 bg-white dark:bg-gray-900 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Or sign up with') }}
            </span>
        </div>
        
        <div class="flex justify-center">
            <a href="{{ route('login.google') }}" class="flex items-center justify-center w-full py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                {{ __('Sign up with Google') }}
            </a>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-gray-600 dark:text-gray-400">{{ __('Already have an account?') }}
            <a class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium transition-colors duration-200" href="{{ route('login') }}">
                {{ __('Sign in') }}
            </a>
        </p>
    </div>
</x-guest-layout>
