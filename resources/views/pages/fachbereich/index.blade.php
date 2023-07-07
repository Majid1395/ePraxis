@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="page-header">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fachbereich</li>
        </ol>
    </nav>
    </div>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-fill-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        @if(Session::has('errmessage'))
            <div class="alert bg-danger alert-success text-white" role="alert">
                {{Session::get('errmessage')}}
            </div>
        @endif
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="inbox"></i>
                        <h4> Liste aller Fachbereiche</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fachbereich</th>
                                    <th class="nosort">&nbsp; Aktion</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(count($fachbereiche)>0)
                                @foreach($fachbereiche as $key=>$fachbereich)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$fachbereich->name}}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{route('fachbereich.edit',[$fachbereich->id])}}"><i data-feather="edit"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$fachbereich->id}}">
                                                <i data-feather="trash"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>

                                <!-- View Modal -->
                                @include('pages.fachbereich.delete')
                                @endforeach
                                @else
                                <td>Keine Fachbereich zum Anzeigen</td>
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
