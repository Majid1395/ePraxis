@extends('layout.master')


@section('content')
<div class="page-header">
        <div class="col align-items-end">
            <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('arzt.index')}}">Benutzer</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Aktualisieren</li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-fill-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="edit"></i>
                        <h4> Mitarbeiter Aktualisieren</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{route('arzt.update',[$benutzer->id])}}" method="post" enctype="multipart/form-data" >@csrf
                        @method('PUT')
                        @foreach(App\Rolle::where('name','=','mitarbeiter')->get() as $rolle)
                            <input type="hidden" name="rolle_id" value="{{$rolle->id}}">
                        @endforeach
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
					                <label for="">Geschlecht
                                        <span class="mandatory">*</span>
                                    </label>
					                <select class="form-control @error('geschlecht') is-invalid @enderror" name="geschlecht">
                                        <!-- Überprüfen die alte Auswahl-->
                                        @foreach(['maennlich','weiblich'] as $geschlecht)
                                            <option value="{{$geschlecht}}" @if($benutzer->geschlecht==$geschlecht)selected @endif>
                                                {{$geschlecht}}
                                            </option>
                                        @endforeach
					                </select>
                                    @error('geschlecht')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
				            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <div class="form-group">
						                <label for="">Bildungsgrad
                                            <span class="mandatory">*</span>
                                        </label>
                                        <select name="bildungsgrad" class="form-control @error('bildungsgrad') is-invalid @enderror">
                                            <!-- Überprüfen die alte Auswahl -->
                                            @foreach(App\Bildungsgrad::all() as $bildungsgrad)
                                                <option value="{{$bildungsgrad->name}}" @if($benutzer->bildungsgrad==$bildungsgrad->name)selected @endif>
                                                    {{$bildungsgrad->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bildungsgrad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
					        </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                <label for="vorname">Vorname
                                    <span class="mandatory">*</span>
                                </label>
                                    <input type="text" name="vorname" class="form-control @error('vorname') is-invalid @enderror" placeholder="vorname" value="{{$benutzer->vorname}}">
                                    @error('vorname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                <label for="name">Nachname
                                    <span class="mandatory">*</span>
                                </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="nachname" value="{{$benutzer->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
						            <label for="">Straße
                                        <span class="mandatory">*</span>
                                    </label>
						            <input type="text" name="strasse" class="form-control @error('strasse') is-invalid @enderror" placeholder="straße & hausnummer"  value="{{$benutzer->strasse}}">
                                    @error('strasse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
					        </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
						            <label for="">Stadt
                                        <span class="mandatory">*</span>
                                    </label>
						            <input type="text" name="stadt" class="form-control @error('stadt') is-invalid @enderror" placeholder="stadt"  value="{{$benutzer->stadt}}">
                                    @error('stadt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
					        </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
						            <label for="">PLZ
                                        <span class="mandatory">*</span>
                                    </label>
						            <input type="text" name="plz" class="form-control @error('plz') is-invalid @enderror" placeholder="plz"  value="{{$benutzer->plz}}">
                                    @error('plz')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
					        </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="">Email Addresse
                                        <span class="mandatory">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email"value="{{$benutzer->email}}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="">Passwort
                                    </label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="benutzer passwort">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
            	            <div class="col-sm-6">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Bild
                                            <span class="mandatory">*</span>
                                        </label>
                                        <input type="file" class="form-control file-upload-info @error('bild') is-invalid @enderror"  placeholder="Bild hochladen" name="bild">
                                        <span class="input-group-append">

                                        </span>
                                        @error('bild')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="">Telefonnummer
                                            <!-- <span class="mandatory">*</span> -->
                                        </label>
                                        <br>
                                        <input type="text" name="telefonnummer" id="phone" class="form-control @error('telefonnummer') is-invalid @enderror"
                                            value="{{$benutzer->telefonnummer}}" placeholder="telefonnummer">
                                        @error('telefonnummer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="exampleTextarea1">Beschreibung</label>
                                <textarea class="form-control @error('beschreibung') is-invalid @enderror" id="exampleTextarea1" rows="4" name="beschreibung">
                                    {{$benutzer->beschreibung}}
                                </textarea>
                                @error('beschreibung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Beim Anklicken werden alle Daten gesendet -->
                        <button type="submit" class="btn btn-primary mr-2">Aktualisieren</button>
                        <a href="{{route('arzt.index')}}" class="btn btn-secondary">Abbrechen</a>

                    </form>
                </div>
            </div>

        </div>

    </div>

    <style>
        .mandatory{
            color: #f00;
        }
    </style>

@endsection



