<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use App\Room;
use \Illuminate\Support\Str;

class RoomController extends Controller
{
    public function available(Request $request)
    {
        $bookDate['check_in'] = Carbon::createFromFormat('d/m/Y', $request->check_in)->toDateTimeString();
        $bookDate['check_out'] = Carbon::createFromFormat('d/m/Y', $request->check_out)->toDateTimeString();
        $adult = $request->adult;
        $children = $request->children;
        $max_people = $adult + $children;

        $checkAttributes = array(
            'check_in' => $bookDate['check_in'],
            'check_out' => $bookDate['check_out'],
            'adult' => $adult,
            'children' => $children,
            'max_people' => $max_people
        );

        $rooms = Room::get(['id', 'number']);
        
        $notAvaiRoom = [];
        foreach( $rooms as $room ){
            
            $total_booked = Booking::select('qty')
            ->where('room_id', $room->id)
            ->where( function($query) use ($bookDate){
                $query->where([
                    ['check_in', '<', $bookDate['check_in']],
                    ['check_out', '>', $bookDate['check_in']]
                ])->orWhere([
                    ['check_in', '<', $bookDate['check_out']],
                    ['check_out', '>', $bookDate['check_out']]
                ]);
            })
            ->sum('qty');

            if( $total_booked >= $room->number ){
                $notAvaiRoom[] = $room->id;
            }
        }

        $rooms = Room::whereNotIn('id', $notAvaiRoom)->get();

        session([
            'available_room' => $rooms,
            'check_attributes' => $checkAttributes
        ]);

        return view('frontend.room.room', compact('rooms', 'request'));
    }

    public function details(Request $request)
    {
        $room = Room::where('slug', $request->slug)->firstOrFail();
        return view('frontend.room.details', compact('room'));
    }

    public function index()
    {
        $rooms = Room::all();
        return view('frontend.room.room', compact('rooms'));
    }

    public function checkSingleRoom(Request $request)
    {

        $check_in = Carbon::createFromFormat('d/m/Y', $request->check_in);
        $check_out = Carbon::createFromFormat('d/m/Y', $request->check_out);
        $bookDate['check_in'] = $check_in->toDateTimeString();
        $bookDate['check_out'] = $check_out->toDateTimeString();

        $room = Room::select(['title', 'price'])->where('id', $request->room_id)
            ->whereNotIn('id', function ($query) use ($bookDate) {
                $query->select('room_id')->from('bookings')
                    ->where([
                        ['check_in', '<', $bookDate['check_in']],
                        ['check_out', '>', $bookDate['check_in']]
                    ])
                    ->orWhere([
                        ['check_in', '<', $bookDate['check_out']],
                        ['check_out', '>', $bookDate['check_out']]
                    ]);
            })
            ->first();

        $people = $request->adult . ' ' . Str::plural(__('adult'), $request->adult);
        if ($request->children > 0) {
            $people .= ', ' . $request->children . ' ' . Str::plural(__('child'), $request->children);
        }
        $room->title = $room->title . ' ' . $request->check_in . ' - ' . $request->check_out;
        $room->people = $people;
        $room->total_price = get_price($room->price * $check_in->diffInDays($check_out));
        $room->total_night = $check_in->diffInDays($check_out) . ' ' . Str::plural(__('night'), $check_in->diffInDays($check_out));

        return view('frontend.room.available-single-room', compact('room'));
    }
}
