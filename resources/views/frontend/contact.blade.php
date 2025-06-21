@extends('frontend.layouts.app')

@section('title')
    {{ __('Contact') }}
@endsection

@section('content')
    <section class="text-gray-600 body-font relative">
        <div class="absolute inset-0 bg-gray-300">
            <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no"
                src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=Universitas+'Aisyiyah+Yogyakarta,+Jl.+Siliwangi+No.63,+Area+Sawah,+Nogotirto,+Kec.+Gamping,+Kabupaten+Sleman,+Daerah+Istimewa+Yogyakarta+55292&ie=UTF8&t=&z=14&iwloc=B&output=embed"
                style="filter: grayscale(0.4) contrast(1.2) opacity(0.8);"></iframe>
        </div>
        <div class="container px-8 py-24 mx-auto flex">
            <div
                class="lg:w-1/3 md:w-1/2 bg-white dark:bg-gray-800 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
                <h3 class="text-gray-900 dark:text-white text-lg mb-3 title-font sm:text-3xl text-2xl">
                    {{ __('We are here to help!') }}
                </h3>
                <p class="leading-relaxed mb-5 text-gray-600 dark:text-gray-300">
                    {{ __("Let us know how we can best serve you. Use the contact form to email us or select from the topics below that best fit your needs. It's an honor to support you in your journey towards better health.") }}
                </p>
                <form method="POST" action="{{ route('frontend.contact.send') }}">
                    @csrf
                    <div class="relative mb-4">
                        <label for="name"
                            class="leading-7 text-sm text-gray-600 dark:text-gray-300">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name"
                            class="w-full bg-white dark:bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            required>
                    </div>
                    <div class="relative mb-4">
                        <label for="email"
                            class="leading-7 text-sm text-gray-600 dark:text-gray-300">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email"
                            class="w-full bg-white dark:bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            required>
                    </div>
                    <div class="relative mb-4">
                        <label for="phone"
                            class="leading-7 text-sm text-gray-600 dark:text-gray-300">{{ __('Number Phone') }}</label>
                        <input type="tel" id="phone" name="phone"
                            class="w-full bg-white dark:bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="message"
                            class="leading-7 text-sm text-gray-600 dark:text-gray-300">{{ __('Message') }}</label>
                        <textarea id="message" name="message"
                            class="w-full bg-white dark:bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                            required></textarea>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 rounded text-lg">
                        {{ __('Send Message') }}
                    </button>
                    <p class="text-xs text-gray-500 dark:text-gray-300 mt-3">
                        {{ __('This site is protected by the reCAPTCHA and Google Privacy Policy and Terms of Service apply.') }}
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
