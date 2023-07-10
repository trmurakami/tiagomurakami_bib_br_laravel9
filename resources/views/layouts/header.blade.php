<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{url('/')}}" class="nav-link px-2 text-secondary">Início</a></li>
                <li><a href="{{url('/')}}/apps" class="nav-link px-2 text-white">Aplicativos online</a></li>
                <li><a href="{{url('/')}}/slides" class="nav-link px-2 text-white">Slides de apresentações</a></li>
                <li><a href="{{url('/')}}/guiadesoftwares" class="nav-link px-2 text-white">Guia de softwares</a></li>
            </ul>

            @if (Route::has('login'))
            <div class="text-end">
                @auth
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <x-dropdown-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a type="button" class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                <!-- <a type="button" class="btn btn-warning" href="{{ route('register') }}">Registrar</a> -->
                @endif
                @endauth
            </div>
            @endif

        </div>
    </div>
</header>