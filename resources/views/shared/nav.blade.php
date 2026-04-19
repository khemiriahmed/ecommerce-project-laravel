    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

{{-- @php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    if($user!==null){
        $dashboardRoute = $user->getRedirectRoute();
    }
@endphp

<nav class="navbar navbar-expand navbar-light bg-light ">
   <div class="nav navbar-nav">
    <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
    <a class="nav-item nav-link " href="{{ route('products.index') }}">Products </a>
    @auth
        <a class="nav-item nav-link" href="{{ route($dashboardRoute) }}"> Dashboard</a>
        <a class="nav-item nav-link" href="{{ route('logout') }}"> logout</a>
    @else

        <a  class="nav-item nav-link" href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
          <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>            
        @endif

    @endauth


   </div>
    
</nav>
 --}}
