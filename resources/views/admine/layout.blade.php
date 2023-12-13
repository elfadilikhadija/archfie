<!DOCTYPE html>
<html lang="en">

<head>
    @yield('style')

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="https://as2.ftcdn.net/v2/jpg/06/72/79/53/1000_F_672795335_eNzIKlUZHoCVr0wKbfaKSAxe6WWMgVzY.webp" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('asset/index.css') }}" />
    <title>ARF</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div   id="sidebarElementName"  class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase "   >
                <a href="{{ URL('/presentation') }}"><img src="{{ asset('images/R.png') }}" alt=""></a>
            </div>
            <div class="list-group list-group-flush my-3">

                <a href="{{ route('admin.home') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fa fa-home me-2"></i>Acceuill</a>
                <a href="{{ route('admine.register') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa fa-edit me-2" aria-hidden="true" ></i>Créer un compte</a>
                <a href="{{ route('admine.accounts') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fa fa-users me-2"></i>Liste d'itulisateurs</a>
                <a href="{{ route('admine.create') }}"  class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fa fa-plus me-2"></i>Ajouter une fichier</a>
                <a href="{{ route('admine.archife') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fa fa-archive me-2"></i>archife</a>
                {{-- <a href="{{ route('admine.archife') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fa fa-folder me-2"></i>Dossiers</a> --}}

            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Archifast</h2>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>  {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li>  <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type ="submit"class="dropdown-item" ><i class='fas fa-sign-out-alt'></i> Logout</button></li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endauth
            </nav>



             <main>
                @yield('content')
             </main>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
@yield('script')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>





</body>

</html>
