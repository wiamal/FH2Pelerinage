<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ setMenuClass('home', 'active') }} ">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Accueil
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
            <a href="#" class="nav-link  ">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Prestations
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="" class="nav-link ">
                        {{-- <i class="icon- fa-sharp fa-umbrella-beach"></i> --}}
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
            </ul>
        </li>
    </ul>
</nav>
