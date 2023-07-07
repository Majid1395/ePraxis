@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div style="margin:2.75rem auto;" class="row w-100 mx-0 auth-page">
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
              <h5 class="text-muted fw-normal mb-4">Kostenlose Registrieren.</h5>
              <form class="forms-sample" method="POST" action="{{ route('register') }}">@csrf

                <div class="mb-3">
                  <label for="vorname" class="form-label">{{ __('Vorname') }}</label>
                  <input id="vorname" type="text" class="form-control @error('vorname') is-invalid @enderror" placeholder="Vorname" name="vorname" value="{{ old('vorname') }}" required autocomplete="vorname" autofocus>
                  @error('vorname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">{{ __('Nachname') }}</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nachname" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">{{ __('E-Mail Addresse') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">{{ __('Passwort') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Passwort" name="password" required autocomplete="new-password">

                     @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                </div>
                <div class="mb-3">
                  <label for="password-confirm" class="form-label">{{ __('Passwort Wiederholen') }}</label>
                  <input id="password-confirm" type="password" class="form-control" placeholder="Passwort wiederholen" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="mb-3">
                  <label for="geschlecht" class="form-label">{{ __('Geschlect') }}</label>
                  <div>
                    <select name="geschlecht" class="form-control @error('geschlecht') is-invalid @enderror">
                        <option value="">Bitte wähle Geschlecht</option>
                        <option value="maennlich">Männlich</option>
                        <option value="weiblich">Weiblich</option>
                    </select>
                  </div>
                  @error('geschlecht')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="authCheck">
                  <label class="form-check-label" for="authCheck">
                  {{ __('Erinnere mich') }}
                  </label>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">
                  {{ __('Registrieren') }}
                  </button>
                </div>
                <a href="{{ url('/login') }}" class="d-block mt-3 text-muted">Schon ein Benutzer? Anmelden</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
