<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="navbar-toggler-icon"></span>
                </button> <a class="navbar-brand" href="{{ route('home') }}">{{ env('NAME_APLICATION') }}</a>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 
                        
                       @guest


                       @else
                        
                         @include('layouts.menu')

                       @endguest

           
                    <ul class="navbar-nav ml-md-auto">

                      @guest

                       <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif


                      @else
                        
                         <li class="nav-item active">
                             <a class="nav-link" href="#"> {{ Auth::user()->nombres }} <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                          

                              
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>




                            </div>
                        </li>


                      @endguest


                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>