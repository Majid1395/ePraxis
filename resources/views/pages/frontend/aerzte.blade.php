@extends('layout2.master')

@section('content')
<!--display doctors-->
<div class="main-container">
    <main>
        <div class="team-section container-fluid no-left-padding no-right-padding">
			<div class="container">
				<div class="section-header">
					<h3>Verfügbare Ärzte am: {{$datum}}</h3>
				</div>
                <div class="team-carousel">
                    @forelse($aerzte as $arzt)
                        <div class="col-md-12">
				    		<div class="team-content">
				    			<div class="team-box">
                                    <img src="{{asset('assets/images/users')}}/{{$arzt->arzt->bild}}" width="100px" style="border-radius: 50%;">
				    				<h5>{{$arzt->arzt->vorname}} {{$arzt->arzt->name}}</h5>
				    			</div>
                                <div class="team-box">
                                    <span class="team-catagory">{{$arzt->arzt->fachbereich}}</span>
                                </div>
                                @if(auth()->check()&& auth()->user()->rolle->name === 'mitarbeiter')
                                    <a href="{{route('neuer.termin',[$arzt->benutzer_id,$arzt->datum])}}">
                                        <button style="background-color: #7AA228; border-color: #6B8E23;" class="btn btn-success">Termin Buchen</button>
                                    </a>
                                @else
                                    <a href="{{route('termin.neu',[$arzt->benutzer_id,$arzt->datum])}}">
                                        <button style="background-color: #7AA228; border-color: #6B8E23;" class="btn btn-success">Termin Buchen</button>
                                    </a>
                                @endif
				    		</div>
				    	</div>
                    @empty
                    <div class="team-content">
                        <div class="team-box">
                            <td>Verzeihung! Heute sind keine Ärzte verfügbar</td>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
