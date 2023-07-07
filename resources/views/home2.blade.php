@extends('layout2.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
<div class="main-container">
	<main>
		<!-- Slider Section -->
		<div id="home-revslider" class="slider-section slider-space container-fluid no-padding">
			<!-- START REVOLUTION SLIDER 5.0 -->
			<div class="rev_slider_wrapper">
				<div id="home-slider1" class="rev_slider" data-version="5.3">
					<ul>
						<li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
							<img src="{{ asset('assets/images/banner/S1.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
							<div class="tp-caption background-block NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-layer-1"
								data-x="['left','left','left','center']" data-hoffset="['375','140','70','0']"
								data-y="['top','top','top','top']"  data-voffset="['530','340','280','80']"
								data-fontsize="['48','48','40','32']"
								data-lineheight="['60','60','52','52']"
								data-width="['561','561','561','400']"
								data-height="['221','221','221','200']"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
								data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
								data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
								data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
								data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
								data-start="1000"
								data-splitin="none"
								data-splitout="none"
								data-responsive_offset="on"
								data-elementdelay="0.05"
								data-paddingtop="[55,55,55,55]"
								data-paddingright="[45,45,45,65]"
								data-paddingbottom="[55,55,55,55]"
								data-paddingleft="[45,45,45,25]"
								style="z-index:3; position:relative; text-transform:uppercase; width: 561px; color:#4c4c4c; height: 221px; font-family: 'Lato', sans-serif; font-weight: 300;">
								<span class="title-txt" style="font-size: 48px; font-weight:bold;">Medical</span> Services <br> You Can <span style="font-weight:bold; font-size: 48px;">Trust</span>
							</div>
							<div class="tp-caption NotGeneric-Button rev-btn learn-btn rs-parallaxlevel-0" id="slide-layer-2"
								data-x="['left','left','left','center']" data-hoffset="['425','190','110','-20']"
								data-y="['top','top','top','top']"  data-voffset="['725','535','475','250']"
								data-fontsize="['18','18','18','18']"
								data-width="['224','224','224','200']"
								data-height="['86','86','86','50']"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
								data-transform_in="x:[105%];s:1000;e:Power4.slideInLeft;"
								data-transform_out="y:[100%];s:1000;s:1000;e:Power2.slideInLeft;"
								data-start="3000"
								data-splitin="none"
								data-splitout="none"
								data-responsive_offset="on"
								data-responsive="off"
								data-paddingtop="[15,15,15,15]"
								data-paddingright="[10,10,10,10]"
								data-paddingbottom="[15,15,15,70]"
								data-paddingleft="[10,10,10,10]"
								style="z-index: 10; border-radius: 0; letter-spacing:0.8px; color: #fff; font-family: 'Poppins', sans-serif; text-transform:capitalize; white-space:nowrap; outline:none; box-shadow:none; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;"><span class="button-txt"><i class="fa fa-stethoscope" style="text-align: center; line-height: 50px; width: 55px; height: 55px; font-size: 24px; border-radius: 50%; background-color: #fff; vertical-align: middle; box-shadow: inset 0px 5px 5px 0px rgba(0, 0, 0, 0.06); margin-right: 10px;"></i> Learn More</span>
							</div>
						</li>
						<li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
							<img src="{{ asset('assets/images/banner/S2.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
							<div class="tp-caption background-block NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-layer-3"
								data-x="['left','left','left','center']" data-hoffset="['375','140','70','0']"
								data-y="['top','top','top','top']"  data-voffset="['530','340','280','80']"
								data-fontsize="['48','48','40','32']"
								data-lineheight="['60','60','52','52']"
								data-width="['561','561','561','400']"
								data-height="['221','221','221','200']"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
								data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
								data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
								data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
								data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
								data-start="1000"
								data-splitin="none"
								data-splitout="none"
								data-responsive_offset="on"
								data-elementdelay="0.05"
								data-paddingtop="[55,55,55,55]"
								data-paddingright="[45,45,45,65]"
								data-paddingbottom="[55,55,55,55]"
								data-paddingleft="[45,45,45,25]"
								style="z-index:3; position:relative; text-transform:uppercase; width: 561px; color:#4c4c4c; height: 221px; font-family: 'Lato', sans-serif; font-weight: 300;">
								<span class="title-txt" style="font-size: 48px; font-weight:bold;">Medical</span> Services <br> You Can <span style="font-weight:bold; font-size: 48px;">Trust</span>
							</div>
							<div class="tp-caption NotGeneric-Button rev-btn learn-btn rs-parallaxlevel-0" id="slide-layer-4"
								data-x="['left','left','left','center']" data-hoffset="['425','190','110','-20']"
								data-y="['top','top','top','top']"  data-voffset="['725','535','475','250']"
								data-fontsize="['18','18','18','18']"
								data-width="['224','224','224','200']"
								data-height="['86','86','86','50']"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
								data-transform_in="x:[105%];s:1000;e:Power4.slideInLeft;"
								data-transform_out="y:[100%];s:1000;s:1000;e:Power2.slideInLeft;"
								data-start="3000"
								data-splitin="none"
								data-splitout="none"
								data-responsive_offset="on"
								data-responsive="off"
								data-paddingtop="[15,15,15,15]"
								data-paddingright="[10,10,10,10]"
								data-paddingbottom="[15,15,15,70]"
								data-paddingleft="[10,10,10,10]"
								style="z-index: 10; border-radius: 0; letter-spacing:0.8px; color: #fff; font-family: 'Poppins', sans-serif; text-transform:capitalize; white-space:nowrap; outline:none; box-shadow:none; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;"><span class="button-txt"><i class="fa fa-stethoscope" style="text-align: center; line-height: 50px; width: 55px; height: 55px; font-size: 24px; border-radius: 50%; background-color: #fff; vertical-align: middle; box-shadow: inset 0px 5px 5px 0px rgba(0, 0, 0, 0.06); margin-right: 10px;"></i> Learn More</span>
							</div>
						</li>
						<li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
							<img src="{{ asset('assets/images/banner/S3.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
							<div class="tp-caption background-block NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-layer-5"
								data-x="['left','left','left','center']" data-hoffset="['375','140','70','0']"
								data-y="['top','top','top','top']"  data-voffset="['530','340','280','80']"
								data-fontsize="['48','48','40','32']"
								data-lineheight="['60','60','52','52']"
								data-width="['561','561','561','400']"
								data-height="['221','221','221','200']"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
								data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
								data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
								data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
								data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
								data-start="1000"
								data-splitin="none"
								data-splitout="none"
								data-responsive_offset="on"
								data-elementdelay="0.05"
								data-paddingtop="[55,55,55,55]"
								data-paddingright="[45,45,45,65]"
								data-paddingbottom="[55,55,55,55]"
								data-paddingleft="[45,45,45,25]"
								style="z-index:3; position:relative; text-transform:uppercase; width: 561px; color:#4c4c4c; height: 221px; font-family: 'Lato', sans-serif; font-weight: 300;">
								<span class="title-txt" style="font-size: 48px; font-weight:bold;">Medical</span> Services <br> You Can <span style="font-weight:bold; font-size: 48px;">Trust</span>
							</div>
							<div class="tp-caption NotGeneric-Button rev-btn learn-btn rs-parallaxlevel-0" id="slide-layer-6"
								data-x="['left','left','left','center']" data-hoffset="['425','190','110','-20']"
								data-y="['top','top','top','top']"  data-voffset="['725','535','475','250']"
								data-fontsize="['18','18','18','18']"
								data-width="['224','224','224','200']"
								data-height="['86','86','86','50']"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
								data-transform_in="x:[105%];s:1000;e:Power4.slideInLeft;"
								data-transform_out="y:[100%];s:1000;s:1000;e:Power2.slideInLeft;"
								data-start="3000"
								data-splitin="none"
								data-splitout="none"
								data-responsive_offset="on"
								data-responsive="off"
								data-paddingtop="[15,15,15,15]"
								data-paddingright="[10,10,10,10]"
								data-paddingbottom="[15,15,15,70]"
								data-paddingleft="[10,10,10,10]"
								style="z-index: 10; border-radius: 0; letter-spacing:0.8px; color: #fff; font-family: 'Poppins', sans-serif; text-transform:capitalize; white-space:nowrap; outline:none; box-shadow:none; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;"><span class="button-txt"><i class="fa fa-stethoscope" style="text-align: center; line-height: 50px; width: 55px; height: 55px; font-size: 24px; border-radius: 50%; background-color: #fff; vertical-align: middle; box-shadow: inset 0px 5px 5px 0px rgba(0, 0, 0, 0.06); margin-right: 10px;"></i> Learn More</span>
							</div>
						</li>
					</ul>
				</div>
			</div><!-- END OF SLIDER WRAPPER -->
		</div><!-- Slider Section /- -->

        <!-- Welcome Section -->
		<div class="welcome-section other-services container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<!-- Section Header -->
				<div class="section-header">
					<h3>Willkommen in unserer Arztpraxis</h3>
				</div><!-- Section Header /- -->
				<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12 our-clinic">
						<div class="row welcome-left">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="other-services-block">
									<div class="services-block-icon">
										<i class="fa fa-users"></i>
									</div>
									<div class="other-services-content">
										<h5>Qualifizierte Ärtze</h5>
										<p>Dolor sit amet consecdi pisicing eliamsed do eiusmod tempornu amet consecdi</p>
									</div>
								</div>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="other-services-block">
									<div class="services-block-icon">
										<i class="fa fa-calendar"></i>
									</div>
									<div class="other-services-content">
										<h5>Online Terminvereinbarung</h5>
										<p>Dolor sit amet consecdi pisicing eliamsed do eiusmod tempornu</p>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 clinic-form">
						<form class="appoinment-form" action="{{url('/')}}" method="get">
							<h5><i class="fa fa-calendar-check-o"></i>Termin vereinbaren</h5>
							<div class="form-group input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Datum auswählen" data-input name="datum">
                                <span class="input-group-text input-group-addon " data-toggle><i class="fa fa-calendar"></i></span>
							</div>
							<button type="submit"  class="btn-submit pull-right"><i class="fa fa-heart-o"></i>Wählen</button>
							<div id="appointment-alert-msg" class="alert-msg"></div>
						</form>
					</div>
				</div>
			</div><!-- Container /- -->
		</div><!-- Welcome Section /- -->

        <!-- Team Section -->
		<div id="team-section" class="team-section container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<!-- Section Header -->
				<div class="section-header">
					<h3>Ärtze</h3>
				</div>
				<div class="team-carousel">
                    @forelse($aerzte_zeigen as $arzt)
                        <div class="col-md-12">
				    		<div class="team-content">
				    			<div class="team-box">
				    				<img src="{{asset('assets/images/users')}}/{{$arzt->bild}}" height="240" width="274" alt="team" />
				    				<h5>{{$arzt->vorname}} {{$arzt->name}}</h5>
				    			</div>
				    			<span class="team-catagory">{{$arzt->fachbereich}}</span>
				    		</div>
				    	</div>
                    @empty
                        <td>Keine Ärtze Verfügbar!</td>
                    @endforelse
				</div>
			</div><!-- Container /- -->
		</div><!-- Team Section /- -->

        <!-- Department Section -->
		<div class="department-section container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<div class="department-header">
					<h5>Spezialitäten</h5>
				</div>
				<div class="row">
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-1.png') }}" alt="dept">
							<span>Neurology</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-2.png') }}" alt="dept">
							<span>Cardiology</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-3.png') }}" alt="dept">
							<span>Dermatology</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-4.png') }}" alt="dept">
							<span>Gastroenterology</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-5.png') }}" alt="dept">
							<span>Pediatrician</span>
						</div>
					</div>

					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-6.png') }}" alt="dept">
							<span>Otolaryngology</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-7.png') }}" alt="dept">
							<span>Hematology</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-8.png') }}" alt="dept">
							<span>Radiation</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-9.png') }}" alt="dept">
							<span>Podiatry</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-6 department-box">
						<div class="department-img-block">
							<img src="{{ asset('frontend/assets/images/dept-10.png') }}" alt="dept">
							<span>Rheumatology</span>
						</div>
					</div>
				</div>
				<div class="show-all">
					<a href="#" title="show all">alles Zeige</a>
				</div>
			</div><!-- Container /- -->
		</div><!-- Department Section -->

    </main>
</div>


@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush
