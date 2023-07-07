@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="page-header">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Patientenliste</li>
        </ol>
    </nav>
</div>
<div class="row">
    @if(Session::has('message'))
    <div class="alert alert-success">
        {{Session::get('message')}}
    </div>
    @endif
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Alle Termine</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Patient</th>
                                <th scope="col">Email</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Uhrzeit</th>
                                <th scope="col">Bei</th>
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
                                <td>{{$buchung->arzt->vorname}} {{$buchung->arzt->name}}</td>
                                <td>
                                    @if($buchung->status==0)
                                    <span class="badge bg-info">Ausstehend</span>
                                    @else
                                    <span class="badge bg-success">Bestätigt</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->check()&& auth()->user()->rolle->name === 'mitarbeiter')
                                        @if($buchung->status==0)
                                            <a href="{{route('status.aktualisiere',[$buchung->id])}}">
                                                <button class="btn btn-primary">Bestätigen</button>
                                            </a>
                                        @else
                                            @for ($i = 0; $i < count($zeiten[$buchung->id]); $i++)
                                                <form action="{{route('buchung.loeschen')}}" method="post">@csrf
                                                    <input type="hidden" name="buchungId" value="{{$buchung->id}}">
                                                    <input type="hidden" name="zeitId" value="{{$zeiten[$buchung->id][$i]['id']}}">
                                                    <button type="submit" class="btn btn-danger">Löschen</button>
                                                </form>
                                            @endfor
                                        @endif
                                    @endif
                                    @if(auth()->check()&& auth()->user()->rolle->name === 'arzt')
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
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <td>Keine Termine verfügbar!</td>
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
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
