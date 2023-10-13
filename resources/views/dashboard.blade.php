<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pr-5">
                {{ __('Product Feedback') }}
            </h2>
            {{-- NAVIGATION  --}}
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('feedback/create') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('feedback.create') }}">Add Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('feedback') ? 'active' : '' }}"
                        href="{{ route('feedback.index') }}">Feedback List</a>
                </li>
            </ul>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @yield('body')
            </div>
        </div>
    </div>


</x-app-layout>
