@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm alert alert-status']) }}>
        {{ $status }}
    </div>
@endif
