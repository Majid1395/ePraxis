@extends('layout.master')

@section('content')
    <div class="page-header">
        <div class="col align-items-end">
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('fachbereich.index')}}">Fachbereich</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hinzufügen</li>
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
                        <i data-feather="plus-square"></i>
                        <br>
                        <h4> Fachbereich Hinzufügen</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{route('fachbereich.store')}}" method="post" >@csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>
                                        Fachbereich Name<span class="mandatory">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="name" value="{{old('name')}}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
				            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Hinzufügen</button>
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
