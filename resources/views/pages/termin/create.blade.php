@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="page-header">
        <div class="col align-items-end">
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('termin.index')}}">Termin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Erstellen</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- <div class="container"> -->
    <form action="{{route('termin.store')}}" method="post">@csrf
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
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Datum Wählen</h6>
                        <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control" placeholder="Select date" data-input name="datum">
                            <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Stunden Wählen</h6>
                        <!-- select All -->
                        <span style="margin-left: 70%">Alle Wählen/Abwählen
                            <input type="checkbox" onclick=" for(c in document.getElementsByName('zeit[]'))
                            document.getElementsByName('zeit[]').item(c).checked = this.checked">
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead></thead>
                            <tbody>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="08:00-08:20"> 08:00 - 08:20</td>
                                <td><input type="checkbox" name="zeit[]" value="08:25-08:45"> 08:25 - 08:45</td>
                                <td><input type="checkbox" name="zeit[]" value="08:50-09:10"> 08:50 - 09:10</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="09:15-09:35"> 09:15 - 09:35</td>
                                <td><input type="checkbox" name="zeit[]" value="09:40-10:00"> 09:40 - 10:00</td>
                                <td><input type="checkbox" name="zeit[]" value="10:05-10:25"> 10:05 - 10:25</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="10:30-10:50"> 10:30 - 10:50</td>
                                <td><input type="checkbox" name="zeit[]" value="10:55-11:15"> 10:55 - 11:15</td>
                                <td><input type="checkbox" name="zeit[]" value="11:20-11:40"> 11:20 - 11:40</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="11:45-12:05"> 11:45 - 12:05</td>
                                <td><input type="checkbox" name="zeit[]" value="12:10-12:30"> 12:10 - 12:30</td>
                                <td><input type="checkbox" name="zeit[]" value="12:35-12-55"> 12:35 - 12-55</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="15:00-15:20"> 15:00 - 15:20</td>
                                <td><input type="checkbox" name="zeit[]" value="15:25-15:45"> 15:25 - 15:45</td>
                                <td><input type="checkbox" name="zeit[]" value="15:50-16:10"> 15:50 - 16:10</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="16:15-16:35"> 16:15 - 16:35</td>
                                <td><input type="checkbox" name="zeit[]" value="16:40-17:00"> 16:40 - 17:00</td>
                                <td><input type="checkbox" name="zeit[]" value="17:05-17:25"> 17:05 - 17:25</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="zeit[]" value="17:30-17:50"> 17:30 - 17:50</td>
                                <td><input type="checkbox" name="zeit[]" value="17:55-18:15"> 17:55 - 18:15</td>
                                <td><input type="checkbox" name="zeit[]" value="18:20-18:40"> 18:20 - 18:40</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Hinzufügen</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush


