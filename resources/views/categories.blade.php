<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white pb-4 px-4 rounded-md w-full" >
                        <div class="flex justify-between w-full pt-6 ">
                            <p class="ml-3"> Categories Table</p>
                            <svg width="14" height="4" viewBox="0 0 14 4" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.4">
                                    <circle cx="2.19796" cy="1.80139" r="1.38611" fill="#222222" />
                                    <circle cx="11.9013" cy="1.80115" r="1.38611" fill="#222222" />
                                    <circle cx="7.04991" cy="1.80115" r="1.38611" fill="#222222" />
                                </g>
                            </svg>

                        </div>
                       
                        @livewire('categories')
                    </div>

                    <style>
                        thead tr th:first-child {
                            border-top-left-radius: 10px;
                            border-bottom-left-radius: 10px;
                        }

                        thead tr th:last-child {
                            border-top-right-radius: 10px;
                            border-bottom-right-radius: 10px;
                        }

                        tbody tr td:first-child {
                            border-top-left-radius: 5px;
                            border-bottom-left-radius: 0px;
                        }

                        tbody tr td:last-child {
                            border-top-right-radius: 5px;
                            border-bottom-right-radius: 0px;
                        }

                    </style>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>