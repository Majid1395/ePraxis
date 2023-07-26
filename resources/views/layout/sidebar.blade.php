<nav class="sidebar">
  <div class="sidebar-header">
    <!-- Icon -->
    <a class="sidebar-brand" href="{{ url('/') }}">
        <img src="{{asset('assets/images/logo.png ')}}" height="38" width="115">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['dashboard']) }}">
        <a href="{{ url('dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Web Apps</li>
      <!----------------------------- Admin -------------------------------------->
      @if(auth()->check()&& auth()->user()->rolle->name === 'admin')
      <li class="nav-item {{ active_class(['admin/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="{{ is_active_route(['admin/*']) }}" aria-controls="admin">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Benutzerverwaltung</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['admin/*']) }}" id="admin">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin') }}" class="nav-link {{ active_class(['admin/index']) }}">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/create') }}" class="nav-link {{ active_class(['admin/admin_create']) }}">Admin Hinzufügen</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/arzt/create') }}" class="nav-link {{ active_class(['admin/arzt_create']) }}">Arzt Hinzufügen</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['fachbereich/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#fachbereich" role="button" aria-expanded="{{ is_active_route(['fachbereich/*']) }}" aria-controls="fachbereich">
          <i class="link-icon" data-feather="edit"></i>
          <span class="link-title">Fachbereich Verwaltung</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['fachbereich/*']) }}" id="fachbereich">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/fachbereich') }}" class="nav-link {{ active_class(['fachbereich/index']) }}">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/fachbereich/create') }}" class="nav-link {{ active_class(['fachbereich/create']) }}">Spezialität Hinzufügen</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['bildungsgrad/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#bildungsgrad" role="button" aria-expanded="{{ is_active_route(['bildungsgrad/*']) }}" aria-controls="bildungsgrad">
          <i class="link-icon" data-feather="edit"></i>
          <span class="link-title">Bildungsgrad Verwaltung</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['bildungsgrad/*']) }}" id="bildungsgrad">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/bildungsgrad') }}" class="nav-link {{ active_class(['bildungsgrad/index']) }}">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/bildungsgrad/create') }}" class="nav-link {{ active_class(['bildungsgrad/create']) }}">Bildungsgrad Hinzufügen</a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      <!----------------------------- Arzt -------------------------------------->
      @if(auth()->check()&& auth()->user()->rolle->name === 'arzt')
      <li class="nav-item {{ active_class(['arzt/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#arzt" role="button" aria-expanded="{{ is_active_route(['arzt/*']) }}" aria-controls="arzt">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Benutzerverwaltung</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['arzt/*']) }}" id="arzt">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/arzt') }}" class="nav-link {{ active_class(['arzt/index']) }}">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/arzt/create') }}" class="nav-link {{ active_class(['arzt/create']) }}">Mitarbeiter Hinzufügen</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['termin/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#termin" role="button" aria-expanded="{{ is_active_route(['termin/*']) }}" aria-controls="termin">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Termin</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['termin/*']) }}" id="termin">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/termin') }}" class="nav-link {{ active_class(['termin/index']) }}">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/termin/create') }}" class="nav-link {{ active_class(['termin/create']) }}">Termin Erstellen</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['buchung/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#buchung" role="button" aria-expanded="{{ is_active_route(['buchung/*']) }}" aria-controls="buchung">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Patient Termine</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['buchung/*']) }}" id="buchung">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/termine/patient') }}" class="nav-link {{ active_class(['patient_termine/index']) }}">Patienten Liste</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/termine/arzt/alle-patienten') }}" class="nav-link {{ active_class(['patient_termine/alle']) }}">Alle Patienten</a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      <!----------------------------- Mitarbeiter -------------------------------------->
      @if(auth()->check()&& auth()->user()->rolle->name === 'mitarbeiter')
      <li class="nav-item {{ active_class(['mitarbeiter/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#mitarbeiter" role="button" aria-expanded="{{ is_active_route(['mitarbeiter/*']) }}" aria-controls="mitarbeiter">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Benutzerverwaltung</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['mitarbeiter/*']) }}" id="mitarbeiter">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/mitarbeiter') }}" class="nav-link {{ active_class(['mitarbeiter/index']) }}">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/mitarbeiter/create') }}" class="nav-link {{ active_class(['mitarbeiter/create']) }}">Patient Hinzufügen</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['buchung/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#buchung" role="button" aria-expanded="{{ is_active_route(['buchung/*']) }}" aria-controls="buchung">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Patient Termine</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['buchung/*']) }}" id="buchung">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/termine/alle-patienten') }}" class="nav-link {{ active_class(['patient_termine/alle']) }}">Alle Patienten</a>
            </li>
          </ul>
        </div>
      </li>
      @endif

    </ul>
  </div>
</nav>

