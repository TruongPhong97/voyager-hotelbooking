<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }
}
