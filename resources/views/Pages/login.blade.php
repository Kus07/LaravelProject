@include('templates.header')

<x-navbar />

@if(isset($registeredUsername) && $registeredUsername)
    <h2 class="text-center">Welcome {{ $registeredUsername }}</h2>
@else
    <h2 class="text-center">Login</h2>
    <!-- Login form -->
@endif

@include('templates.footer')