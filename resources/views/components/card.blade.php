<div>
    <div {{ $attributes->class(['border']) }}>
    <h5 {{ $heading->attributes->class(['text-lg']) }}>
        {{ $heading }}
    </h5>
 
    {{ $slot }}
 
    <footer {{ $footer->attributes->class(['text-gray-700']) }}>
        {{ $footer }}
    </footer>
</div>
</div>