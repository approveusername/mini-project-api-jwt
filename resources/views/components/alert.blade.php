<!-- By variable:
<div class="alert alert-{{ $type }}" role="alert">
    {{ $message }}
</div> -->

<!-- add dynamic class -->
<!-- <div {{ $attributes->merge(['class' => 'alert alert-'.$valid_type, 'role' => 'alert']) }}>
    {{ $message }}
</div> --> 

<!-- add conditional dynamic class -->
{{-- <div {{ $attributes->class(['alert alert-success alert-dismissible' => $dismiss])->merge(
        ['class' => 'alert alert-'.$valid_type, 
        'role' => $attributes->prepends('alert')
        ]) }}
>
    {{ $message }} 
    @if ($dismiss)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div> --}}

<!-- slot -->
 <!-- where $attributes (first) is non used attributes/data in class and its directly render from views -->
<div {{ $attributes}} {{ $attributes->class(['alert alert-success alert-dismissible', 'bg-red' => $dismiss])->merge(
        ['class' => 'alert alert-'.$valid_type, 
        'role' => $attributes->prepends('alert'), 
        'user-id' => $userId
        ]) }}>

    @if ($slot->isEmpty())
        This is default content if the slot is empty.
    @else
        {{ $slot }}
    @endif
    
    @isset($title)
        <h6 class="alert-heading">{{ $title }}</h6>
    @endisset
    <hr>

    @isset($abc)
    <span class="alert-title">{{ $abc }}</span>
    @endisset

    @if ($dismiss)
        <button type="button" data-user_id = "{{ $userId }}" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif


</div>
