<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[1000px]">
            <form action="{{ route('article.update', $articles->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                {{csrf_field()}}
                <div>
                    <x-forms.input label="Article name" name="name" id="name" placeholder="Article name" value="{{ $articles->name }}" required/>
                </div>
                <div class="mb-5">
                    <label
                        for="content"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Content
                    </label>
                    <textarea name="content" id="content">{{ $articles->content }}</textarea>
                </div>
                <div class="mb-5">
                    <x-forms.input label="Image" name="image" id="image" type="file" multiple value="{{ $articles->image }}"/>
                    <p class="w-full text-base text-[#6B7280]" id="image">SVG, PNG, JPG or GIF</p>
                    <img id="img-preview" class="w-24">
                </div>
                <div class="mb-5">
                    <div>
                        <label
                            for="name"
                            class="mb-3 block text-xl font-medium text-[#07074D]"
                            >
                            Categories
                        </label>
                        <x-forms.checkbox-list id="category" name="category[]" :items="$categories" :selected="$dataCategories"/>
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
                            <x-forms.checkbox-list id="tag" name="tag[]" :items="$tags" :selected="$dataTags"/>
                        <div class="mt-2">
                            <a href="{{ route('tag.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add tag</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Article status</label>
                    <select name="status" id="cars" value=" {{$articles->status}} "
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
    <x-slot name="scripts">
        <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
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

                $('input[name="image"]').on('change', function() {
                    $('#img-preview').attr('src', '');
                    const file = this.files[0];
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        $('#img-preview').attr('src', reader.result);
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    }
                })
        </script>
    </x-slot>
</x-app-layout>
