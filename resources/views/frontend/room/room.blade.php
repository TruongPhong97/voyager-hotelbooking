@extends('frontend.index')

@section('content')

<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>@lang('Rooms')</h2>
            <ul>
                <li><a href="{{route('lang.home', app()->getLocale())}}">@lang('Home')</a></li>
                <li>@lang('Our rooms')</li>
            </ul>
        </div>
    </div>
</div>

<!-- End Service Details Area -->
<section class="room-right-sidebar ptb-100">
    @include('frontend.partials.check-form')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach ($rooms as $room)
                    <div class="flex flex-wrap room-list-item">

                        <div class="room-image">
                            <span class="price">{{ price_per_night($room) }}</span>
                            <img src="{{$room->image}}" alt="Image">
                        </div>

                        <div class="room-content">
                            <h3 class="title">
                                <a href="{{route('room.details', $room->slug)}}">{{$room->title}}</a>
                            </h3>
                            
                            <div class="description">{!! $room->body !!}</div>

                            <div class="flex flex-wrap room-meta">
                                <div class="entry-detail people">
                                    <i class="icon"></i> {{ get_people($room) }}
                                </div>
                                <div class="entry-detail bed">
                                    <i class="icon"></i> {{ get_bed($room) }}
                                </div>
                            </div>                            

                            <div class="action-btn">
                                {{-- <a href="" class="default-btn-outline">@lang('Details')</a> --}}
                                <a href="{{route('room.details', ['locale' => app()->getLocale(), 'slug' => $room->slug])}}" class="default-btn">@lang('Details') <i class="flaticon-right"></i></a>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End Service Details Area -->

@endsection
