<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[1000px]">
            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Article name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Article name"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="content"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Content
                    </label>
                    <textarea name="content" id="content"></textarea>
                </div>
                <div class="mb-5">
                    <label
                        for="image"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Image
                    </label>
                    <input
                        type="file"
                        multiple
                        name="image"
                        id="image"
                        placeholder="Image"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md cursor-pointer"
                    />
                    <p class="w-full text-base text-[#6B7280]" id="image">SVG, PNG, JPG or GIF</p>
                </div>
                <div class="mb-5">
                    <div>
                        <label
                            for="name"
                            class="mb-3 block text-xl font-medium text-[#07074D]"
                            >
                            Categories
                        </label>
                        <div>
                            @foreach($categories as $category)
                            <div class="mt-2">
                                <input type="checkbox" class="rounded-md border border-[#e0e0e0] bg-white px-2 py-2" id="category" name="category[]" value="{{$category->id}}"/>
                                <label for="category" class="mb-3 text-xm font-medium text-[#07074D]">{{ $category->name }}</label><br>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('category.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add category</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <div>
                        <label
                            for="name"
                            class="mb-3 block text-xl font-medium text-[#07074D]"
                            >
                            Tags
                        </label>
                        <div>
                            @foreach($tags as $tag)
                            <div class="mt-2">
                                <input type="checkbox" class="rounded-md border border-[#e0e0e0] bg-white px-2 py-2" id="tag" name="tag[]" value="{{$tag->id}}"/>
                                <label for="tag" class="mb-3 text-xm font-medium text-[#07074D]">{{ $tag->name }}</label><br>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('tag.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add tag</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Article status</label>
                    <select name="status" id="cars" style="height: 50px"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('article.index') }}" role="button" style="float: left">
                        Back
                    </a>
                    <button class="hover:shadow-form rounded-md bg-[red] py-3 px-8 text-base font-semibold text-white outline-none text-right"
                        role="button" style="float: right">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    // height: '400px'
                })
                .then( editor => {
                    editor.ui.view.editable.element.style.height = '500px';
                } )
                .catch(error => {
                    console.error(error);
                });
        </script>
    </x-slot>
</x-app-layout>
