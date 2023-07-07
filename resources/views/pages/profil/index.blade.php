@extends('layout2.master2')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
<div class="main-container">
    <main>
        <!-- Welcome Section -->
		<div class="team-section other-services container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<!-- Section Header -->
				<div class="section-header">
					<h3>Ihr Profil</h3>
				</div><!-- Section Header /- -->
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 clinic-form">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach

                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif

                        @if(Session::has('errmessage'))
                        <div class="alert alert-danger">
                            {{Session::get('errmessage')}}
                        </div>
                        @endif
						<form class="profile-form" action="{{route('profil.update')}}" method="post" enctype="multipart/form-data" >@csrf
                        <div style="padding-left: 0%;" class="other-services-content">
                            <h5>Ihre Informationen</h5>
                            <div class="card">
                                <!-- <div class="card-header"><h5>Your Information</h5></div> -->
                                <div class="card-body">
                                    <div class="form-group col-md-12 no-left-padding">
                                        <label>
                                            Geschlecht<span class="mandatory">*</span>
                                        </label>
                                        <select name="geschlecht" class="form-control @error('geschlecht') is-invalid @enderror">
                                            <option value="">Bitte wähle Geschlecht</option>
                                            <option value="maennlich" @if(auth()->user()->geschlecht==='maennlich')selected @endif >Männlich</option>
                                            <option value="weiblich" @if(auth()->user()->geschlecht==='weiblich')selected @endif>Weiblich</option>
                                        </select>
                                        @error('geschlecht')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group col-md-12 no-padding">
                                        <div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
                                            <label>
                                                Vorname<span class="mandatory">*</span>
                                            </label>
                                            <input type="text" name="vorname" class="form-control @error('vorname') is-invalid @enderror" value="{{auth()->user()->vorname}}">
                                            @error('vorname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
                                            <label>
                                                Nachname<span class="mandatory">*</span>
                                            </label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{auth()->user()->name}}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group input-group col-md-12 no-padding">
                                        <div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
                                            <label>
                                                Email-Addresse<span class="mandatory">*</span>
                                            </label>
                                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{auth()->user()->email}}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
                                            <label>Passwort</label>
                                            <input type="password" name="password" class="form-control" placeholder="user password">
                                        </div>
                                    </div>
                                    <div class="form-group input-group col-md-12 no-padding">
                                        <div class="col-md-4 col-sm-6 col-xs-12 no-left-padding">
                                            <label>Straße</label>
                                            <input type="text" name="strasse" class="form-control" value="{{auth()->user()->strasse}}" placeholder="straße & hausnummer">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 no-left-padding">
                                            <label>Stadt</label>
                                            <input type="text" name="stadt" class="form-control" value="{{auth()->user()->stadt}}" placeholder="stadt">
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 no-left-padding">
                                            <label>PLZ</label>
                                            <input type="text" name="plz" class="form-control" value="{{auth()->user()->plz}}" placeholder="plz">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 no-left-padding">
                                        <div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
                                            <label>Telefonnummer</label>
                                            <input type="text" name="telefonnummer" class="form-control" value="{{auth()->user()->telefonnummer}}" placeholder="telefonnummer">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
                                            <label>Geburtsdatum</label>
                                            <div class="form-group input-group flatpickr" id="flatpickr-date">
                                                <input type="text" class="form-control" value="{{auth()->user()->geburtsdatum}}" placeholder="Datum auswählen" data-input name="geburtsdatum">
                                                <span class="input-group-text input-group-addon " data-toggle><i class="fa fa-calendar"></i></span>
							                </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 no-left-padding">
                                        <label>Beschreibung</label>
                                        <textarea name="beschreibung" class="form-control">{{auth()->user()->beschreibung}}</textarea>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-submit" type="submit">Speichern</button>
                                </div>
                            </div>
                        </div>
						</form>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 clinic-form">
                        @if(Session::has('message1'))
                            <div class="alert alert-success">{{Session::get('message1')}}</div>
                        @endif
                        <form class="profile-form" action="{{route('profil.bild')}}" method="post" enctype="multipart/form-data">@csrf
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div style="padding-left: 0%;" class="other-services-content">
									<h5>Profilbild</h5>
                                        <div class="card">
								            <div class="card-body">
                                                @if(!auth()->user()->bild)
                                                    <img src="{{asset('assets/images/default.png')}}" width="120" style="border-radius: 50%;">
                                                @else
                                                    <img src="{{asset('assets/images/users')}}/{{auth()->user()->bild}}" >
                                                @endif
                                                <br>
                                                <input type="file" name="file" class="form-control" required="">
                                                <br>
                                                @error('file')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <button type="submit" class="btn-submit">Hinzufügen</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
					</div>

				</div>
			</div><!-- Container /- -->
		</div><!-- Welcome Section /- -->

    </main>
</div>

<style>
    .mandatory{
        color: #f00;
    }
</style>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/flatpickr1.js') }}"></script>
@endpush
