<div class="row single-checkform-result">
    <div class="available-single-room">
        <div class="data">
            <div class="info">
                <span class="title">{{$room->title}}</span>
                <br>
                <span class="people">{{$room->people}}</span>
            </div>
            <div class="price">
                <span class="total-price">{{$room->total_price}}</span>
                <span class="total-night">{{$room->total_night}}</span>
            </div>
        </div>
        <a class="booking-badge">{{ __('Book now') }}</a>
    </div>
</div>