@extends('layout.master')

@section('content')
    <div class="page-header">
        <div class="col align-items-end">
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('bildungsgrad.index')}}">Bildungsgrad</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Aktualisieren</li>
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="edit"></i>
                        <br>
                        <h4> Bildungsgrad Aktualisieren</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{route('bildungsgrad.update',[$bildungsgrad->id])}}" method="post" >@csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>
                                        Degree Name<span class="mandatory">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="name des Bildungsgrads" value="{{$bildungsgrad->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
				            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
