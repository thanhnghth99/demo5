<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
       
    <div class="py-12">
        <!-- component -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-print-none with-border mb-8">
                <a href="{{ route('category.create') }}"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('Add category') }}</a>
            </div>

            <div class="table w-full p-2">
                <div>
                    @include('message')
                    @yield('content')
                </div>
                
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-200 border-b">
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Category name
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Status
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <!-- <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Created at
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </th>                            
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Updated at
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </th> -->
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D]">
                                <div class="flex items-center justify-center">
                                    Action
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr class="bg-gray-20 text-center border-b text-base text-gray-600">
                            <td class="p-2 border-r">{{$category->name}}</td>
                            <td class="p-2 border-r">
                                <?php
                                    if ($category['status'] == 0)
                                        echo "Disable";
                                    else
                                        echo "Enable";
                                ?>
                            </td>
                            <!-- <td class="p-2 border-r">{{$category['created_at']}}</td>
                            <td class="p-2 border-r">{{$category['updated_at']}}</td> -->
                            <td>
                                <form action="{{ route('category.destroy', $category->id) }}"
                                    method="POST">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="bg-blue-500 p-2 text-white hover:shadow-lg text-base font-medium rounded-lg mr-4">
                                            {{ __('Edit') }}
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 p-2 text-white hover:shadow-lg text-base font-medium rounded-lg"
                                            onclick="return confirm('Confirm to delete?')">
                                            {{ __('Delete') }}
                                        </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 ">
                    {{ $categories->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
