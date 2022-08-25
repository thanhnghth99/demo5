<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="{{ route('role.update', $roles->id) }}" method="POST">
                @method('PUT')
                {{csrf_field()}}
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-xl font-medium text-[#07074D]"
                        >
                        Role name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Role name"
                        value="{{ $roles->name }}" 
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="flex">
                    <div>
                        <label
                            for="name"
                            class="mb-3 block text-xl font-medium text-[#07074D]"
                            >
                            Permissions
                        </label>
                        <div>
                            @foreach($permissions as $permission)
                            <div class="mt-2">
                                <input
                                    <?php
                                    foreach ($dataPermissions as $dataPermission)
                                    {
                                        if ($permission->id == $dataPermission->id)
                                            echo "checked";
                                    }
                                    ?>
                                type="checkbox" class="rounded-md border border-[#e0e0e0] bg-white px-2 py-2" id="permission" name="permission[]" value="{{$permission->id}}"/>
                                <label for="permission" class="mb-3 text-xm font-medium text-[#07074D]">{{ $permission->name }}</label><br>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2 mb-2">
                            <a href="{{ route('permission.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add permission</a>
                        </div>
                    </div>
                </div>                 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Role status</label>
                    <select name="status" id="cars" value="{{ $roles->status }}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option
                            <?php
                                if ($roles->status == 1)
                                    echo "selected";
                            ?>
                            value="1">Enable</option>
                            <option
                            <?php
                                if ($roles->status == 0)
                                    echo "selected";
                            ?>
                            value="0">Disable
                        </option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('role.index') }}" role="button" style="float: left">
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
