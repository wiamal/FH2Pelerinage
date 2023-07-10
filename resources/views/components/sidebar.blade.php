<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('accueilPelerinage') }}" class="nav-link {{ setMenuClass('accueilPelerinage', 'active') }} ">
                <img src="{{ asset('images/icons/prestations-icons/icons8-kaaba-16.png') }}" class="mx-2"
                    alt="">
                <p>
                  Pèlerinage
                </p>
            </a>
        </li>


        {{-- <li class="nav-item ">
      <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Tableau de bord
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Vue globale</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-swatchbook"></i>
            <p></p>
          </a>
        </li>
      </ul>
  </li> --}}

        {{--  menu-open
  active --}}

        {{-- <li class="nav-item {{ setMenuClass('dashboard.profil', 'menu-is-opening menu-open')}}">
      <a href="" class="nav-link {{setMenuClass('dashboard.profil', 'active')}}">
        <i class=" nav-icon fas fa-users-cog"></i>
        <p>
          Compte
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ">
          <a href="{{ route('dashboard.profil') }}" class="nav-link {{ setMenuActive('dashboard.profil') }}">
            <i class=" nav-icon fas fa-user"></i>
            <p>Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard.profil.beneficiaire') }}" class="nav-link {{ setMenuActive('dashboard.profil.beneficiaire') }}">
            <i class="nav-icon fas fa-fingerprint"></i>
            <p>Bénéficiaire</p>
          </a>
        </li>
      </ul>
  </li> --}}

        {{-- <li class="nav-item ">
    <a href="" class="nav-link ">
      <i class=" nav-icon fas fa-print"></i>
      <p>
        Imprimer Carte
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item ">
        <a href="/card" class="nav-link">
          <i class=" nav-icon fas fa-id-card"></i>
          <p>Cartes</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/Adherents" class="nav-link">
          <i class="nav-icon fas fa-history"></i>
          <p>Historique</p>
        </a>
      </li>
    </ul>
</li> --}}

        <li class="nav-item">
            {{-- <a href="{{ route('accueilPelerinage') }}" class="nav-link  ">
                <i class="nav-icon fa-solid fa-kaaba"></i>
                <p>Pèlerinage</p>
            </a> --}}
            {{-- <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="" class="nav-link ">
                        
                        <img src="{{ asset('images/icons/prestations-icons/icons8-sun-lounger-color-16.png') }}"
                            class="mx-2" alt="">
                        <p> Estivage des Familles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href=" " class="nav-link ">
                        <img src="{{ asset('images/icons/prestations-icons/icons8-graduation-cap-color-16.png') }}"
                            class="mx-2" alt="">
                        <p>Bourse de mérite</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('accueilPelerinage') }}" class="nav-link  ">
                        <img src="{{ asset('images/icons/prestations-icons/icons8-kaaba-16.png') }}" class="mx-2"
                            alt="">
                        <p>Pèlerinage</p>
                    </a>
                </li>
            </ul> --}}
        </li>
        @if (Auth::user()->name == 'admin')
            <li class="nav-item">
                <a href="{{ route('liste-inscrits') }}" class="nav-link  ">
                    <i class="nav-icon fa-solid fa-kaaba"></i>
                    <p>Administration</p>
                </a>
                {{-- <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="" class="nav-link ">
                        
                        <img src="{{ asset('images/icons/prestations-icons/icons8-sun-lounger-color-16.png') }}"
                            class="mx-2" alt="">
                        <p> Estivage des Familles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href=" " class="nav-link ">
                        <img src="{{ asset('images/icons/prestations-icons/icons8-graduation-cap-color-16.png') }}"
                            class="mx-2" alt="">
                        <p>Bourse de mérite</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('accueilPelerinage') }}" class="nav-link  ">
                        <img src="{{ asset('images/icons/prestations-icons/icons8-kaaba-16.png') }}" class="mx-2"
                            alt="">
                        <p>Pèlerinage</p>
                    </a>
                </li>
            </ul> --}}
            </li>
        @endif
    </ul>
    <!-- bottom Side Of Navbar -->
    
    
    <ul class="navbar-nav bg-white shadow-sm rounded-5" style="top:90%;position:absolute;">
        <a href="{{ route('logout') }}" class="nav-link btn btn-logout"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i>
            Déconnexion
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>
