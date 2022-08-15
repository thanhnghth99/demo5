<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tag') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="{{ route('tag.update', $tags->id) }}" method="POST">
                @method('PUT')
                {{csrf_field()}}
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Tag name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="tag name"
                        value="{{ $tags->name }}" 
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                
                <div class="flex">
                    <div>
                        <label
                            for="name"
                            class="mb-3 block text-xl font-medium text-[#07074D]"
                            >
                            Tags
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Tag status</label>
                    <select name="status" id="cars" style="height: 50px" value="{{ $tags->status }}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option
                            <?php
                                if ($tags->status == 1)
                                    echo "selected";
                            ?>
                            value="1">Enable</option>
                            <option
                            <?php
                                if ($tags->status == 0)
                                    echo "selected";
                            ?>
                            value="0">Disable
                        </option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('tag.index') }}" role="button" style="float: left">
                        Back
                    </a>
                    <button class="hover:shadow-form rounded-md bg-[red] py-3 px-8 text-base font-semibold text-white outline-none text-right"
                        role="button" style="float: right">
                        Save edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
