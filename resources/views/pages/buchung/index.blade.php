@extends('layout2.master')

@section('content')
<div class="main-container">
    <main>
        <!-- Team Section -->
		<div class="team-section container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<!-- Section Header -->
				<div class="section-header">
					<h3>Ihre Termine</h3>
				</div>
                <div class="col-md-12 col-sm-12 col-xs-12 clinic-form">
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form class="profile-form" action="{{route('meine-buchung.loeschen')}}" method="post">@csrf
                        <div style="padding-left: 0%;" class="other-services-content">
                            <div class="card">
				                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Zeit</th>
                                                    <th scope="col">Bei</th>
                                                    <th scope="col">Datum</th>
                                                    <th scope="col">Erstellt am</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aktion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($buchungen as $buchung)
                                                <tr>
                                                    <td>{{$buchung->zeit}}</td>
                                                    <td>{{$buchung->arzt->vorname}} {{$buchung->arzt->name}}</td>
                                                    <td>{{$buchung->datum}}</td>
                                                    <td>{{$buchung->created_at}}</td>
                                                    <td>
                                                        @if($buchung->status==0)
                                                        <span style="background-color: #66d1d1;" class="badge">Ausstehend</span>
                                                        @else
                                                        <span style="background-color: #05a34a;" class="badge">Bestätigt</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @for ($i = 0; $i < count($zeiten[$buchung->id]); $i++)
                                                            <input type="hidden" name="buchungId" value="{{$buchung->id}}">
                                                            <input type="hidden" name="zeitId" value="{{$zeiten[$buchung->id][$i]['id']}}">
                                                            <button type="submit" class="btn btn-danger">Löschen</button>
                                                        @endfor
                                                    </td>
                                                </tr>
                                            @empty
                                                <td>Sie haben keine Buchungen!</td>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
				                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div><!-- Container /- -->
		</div><!-- Team Section /- -->
    </main>
</div>



@endsection


