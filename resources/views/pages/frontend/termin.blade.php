@extends('layout2.master')

@section('content')
<div class="main-container">
    <main>
        <!-- Welcome Section -->
		<div class="team-section other-services container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<!-- Section Header -->
				<div class="section-header">
					<h3>Termin Vereinbaren</h3>
				</div><!-- Section Header /- -->
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12 our-clinic">
						<div class="row welcome-left">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="other-services-block">
									<div class="services-block-icon">
										<i class="fa fa-user"></i>
									</div>
									<div class="other-services-content">
										<h5>{{ucfirst($benutzer->vorname)}} {{ucfirst($benutzer->name)}}</h5>
                                        <div class="card">
									        <div class="card-body">
                                                <img  src="{{asset('assets/images/users')}}/{{$benutzer->bild}}" width="100px" style="border-radius: 50%;" >
                                                <br>
                                                <!-- <p> Name: {{ucfirst($benutzer->forename)}} {{ucfirst($benutzer->name)}}</p> -->
                                                <p> Hochschulabschluss: {{$benutzer->bildungsgrad}}</p>
                                                <p> Spezialist: {{$benutzer->fachbereich}}</p>
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    @if(auth()->check()&& auth()->user()->rolle->name === 'patient')
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
					        <form class="appoinment-form" action="{{route('termin.buchen')}}" method="post">@csrf
                                <div class="card">
                                    <div class="card-header lead">Verfügbare Zeiten am: {{$datum}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($zeiten as $zeit)
                                            <div class="col-md-3">
                                                <label class="btn btn-outline-primary">
                                                    <input  type="radio" name="zeit" value="{{$zeit->zeit}}" >
                                                    <span>{{$zeit->zeit}}</span>
                                                </label>
                                            </div>
                                            <input type="hidden" name="terminId" value ="{{$zeit->termin_id}}">
                                            <input type="hidden" name="arztId" value ="{{$arzt_id}}">
                                            <input type="hidden" name="datum" value ="{{$datum}}">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if(Auth::check())
                                            <button type="submit" class="btn-submit">Termin Buchen</button>
                                        @else
                                            <p>Please login to make an appointment</p>
                                            <a href="/login">
                                                <button class="btn-submit">Login</button>
                                            </a>
                                            <a href="/register">
                                                <button class="btn-submit">Register</button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
					        </form>
					    </div>
                    @endif
                    @if(auth()->check()&& auth()->user()->rolle->name === 'mitarbeiter')
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
                            <form class="profile-form" action="{{route('patient.id')}}" method="post">@csrf
                                <div style="padding-left: 0%;" class="other-services-content">
                                    <h5>Patienten</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <select name="id" class="form-control @error('id') is-invalid @enderror">
                                                        <option value="">Bitte wähle patient</option>
                                                        @foreach(App\User::where('rolle_id','=',4)->get() as $patient)
                                                        <option value="{{$patient->id}}">Name: {{$patient->vorname}} {{$patient->name}}, Email: {{$patient->email}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="hidden" name="arztId" value="{{$arzt_id}}">
                                                    <input type="hidden" name="datum" value ="{{$datum}}">
                                                    <button type="submit" class="btn-submit">Wählen</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if(Route::is('patient.id'))
					        <div class="col-md-8 col-sm-12 col-xs-12 clinic-form">
					        	<form class="appoinment-form" action="{{route('buchen.termin')}}" method="post">@csrf
                                    <div class="card">
                                        <div class="card-header lead">Verfügbare Zeiten am: {{$datum}}</div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($zeiten as $zeit)
                                                <div class="col-md-3">
                                                    <label class="btn btn-outline-primary">
                                                        <input  type="radio" name="zeit" value="{{$zeit->zeit}}" >
                                                        <span>{{$zeit->zeit}}</span>
                                                    </label>
                                                </div>
                                                <input type="hidden" name="terminId" value ="{{$zeit->termin_id}}">
                                                <input type="hidden" name="arztId" value ="{{$arzt_id}}">
                                                <input type="hidden" name="datum" value ="{{$datum}}">
                                                <input type="hidden" name="patientId" value ="{{$patientId}}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @if(Auth::check())
                                                <button type="submit" class="btn-submit">Termin Buchen</button>
                                            @else
                                                <p>Please login to make an appointment</p>
                                                <a href="/login">
                                                    <button class="btn-submit">Login</button>
                                                </a>
                                                <a href="/register">
                                                    <button class="btn-submit">Register</button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
					        	</form>
					        </div>
                        @endif
                    @endif
				</div>
			</div><!-- Container /- -->
		</div><!-- Welcome Section /- -->
    </main>
</div>

@endsection




