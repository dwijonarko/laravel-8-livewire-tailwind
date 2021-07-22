<x-app-layout>
    <x-slot name="title">Profile : {{auth()->user()->name}}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <x-success-message  />
                    <form action="{{route('profile.update')}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{Auth::user()->name}}" autofocus/>
                                </div>

                                <div>
                                    <x-label for="username" :value="__('User Name')" />
                                    <x-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{Auth::user()->username}}" autofocus readonly/>
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{Auth::user()->email}}" />
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="new_password" :value="__('Password')" />
                                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="password" value="" autocomplete="new-password" />
                                </div>

                                <div>
                                    <x-label for="confirm_password" :value="__('Password Confirmation')" />
                                    <x-input id="confirm_password" class="block mt-1 w-full" type="password" name="password_confirmation" value="" autocomplete="newconfirm-password" />
                                </div>
                                @can('adminFunction',App\Models\User::class)
                                   <div>
                                    <x-label for="level_id" :value="__('User level')" />
                                    <x-select name="level_id" id="level_id" class="blck mt-1 w-full"   >
                                        @foreach ($levels as $key=>$value )
                                            <option value="{{$key}}" {{ $key == Auth::user()->level_id ? 'selected' : '' }} >{{$value}}</option>
                                        @endforeach
                                    </x-select>
                                </div> 
                                @endcan
                                

                               
                            </div>
                             <div>
                                    <x-button >
                                        {{ __('Update') }}
                                    </x-button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
