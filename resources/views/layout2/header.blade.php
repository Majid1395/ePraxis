<header class="header_s header_s1 header_s11 header_s17">
	<!-- Ownavigation -->
	<nav class="navbar ownavigation">
		<!-- Container -->
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

                <a class="navbar-brand mr-auto" href="{{ url('/') }}">
                    <img src="{{asset('assets/images/logo.png ')}}" height="55" width="155">
                </a>
			</div>
			<div class="navbar-collapse collapse" id="navbar">
				<ul class="nav navbar-nav menubar navbar-right">
					<li><a title="Home" href="{{url('dashboard')}}">Home</a></li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" title="Contact" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kontakt</a>
						<i class="ddl-switch fa fa-angle-down"></i>
						<ul class="dropdown-menu">
                            <li><a href="{{ asset('frontend/contact-1.html') }}" title="Blog Post">Kontakt 1</a></li>
							<li><a href="{{ asset('frontend/contact-2.html') }}" title="Blog Post">Kontakt 2</a></li>
						</ul>
					</li>
                    <!-- Authentication Links -->
                    @guest
                        <li>
                            <a title="Login" class="nav-link active" href="{{ route('login') }}">
                                <i class="fa fa-arrow-circle-right"></i>{{ __('Anmelden') }}
                            </a>
                        </li>
                    @else
                        <li class="dropdown mega-dropdown active">
                            <a href="#" class="dropdown-toggle" title="Blog" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->vorname}} {{Auth::user()->name}}</a>
                            <i class="ddl-switch fa fa-angle-down"></i>
                            <ul class="dropdown-menu">
                                @if(auth()->check()&& auth()->user()->rolle->name === 'patient')
                                    <li><a href="{{url('benutzer-profil')}}" title="Profil">Profil</a></li>
                                    <li><a title="Meine Buchungen" class="nav-link" href="{{ route('meine.buchung') }}">Meine Buchungen</a></li>
                                @else
                                    <li><a href="{{url('dashboard')}}" title="Dashboard">Dashboard</a></li>
                                    <li><a href="{{url('benutzer-profil')}}" title="Profil">Profil</a></li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Abmelden') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
				</ul>
			</div>
		</div><!-- Container /- -->
	</nav><!-- Ownavigation /- -->
</header>
