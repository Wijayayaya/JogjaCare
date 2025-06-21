@extends('frontend.layouts.app')

@section('title')
    {{ __('Partnership') }}
@endsection

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
             <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/9.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/1.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">Medical Journey</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">{{ __('Visit Page') }}</button>
                    </div>
                </div>  
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/10.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/2.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">HealtyU</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/11.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/3.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">Come Visit</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/12.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/4.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">Health Nav</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/13.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/5.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">TripTreve</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/14.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/6.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">HappyCare</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/15.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/7.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">VitaLife</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div class="relative h-64">
                        <img alt="content" class="object-cover object-center h-full w-full transition-opacity duration-300 ease-in-out" src="{{ asset('img/Partner/16.png') }}">
                        <img alt="content" class="object-cover object-center h-full w-full absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100" src="{{ asset('img/Partner/8.png') }}">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="title-font text-2xl font-medium text-gray-900 dark:text-white mb-3">Rich Wellness</h2>
                        <p class="leading-relaxed text-base text-gray-700 dark:text-gray-400 mb-6">Williamsburg occupy sustainable snackwave gochujang. Pinterest cornhole brunch, slow-carb neutra irony.</p>
                        <button class="mt-auto text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded">    {{ __('Visit Page') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
