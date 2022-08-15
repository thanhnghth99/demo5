<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="{{ route('article.update', $articles->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
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
                        value=" {{$articles->name}} "
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>

                <div class="mb-5">
                    <label
                        for="author"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Author
                    </label>
                    <input
                        type="text"
                        name="author"
                        id="author"
                        placeholder="Author"
                        value=" {{$articles->author}} "
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
                    <textarea
                        type="text"
                        name="content"
                        id="content"
                        placeholder="Content"
                        value=" {{$articles->content}} "
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md h-48">{{$articles->content}}</textarea>
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
                        value=" {{$articles->image}} "
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md cursor-pointer"
                    />
                    <p class="w-full text-base text-[#6B7280]" id="image">SVG, PNG, JPG or GIF</p>
                </div> 
                <div class="flex">
                    <div>
                        <label
                            for="name"
                            class="mb-3 block text-xl font-medium text-[#07074D]"
                            >
                            Article tags
                        </label>
                        <div style="margin: 10px 20px 20px 10px">
                            @foreach($tags as $tag)
                            <div style="margin: 10px 20px 10px 10px">
                                <input
                                    <?php
                                    foreach ($dataTags as $dataTag)
                                    {
                                        if ($tag->id == $dataTag->id)
                                            echo "checked";
                                    }
                                    ?>
                                    type="checkbox" class="rounded-md border border-[#e0e0e0] bg-white px-3 py-3" id="tag" name="tag[]" value="{{$tag->id}}"/>
                                <label for="tag" class="mb-3 text-xl font-medium text-[#07074D]">{{ $tag->name }}</label><br>
                            </div>
                            @endforeach
                        </div>
                        <div style="margin: 10px 20px 20px 10px">
                            <a href="{{ route('tag.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xl font-medium text-[#07074D]">+ Add tag</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Article status</label>
                    <select name="status" id="cars" style="height: 50px" value=" {{$articles->status}} "
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            <option
                            <?php
                                if ($articles->status == 1)
                                    echo "selected";
                            ?>
                            value="1">Enable</option>
                            <option
                            <?php
                                if ($articles->status == 0)
                                    echo "selected";
                            ?>
                            value="0">Disable
                        </option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('article.index') }}" role="button" style="float: left">
                        Back
                    </a>
                    <button class="hover:shadow-form rounded-md bg-[red] py-3 px-8 text-base font-semibold text-white outline-none text-right"
                        role="button" style="float: right">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
