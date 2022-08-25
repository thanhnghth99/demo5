@foreach ($items as $item)
<div class="mt-2">
    <input type="checkbox" name="{{ $name }}" id="{{ $id . $item->id }}" value="{{ $item->id }}" {{ $attributes }}
        class="rounded-md border border-[#e0e0e0] bg-white px-2 py-2"
        @if(in_array($item->id, $selected)) checked @endif
    >
    <label for="{{ $id }}" class="mb-3 text-xm font-medium text-[#07074D]">{{ $item->name }}</label><br>
</div>
@endforeach 