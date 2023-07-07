@extends('layout.master')

@section('content')
<div class="page-header">
    <div class="col align-items-end">
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('termin.index')}}">Termin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Aktualisieren</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    @if(Session::has('errmessage'))
        <div class="alert bg-danger alert-success text-white" role="alert">
            {{Session::get('errmessage')}}
        </div>
    @endif
    <div class="col-md-12 grid-margin">
        <form action="{{route('termin.aktualisiere',[$datum])}}" method="post">@csrf
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Ihre Termine am: {{$datum}}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead></thead>
                        <tbody>
                            <input type="hidden" name="terminId" value="{{$terminId}}">
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="08:00-08:20"
                                @if(isset($zeiten) && $zeiten->contains('zeit','08:00-08:20') && $zeiten->where('zeit', '08:00-08:20')->first()->status === 1)
                                    disabled
                                @endif
                                @if(isset($zeiten) && $zeiten->contains('zeit','08:00-08:20'))
                                    checked
                                @endif>
                                    08:00 - 08:20
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="08:25-08:45"
                                @if(isset($zeiten) && $zeiten->contains('zeit','08:25-08:45') && $zeiten->where('zeit', '08:25-08:45')->first()->status === 1)
                                    disabled
                                @endif
                                @if(isset($zeiten) && $zeiten->contains('zeit','08:25-08:45'))
                                    checked
                                @endif>
                                    08:25 - 08:45
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="08:50-09:10"
                                @if(isset($zeiten) && $zeiten->contains('zeit','08:50-09:10') && $zeiten->where('zeit', '08:50-09:10')->first()->status === 1)
                                    disabled
                                @endif
                                @if(isset($zeiten) && $zeiten->contains('zeit','08:50-09:10'))
                                    checked
                                @endif>
                                    08:50 - 09:10
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="09:15-09:35"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','09:15-09:35') && $zeiten->where('zeit', '09:15-09:35')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','09:15-09:35'))
                                        checked
                                    @endif>
                                    09:15 - 09:35
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="09:40-10:00"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','09:40-10:00') && $zeiten->where('zeit', '09:40-10:00')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','09:40-10:00'))
                                        checked
                                    @endif>
                                    09:40 - 10:00
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="10:05-10:25"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','10:05-10:25') && $zeiten->where('zeit', '10:05-10:25')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','10:05-10:25'))
                                        checked
                                    @endif>
                                    10:05 - 10:25
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="10:30-10:50"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','10:30-10:50') && $zeiten->where('zeit', '10:30-10:50')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','10:30-10:50'))
                                        checked
                                    @endif>
                                    10:30 - 10:50
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="10:55-11:15"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','10:55-11:15') && $zeiten->where('zeit', '10:55-11:15')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','10:55-11:15'))
                                        checked
                                    @endif>
                                    10:55 - 11:15
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="11:20-11:40"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','11:20-11:40') && $zeiten->where('zeit', '11:20-11:40')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','11:20-11:40'))
                                        checked
                                    @endif>
                                    11:20 - 11:40
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="11:45-12:05"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','11:45-12:05') && $zeiten->where('zeit', '11:45-12:05')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','11:45-12:05'))
                                        checked
                                    @endif>
                                    11:45 - 12:05
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="12:10-12:30"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','12:10-12:30') && $zeiten->where('zeit', '12:10-12:30')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','12:10-12:30'))
                                        checked
                                    @endif>
                                    12:10 - 12:30
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="12:35-12-55"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','12:35-12-55') && $zeiten->where('zeit', '12:35-12-55')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','12:35-12-55'))
                                        checked
                                    @endif>
                                    12:35 - 12-55
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="15:00-15:20"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','15:00-15:20'))
                                        checked
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','15:00-15:20') && $zeiten->where('zeit', '15:00-15:20')->first()->status === 1)
                                        disabled
                                    @endif>
                                    15:00 - 15:20
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="15:25-15:45"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','15:25-15:45'))
                                        checked
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','15:25-15:45') && $zeiten->where('zeit', '15:25-15:45')->first()->status === 1)
                                        disabled
                                    @endif>
                                    15:25 - 15:45
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="15:50-16:10"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','15:50-16:10') && $zeiten->where('zeit', '15:50-16:10')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','15:50-16:10'))
                                        checked
                                    @endif>
                                    15:50 - 16:10
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="16:15-16:35"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','16:15-16:35') && $zeiten->where('zeit', '16:15-16:35')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','16:15-16:35'))
                                        checked
                                    @endif>
                                    16:15 - 16:35
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="16:40-17:00"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','16:40-17:00') && $zeiten->where('zeit', '16:40-17:00')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','16:40-17:00'))
                                        checked
                                    @endif>
                                    16:40 - 17:00
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="17:05-17:25"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','17:05-17:25') && $zeiten->where('zeit', '17:05-17:25')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','17:05-17:25'))
                                        checked
                                    @endif>
                                    17:05 - 17:25
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="zeit[]" value="17:30-17:50"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','17:30-17:50') && $zeiten->where('zeit', '17:30-17:50')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','17:30-17:50'))
                                        checked
                                    @endif>
                                    17:30 - 17:50
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="17:55-18:15"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','17:55-18:15') && $zeiten->where('zeit', '17:55-18:15')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','17:55-18:15'))
                                        checked
                                    @endif>
                                    17:55 - 18:15
                                </td>
                                <td><input type="checkbox" name="zeit[]" value="18:20-18:40"
                                    @if(isset($zeiten) && $zeiten->contains('zeit','18:20-18:40') && $zeiten->where('zeit', '18:20-18:40')->first()->status === 1)
                                        disabled
                                    @endif
                                    @if(isset($zeiten) && $zeiten->contains('zeit','18:20-18:40'))
                                        checked
                                    @endif>
                                    18:20 - 18:40
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Aktualisieren</button>
                    <a href="{{route('termin.index')}}" class="btn btn-secondary">Abbrechen</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


