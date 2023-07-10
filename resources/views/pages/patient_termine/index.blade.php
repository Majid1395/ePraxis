@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" /> -->
@endpush

@section('content')
<div class="page-header">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Patientenliste</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        @if(Session::has('message'))
            <div class="alert alert-fill-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <form action="{{route('termine.patient')}}" method="get" >
                    <h6 class="card-title">Datum Wählen</h6>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Datum auswählen" data-input name="datum" >
                                <span class="input-group-text input-group-addon" data-toggle>
                                    <i data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Zeigen</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if(count($buchungen) >0)
                    <h6 class="card-title">Termine am: {{$datum}}</h6>
                @else
                    <h6 class="card-title">Termine</h6>
                @endif
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                      <thead>
                        <tr>
                          <th scope="col">Patient</th>
                          <th scope="col">Email</th>
                          <th scope="col">Datum</th>
                          <th scope="col">Uhrzeit</th>
                          <th scope="col">Status</th>
                          <th scope="col">Aktion</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($buchungen as $buchung)
                        <tr>
                            <td>{{$buchung->patient->vorname}} {{$buchung->patient->name}}</td>
                            <td>{{$buchung->patient->email}}</td>
                            <td>{{$buchung->datum}}</td>
                            <td>{{$buchung->zeit}}</td>
                            <td>
                                @if($buchung->status==0)
                                <span class="badge bg-info">Ausstehend</span>
                                @else
                                <span class="badge bg-success">Bestätigt</span>
                                @endif
                            </td>
                            <td>
                                @if($buchung->status==0)
                                    <a href="{{route('aktualisiere.status',[$buchung->id])}}">
                                        <button class="btn btn-primary">Bestätigen</button>
                                    </a>
                                @else
                                    @for ($i = 0; $i < count($zeiten[$buchung->id]); $i++)
                                        <form action="{{route('loeschen.buchung')}}" method="post">@csrf
                                            <input type="hidden" name="buchungId" value="{{$buchung->id}}">
                                            <input type="hidden" name="zeitId" value="{{$zeiten[$buchung->id][$i]['id']}}">
                                            <button type="submit" class="btn btn-danger">Löschen</button>
                                        </form>
                                    @endfor
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td>Keine Termine für diesen Datum!</td>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script> -->
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/data-table.js') }}"></script> -->
@endpush
