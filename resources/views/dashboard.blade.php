@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Willkommen im Dashboard</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
      <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Admin</h6>
                  <!-- <div class="d-flex justify-content-between align-items-baseline">
                      <i data-feather="user" class="text-primary"></i>
                  </div> -->
                  <div class="dropdown mb-2">
                    <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="{{route('admin.index')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{App\User::where('rolle_id',2)->count()}}</h3>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Arzt</h6>
                <div class="dropdown mb-2">
                  <button class="btn btn-link p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="{{route('admin.index')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{App\User::where('rolle_id',1)->count()}}</h3>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Mitarbeiter</h6>
              <div class="dropdown mb-2">
                <button class="btn btn-link p-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-12 col-xl-5">
              <h3 class="mb-2">{{App\User::where('rolle_id',3)->count()}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Patienten</h6>
          <div class="dropdown mb-2">
            <button class="btn btn-link p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="{{route('mitarbeiter.index')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th class="nosort">Bild</th>
                <th class="pt-0">Name</th>
                <th class="pt-0">Email-Adresse</th>
                <th class="pt-0">Adresse</th>
                <th class="pt-0">Telfonnummer</th>
                <th class="pt-0">Geburtsdatum</th>
                <th class="pt-0">Geschlecht</th>
              </tr>
            </thead>
            <tbody>
                @if(count($patienten)>0)
                @foreach($patienten as $patient)
                <tr>
                    <td><img src="{{asset('/assets/images/users')}}/{{$patient->bild}}" class="table-user-thumb" alt=""></td>
                    <td>{{$patient->vorname}} {{$patient->name}}</td>
                    <td>{{$patient->email}}</td>
                    @if(empty($patient->strasse))
                        <td>nicht vorhanden</td>
                    @else
                        <td>{{$patient->strasse}}, {{$patient->plz}} {{$patient->stadt}}</td>
                    @endif
                    @if(empty($patient->telefonnummer))
                        <td>nicht vorhanden</td>
                    @else
                        <td>{{$patient->telefonnummer}}</td>
                    @endif
                    @if(empty($patient->geburtsdatum))
                        <td>nicht vorhanden</td>
                    @else
                        <td>{{$patient->geburtsdatum}}</td>
                    @endif
                    <td>{{$patient->geschlecht}}</td>
                </tr>
                @endforeach
                @else
                    <td>Kein Patient zur Anzeige vorhanden</td>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-lg-12 col-xl-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Buchungen</h6>
          <div class="dropdown mb-2">
            <button class="btn btn-link p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="{{route('alle.patienten')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th class="pt-0">#</th>
                <th scope="col">Patient</th>
                <th scope="col">Email</th>
                <th scope="col">Datum</th>
                <th scope="col">Uhrzeit</th>
                <th scope="col">Bei</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>

                @forelse($buchungen as $key=>$buchung)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$buchung->patient->vorname}} {{$buchung->patient->name}}</td>
                    <td>{{$buchung->patient->email}}</td>
                    <td>{{$buchung->datum}}</td>
                    <td>{{$buchung->zeit}}</td>
                    <td>{{$buchung->arzt->vorname}} {{$buchung->arzt->name}}</td>
                    <td>
                        @if($buchung->status==0)
                        <span class="badge bg-info">Ausstehend</span>
                        @else
                        <span class="badge bg-success">Bestätigt</span>
                        @endif
                    </td>
                </tr>
                @empty
                    <td>Kein Buchung zur Anzeige vorhanden</td>
                @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
