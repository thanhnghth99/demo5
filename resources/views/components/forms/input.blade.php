<div class="mb-5">
    @if(!empty($label))
    <label for="{{ $name }}" class="mb-3 block text-xl font-medium text-[#07074D]">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ $value }}" {{ $attributes }} 
        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] 
        outline-none focus:border-[#6A64F1] focus:shadow-md"/>
    @error($name)
    <span class="text-base text-red-400">{{ $message }}</span>
    @enderror
</div>