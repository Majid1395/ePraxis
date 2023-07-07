@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="page-header">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Benutzer</li>
        </ol>
    </nav>
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
                    <i data-feather="users"></i>
                    <h4> Liste aller Patienten</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th class="nosort">Bild</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Telefonnummer</th>
                                <th>Geburtsdatum</th>
                                <th>Geschlecht</th>
                                <th class="nosort">&nbsp; Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($benutzer)>0)
                            @foreach($benutzer as $benutzer)
                            <tr>
                                <td><img src="{{asset('/assets/images/users')}}/{{$benutzer->bild}}" class="table-user-thumb" alt=""></td>
                                <td>{{$benutzer->vorname}} {{$benutzer->name}}</td>
                                <td>{{$benutzer->email}}</td>
                                @if(empty($benutzer->strasse))
                                    <td>nicht vorhanden</td>
                                @else
                                    <td>{{$benutzer->strasse}}, {{$benutzer->plz}} {{$benutzer->stadt}}</td>
                                @endif
                                @if(empty($benutzer->telefonnummer))
                                    <td>nicht vorhanden</td>
                                @else
                                    <td>{{$benutzer->telefonnummer}}</td>
                                @endif
                                @if(empty($benutzer->geburtsdatum))
                                    <td>nicht vorhanden</td>
                                @else
                                    <td>{{$benutzer->geburtsdatum}}</td>
                                @endif
                                <td>{{$benutzer->geschlecht}}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{route('mitarbeiter.edit',[$benutzer->id])}}"><i data-feather="edit"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$benutzer->id}}">
                                                <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- View Modal -->
                            @include('pages.mitarbeiter.delete')
                            @endforeach
                            @else
                                <td>Kein Benutzer zum Anzeigen</td>
                            @endif
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
