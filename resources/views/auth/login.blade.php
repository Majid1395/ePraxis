@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div style="margin:8.75rem auto;" class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
          <div class="auth-side-wrapper" style="background-image: url({{ url('/assets/images/banner/LI.jpg') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <!-- <a href="{{ url('/') }}" class="noble-ui-logo d-block mb-2"><span>e</span>Praxis</a> -->
              <a class="noble-ui-logo d-block mb-2" href="{{ url('/') }}">
                    <img src="{{asset('assets/images/logo.png ')}}" height="50" width="155">
                </a>
              <h5 class="text-muted fw-normal mb-4">Willkommen zurück! Melden Sie sich an.</h5>
              <form class="forms-sample" method="POST" action="{{ route('login') }}">@csrf
                <div class="mb-3">
                  <label for="email" class="form-label">{{ __('E-Mail Addresse') }}</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">{{ __('Passwort') }}</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password" placeholder="Passwort">
                  @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                  {{ __('Erinnere mich') }}
                  </label>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">
                    {{ __('Anmelden') }}
                  </button>
                  @if (Route::has('password.request'))
                        <a class="btn btn-link" href="#">
                            {{ __('Passwort vergessen?') }}
                        </a>
                @endif
                </div>
                <a href="{{ url('/register') }}" class="d-block mt-3 text-muted">Kein Benutzer? Registrieren</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
