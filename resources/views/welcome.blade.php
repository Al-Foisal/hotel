@extends('layouts.master')

@section('css')

<style>

    .welcome-box {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    h1 {
        color: #2c3e50;
    }

    p {
        font-size: 1.1em;
    }
</style>
@endsection
@section('content')

<div class="welcome-box mt-2">
    <h1>Welcome, {{ $user->name }}!</h1>
    <p>Glad to have you back, {{ $user->email }}.</p>
</div>

</html>

@endsection