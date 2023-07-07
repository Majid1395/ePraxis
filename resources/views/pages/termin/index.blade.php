@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush


@section('content')
<div class="page-header">
    <div class="col align-items-end">
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Termin</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    @if(Session::has('message'))
        <div class="alert bg-success alert-success text-white" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach

    @if(Session::has('errmessage'))
        <div class="alert bg-danger alert-success text-white" role="alert">
            {{Session::get('errmessage')}}
        </div>
    @endif
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ihre Terminliste</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Datum</th>
                                <th scope="col">Erstellt am</th>
                                <th scope="col">Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($meineTermine)
                            @foreach($meineTermine as $termin)
                            <tr>
                                <td>{{$termin->datum}}</td>
                                <td>{{$termin->created_at}}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{route('termin.edit',[$termin->datum])}}">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$termin->id}}">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- View Modal -->
                            @include('pages.termin.delete')
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- </div> -->


<style type="text/css">
    input[type="checkbox"]{
        zoom: 1;
    }
    body{
        font-size: 15px;
    }
</style>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush






