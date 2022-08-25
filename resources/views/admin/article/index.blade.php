<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- component -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-print-none with-border mb-8">
                <a href="{{ route('article.create') }}"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('Add article') }}</a>

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
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-10">
                                <div class="flex items-center justify-center">
                                    ID
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-32">
                                <div class="flex items-center justify-center">
                                    Article name
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-24">
                                <div class="flex items-center justify-center">
                                    Author
                                </div>
                            </th>                            
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-32">
                                <div class="flex items-center justify-center">
                                    Image
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-24">
                                <div class="flex items-center justify-center">
                                    Status
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-32">
                                <div class="flex items-center justify-center">
                                    Created at
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-32">
                                <div class="flex items-center justify-center">
                                    Updated at
                                </div>
                            </th>
                            <th class="p-2 border-r cursor-pointer text-sl font-medium text-[#07074D] w-36">
                                <div class="flex items-center justify-center">
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        @if(Gate::check('article-owner', $article))
                        <tr class="bg-gray-20 text-center border-b text-base text-gray-600">
                            <td class="p-2 border-r">{{$article->id}}</td>
                            <td class="p-2 border-r">{{$article->name}}</td>
                            <td class="p-2 border-r">{{$article->authorInfo->name}}</td>
                            <td class="p-2 border-r flex items-center justify-center">
                                <img src="{{ asset('images/'.$article->image) }}" width=100px/>
                            </td>
                            <td class="p-2 border-r">
                                <?php
                                    if ($article['status'] == 0)
                                        echo "Disable";
                                    else
                                        echo "Enable";
                                ?>
                            </td>
                            <td class="p-2 border-r">{{$article->created_at}}</td>
                            <td class="p-2 border-r">{{$article->updated_at}}</td>
                            <td>
                                <form action="{{ route('article.destroy', $article->id) }}"
                                    method="POST">
                                        <a href="{{ route('article.edit', $article->id) }}"
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
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 ">
                    {{ $articles->links('vendor.pagination.tailwind') }}
                </div>
                <x-slot name="scripts">
                    <script>
                        $(document).ready(function () {
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
</x-app-layout>
