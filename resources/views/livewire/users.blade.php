<div x-data="{ modalForm: @entangle('showModal'),alert:@entangle('showAlert') }">
    @can('adminFunction',App\Models\User::class)
        @include('livewire.users.modal',['title'=>'users'])
        <x-alert :title="__('Delete your data!')"/>
    @endcan
    
    <x-success-message />
    <div class="overflow-x-auto mt-6">
        <div class="w-full flex px-2 my-2">
            @can('adminFunction',App\Models\User::class)
            <button wire:click="openModal(true)"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Add</button>
            @endcan
            <div class="w-full"></div>
            <div class="w-full sm:w-64 inline-block relative float-right">

                <input type="search" name="search" wire:model="searchParam"
                    class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-8 rounded-lg"
                    placeholder="Search" />

                <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">

                    <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999">
                        <path
                            d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z" />
                    </svg>
                </div>
            </div>
        </div>
        <table class="table-auto border-collapse w-full">
            <thead>
                <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                    <th  wire:click="sort('name')" class="px-4 py-2 bg-gray-200" style="background-color:#f8f8f8">
                        <div class="flex flex-row">
                        Name @include('livewire.components.sort',['column'=>'name'])
                        </div>
                    </th>
                    <th  wire:click="sort('username')" class="px-4 py-2" style="background-color:#f8f8f8">
                        <div class="flex flex-row">
                        Username @include('livewire.components.sort',['column'=>'username'])
                        </div>
                    </th>
                    <th  wire:click="sort('email')" class="px-4 py-2" style="background-color:#f8f8f8">
                        <div class="flex flex-row">
                        Email @include('livewire.components.sort',['column'=>'email'])
                        </div>
                    </th>
                    <th  wire:click="sort('level_id')" class="px-4 py-2" style="background-color:#f8f8f8">
                        <div class="flex flex-row">
                        Level @include('livewire.components.sort',['column'=>'level_id'])
                        </div>
                    </th>
                    @can('adminFunction',App\Models\User::class)
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">Action</th>
                    @endcan
                    
                </tr>
            </thead>
            <tbody class="text-sm font-normal text-gray-700">
                @foreach ($data as $item)
                    <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                        <td class="px-4 py-4">{{ $item->name }} </td>
                        <td class="px-4 py-4">{{ $item->username }}</td> 
                        <td class="px-4 py-4">{{ $item->email }}</td> 
                        <td class="px-4 py-4">{{ $item->user_level->name }}</td> 
                        @if (Auth::user()->can('adminFunction', App\Models\User::class))
                        <td class="px-4 py-4 flex space-x-4"> 
                            <a href="#" wire:click.prevent="edit({{ $item->id }})" class="text-yellow-400">Edit</a>
                            <a href="#" wire:click.prevent="delete({{ $item->id }})" class="text-red-500">Delete</a>
                        </td> 
                        @endif
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <div id="pagination" class="w-full mt-4">

        {{ $data->links() }}

    </div>
</div>
