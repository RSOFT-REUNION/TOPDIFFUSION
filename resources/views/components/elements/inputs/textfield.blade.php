<div class="textfield {{ $class }}">
    <label for="{{ $name }}">{{ $label }}@if($require) <span class="text-red-500">*</span> @endif</label>
    @if($type != 'textarea')
        <input type="{{ $type }}" @if($livewire) wire:model.live="{{ $name }}" @endif @if($type == 'number') step="0.01" @endif name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}">
    @else
        <textarea @if($livewire) wire:model.live="{{ $name }}" @endif rows="5" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"></textarea>
    @endif
    @error($name)
        <p>{{ $message }}</p>
    @enderror
</div>
