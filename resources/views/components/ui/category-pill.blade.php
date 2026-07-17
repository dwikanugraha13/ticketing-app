@props([
    'label',
    'active' => false,
])

<span {{ $attributes->merge(['class' => $active ? 'category-pill category-pill--active' : 'category-pill']) }}>
  {{ $label }}
</span>
