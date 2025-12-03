@include('layouts.welcome')
<style>
    .location-button {
        background-color: #4CAF50; /* Green */
        color: white;
        text-decoration: none; /* Remove underline from link */
        border-radius: 50%; /* Make it circular */
        display: inline-flex; /* Align items within the anchor */
        align-items: center; /* Center vertically */
        justify-content: center; /* Center horizontally */
        width: 50px; /* Set the width to be the same as the icon */
        height: 50px; /* Set height to make it a perfect circle */
        transition: background-color 0.3s;
    }

    .location-button:hover {
        background-color: #45a049; /* Darker green on hover */
    }
</style>

<div class="col-md-12 flex-center position-ref full-height d-flex justify-content-center align-items-center responsive">
    @if (Route::has('login'))
        <div class="top-right links color-white">
            @auth
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ url('/admin') }}">{{ Auth::user()->name }}</a>
                @elseif (Auth::user()->hasRole('employee'))
                    <a href="{{ url('/employee') }}">{{ Auth::user()->name }}</a>
                @endif
            @else
                <a class="btn btn-secondary btn-md" style="color: white" href="{{ route('login') }}">Go To Login Panel</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content text-center">
        
        <div class="container d-flex flex-column align-items-center">
        <div class="row">
            
        <h1 class="display-4 m-b-md">Welcome to Dayfresh CC Program-KLI</h1>
        </div>
        <div class="container d-flex flex-column align-items-center">
            <a id="location-button" class="location-button mb-3" href="#">
                <i class="fas fa-map-marker-alt"></i>
            </a>
        </div>
        <div class="row">
        <div class="clockStyle" id="clock"></div>
        </div>
        </div>
    </div>
</div>
