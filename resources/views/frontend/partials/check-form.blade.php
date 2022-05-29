<div class="check-area mb-minus-70">
    <div class="container">
    <form class="check-form" action="{{ route('room.available', app()->getLocale()) }}">
            <div class="row align-items-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="check-content">
                        <p>Checkin Date</p>
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker-1">
                                <i class="flaticon-calendar"></i>
                                <input type="text" class="form-control" name="check_in" autocomplete="off" value="{{ $request->check_in ?? date('d/m/Y') }}">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                            
                <div class="col-lg-3 col-sm-6">
                    <div class="check-content">
                        <p>Checkout Date</p>
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker-2">
                                <i class="flaticon-calendar"></i>
                                <input type="text" class="form-control" name="check_out" autocomplete="off" value="{{ $request->check_out ?? date('d/m/Y', strtotime('+1 day')) }}">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="check-content">
                                <p>Adults</p>
                                <div class="form-group">
                                    <select name="adult" class="form-content">
                                        @for ($i = 1; $i < 6; $i++)
                                            <option @if(isset($request) AND $request->adult == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="check-content">
                                <p>Children</p>
                                <div class="form-group">
                                    <select name="children" class="form-content">
                                        @for ($i = 0; $i < 5; $i++)
                                            <option @if(isset($request) AND $request->children == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="check-btn check-content mb-0">
                        <button class="default-btn">
                            Check Availability
                            <i class="flaticon-right"></i>
                        </button>
                    </div> 
                </div>
            </div>
        </form>
    </div>
</div>