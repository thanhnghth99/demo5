<x-app-layout>
    @if(Gate::check('can_do', ['role read']))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- component -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-print-none with-border mb-8">
                @if(Gate::check('can_do', ['role create']))
                    <a href="{{ route('role.create') }}" 
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('Add role') }}</a>
                @endif

                <div class="mx-auto max-w-md float-right">
                    <form action="" class="relative mx-auto w-max">
                        <input type="search" name="search" 
                            class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-gray-400 focus:pl-16 focus:pr-4" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent stroke-gray-500 px-3.5 peer-focus:border-gray-400 peer-focus:stroke-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </div>
            </div>

            <div class="table w-full p-2">
                <div>
                    @include('message')
                    @yield('content')
                </div>

                <table class="w-full border" id="table">
                    <thead>
                        <tr class="bg-gray-200 border-b">
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Role name
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Status
                                </div>
                            </th>
                            @if(Gate::check('can_do', ['role edit', 'role delete']))
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Action
                                </div>
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr class="bg-gray-20 text-center border-b text-base text-gray-600">
                            <td class="p-2 border-r">{{$role->name}}</td>
                            <td class="p-2 border-r">
                                @if ($role['status'] == 0)
                                    Disable
                                @else
                                    Enable
                                @endif
                            </td>
                            @if(Gate::check('can_do', ['role edit', 'role delete']))
                            <td>
                                <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                    @if(Gate::check('can_do', ['role edit']))
                                        <a href="{{ route('role.edit', $role->id) }}" 
                                            class="bg-blue-500 p-2 text-white hover:shadow-lg text-base font-medium rounded-lg mr-4">
                                            {{ __('Edit') }}
                                        </a>
                                    @endif

                                    @if(Gate::check('can_do', ['role delete']))
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 p-2 text-white hover:shadow-lg text-base font-medium rounded-lg" onclick="return confirm('Confirm to delete?')">
                                            {{ __('Delete') }}
                                        </button>
                                    @endif
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 ">
                    {{ $roles->links('vendor.pagination.tailwind') }}
                </div>
                <x-slot name="scripts">
                    <script>
                        $(document).ready(function() {
                            $('#table').DataTable({
                                "pagingType": "input",
                                paging: false,
                                info: false,
                                "searching": false,
                            });
                        });
                    </script>
                </x-slot>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>