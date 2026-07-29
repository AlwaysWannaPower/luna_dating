@props(['for'])

<label {{ $attributes->merge(['for' => $for, 'class' => "block font-medium text-sm text-text-primary dark:text-dark-text"]) }}>
    {{ $slot }}
</label>
