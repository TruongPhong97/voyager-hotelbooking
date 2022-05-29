@extends('frontend.index')

@php
    print_r(session('checkAttributes'))
@endphp

@section('content')

    <div class="page-title-area" style="background-image: url({{ $room->image }})">
        <div class="container">
            <div class="page-title-content">
                <h2>{{$room->title}}</h2>
                <ul>
                    <li>{{ get_people($room) }}</li>
                    <li>{{ price_per_night($room) }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- End Service Details Area -->
    <section class="room-details-content room-details-right-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="gallery-slider">

                        <div id="room-main-slider" class="owl-carousel owl-theme">

                            @php
                                $gallery = explode(',' ,$room->gallery);
                            @endphp
                        
                            @foreach ($gallery as $item)
                                <div class="room-gallery-item">
                                    <img src="{{$item}}" alt="Image">
                                </div>
                            @endforeach
                        
                        </div>
                        
                        <div class="slider-nav-bar flex">
                            <div id="room-nav-slider" class="owl-carousel owl-theme">
                                @foreach ($gallery as $item)
                                    <div class="nav-item">
                                        <img src="{{$item}}" alt="Image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="service-details-wrap service-right">

                        <h3>{{$room->title}}</h3>
                        
                        {!! $room->body !!}

                    </div>
                </div>
    
                <div class="col-lg-4">
                    <div class="service-sidebar-area">
                        <div class="single-checkform service-card">
                            <h3 class="service-details-title">Book Now</h3>
                            <div class="single-checkform-area">
                                <div class="row">
                                    <form id="check_single_room" action="{{ route('checkSingleRoom') }}">
                                        <div class="col col-md-6 col-sm-12">
                                            <label for="datetimepicker-1" class="form-label">Check in</label>
                                            <div class="input-group date" id="datetimepicker-1">
                                                <input type="text" class="form-control" name="check_in" autocomplete="off" value="{{ request()->check_in ?? date('d/m/Y') }}">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col col-md-6 col-sm-12">
                                            <label for="datetimepicker-2" class="form-label">Check out</label>
                                            <div class="input-group date" id="datetimepicker-2">
                                                <input type="text" class="form-control" name="check_out" autocomplete="off" value="{{ request()->check_out ?? date('d/m/Y', strtotime('+1 day')) }}">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col col-md-6 col-sm-12">
                                            <label for="adult" class="form-label">Adult</label>
                                            <div class="input-group">
                                                <select name="adult" class="form-content">
                                                    @for ($i = 1; $i < $room->max_adult+1; $i++)
                                                    <option @if(request()->adult == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6 col-sm-12">
                                            <label for="children" class="form-label">Children</label>
                                            <div class="input-group">
                                                <select name="children" class="form-content">
                                                    @for ($i = 0; $i < $room->max_children+1; $i++)
                                                    <option @if(request()->children == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-12 col-sm-12">
                                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn default-btn">Check</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="service-list service-card">
                            <h3 class="service-details-title">@lang('Facilities')</h3>
                            <ul>
                                <li>
                                    Luxury Room
                                    <i class='bx bx-check'></i>
                                </li>
                                <li>
                                    Tips
                                    <i class='bx bx-check'></i>
                                </li>
                                <li>
                                    Budget Room
                                    <i class='bx bx-check'></i>
                                </li>
                                <li>
                                    Ecorik 
                                    <i class='bx bx-check'></i>
                                </li>
                            </ul>
                        </div>
                        <div class="service-faq service-card">
                            <h3 class="service-details-title">FAQ</h3>
                            <div class="faq-area">
                                <div class="questions-bg-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="faq-accordion">
                                                <ul class="accordion">
                                                    <li class="accordion-item">
                                                        <a class="accordion-title active" href="javascript:void(0)">
                                                            <i class='bx bx-chevron-down'></i>
                                                            Is Reception Open 24 Hours?
                                                        </a>
                                                        <p class="accordion-content show">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                    </li>
                                                    <li class="accordion-item">
                                                        <a class="accordion-title" href="javascript:void(0)">
                                                            <i class='bx bx-chevron-down'></i>
                                                            Can I Leave My Luggage?
                                                        </a>
                                                        <p class="accordion-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                    </li>
                                                    <li class="accordion-item">
                                                        <a class="accordion-title" href="javascript:void(0)">
                                                            <i class='bx bx-chevron-down'></i>
                                                            Which One Is The Nearest Airport?
                                                        </a>
                                                        <p class="accordion-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                    </li>
                                                    <li class="accordion-item">
                                                        <a class="accordion-title" href="javascript:void(0)">
                                                            <i class='bx bx-chevron-down'></i>
                                                            Can I Rent A Car At The Hotel Nearby?
                                                        </a>
                                                        <p class="accordion-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="service-list service-card">
                            <h3 class="service-details-title">Contact Info</h3>
                            <ul>
                                <li>
                                    <a href="tel:+8006036035">
                                        +800 603 6035
                                        <i class='bx bx-phone-call bx-rotate-270'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://templates.envytheme.com/cdn-cgi/l/email-protection#2f474a4343406f4a4c405d4644014c4042">
                                        <span class="__cf_email__" data-cfemail="2048454c4c4f6045434f52494b0e434f4d">[email&#160;protected]</span>
                                        <i class='bx bx-envelope'></i>
                                    </a>
                                </li>
                                <li>
                                    123, Western Road, Australia
                                    <i class='bx bx-location-plus'></i>
                                </li>
                                <li>
                                    9:00 AM – 8:00 PM
                                    <i class='bx bx-time'></i>
                                </li>
                            </ul>
                        </div>
                        <div class="service-list service-card">
                            <h3 class="service-details-title">Download Brochures</h3>
                            <ul>
                                <li>
                                    <a href="#">
                                        PDF File (1)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        PDF File (2)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        PDF File (3)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        PDF File (4)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Service Details Area -->
@endsection

@push('css')
<style>
    .page-title-area{
        padding-bottom: 300px;
    }
    .page-title-area .container{
        bottom: 0;
        width: 100%;
        max-width: unset;
        position: absolute;
        padding-bottom: 15px;
        background: linear-gradient(0deg, #363636 10%, transparent 95%);
    }
    .page-title-area::before{
        opacity: 0.2;
    }
</style>
    <link rel="stylesheet" href="{{ asset('assets/frontend/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/slick/slick-theme.css') }}">
@endpush

@push('javascript')
    <script type="text/javascript" src="{{ asset('assets/frontend/slick/slick.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('#room-main-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                pauseOnHover: false,
                autoplaySpeed: 4000,
                asNavFor: '#room-nav-slider'
            });
            
            $('#room-nav-slider').slick({
                asNavFor: '#room-main-slider',
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                focusOnSelect: true
            });

            $('#check_single_room').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        // console.log(response);
                        console.log($('.single-checkform-area').children('.single-checkform-result').remove());
                        $('.single-checkform-area').append(response);
                    }
                });
            });

        });
    </script>
@endpush
