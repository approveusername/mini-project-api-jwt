<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php $message = "test message"; $card = 'card'?>

    {{-- <x-alert type="success" message="{{ $message }}" :$userId/>
    OR
    <x-alert type="success" :message="$message" :user-id="$userId"/>
    OR
    <x-alert type="success" :$message user-id="{{ $userId }}"/> 

    <x-alert type="success" id="firstAlert" role="flash" class="m-4 p-4" :$message/> 
    <x-alert type="info" dismiss message="info"/>
    <x-alert type="dange" message="danger"/> --}}

    <x-alert type="danger" dismiss is-data="data_check">
        <!-- it can be name="title" -->
        <x-slot:title> 
            Heading Goes here
            <br>
            {{ $component->formatAlert('Call formatAlert function of alert class') }}
        </x-slot>
        <!-- the line below is slot content can be access in component/alert.blade.php with $slot inside curly braces -->
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.ptatum?</p>
        <x-slot:abc>
            slot with name abc
        </x-slot>
    </x-alert>

    
    <!-- <x-card class="shadow-sm">
        <x-slot:heading class="font-bold">
            The slot heading for card component
        </x-slot>    
        The slot content for card component
        <x-slot:footer class="text-sm">
            The slot footer for card component
        </x-slot>
    </x-card> -->

    <!-- or dynamically (component name) -->
    <x-dynamic-component :component="$card" class="mt-4">
        <x-slot:heading class="font-bold">
            The slot heading for card component
        </x-slot>    
            The slot content for card component
        <x-slot:footer class="text-sm">
            The slot footer for card component
        </x-slot>
    </x-dynamic-component>

</body>
</html>