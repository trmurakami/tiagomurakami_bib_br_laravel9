<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{url('/')}}" class="nav-link px-2 text-secondary">Início</a></li>
                <li><a href="{{url('/')}}/search?search=" class="nav-link px-2 text-white">Catálogo</a></li>
                <li><a href="{{url('/')}}/authorities" class="nav-link px-2 text-white">Autoridades</a></li>
                <li><a href="{{url('/')}}/admin" class="nav-link px-2 text-white">Administração</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
                    aria-label="Search" name="search">
            </form>

            <div class="text-end">
                <a class="btn btn-outline-light me-2" href="{{url('/')}}/login" role="button">Login</a>
                <a class="btn btn-warning" href="{{url('/')}}/register" role="button">Registrar usuário</a>
            </div>
        </div>
    </div>
</header>