<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
use App\Slide;
use App\Room;


class CustomHomeController extends Controller
{
    
	public function index(Request $request){		

		$locale = $request->segment(1) ?? config('voyager.multilingual.default');

		$home = Page::find( setting('site.homepage_id') );
		
		$data = json_decode($home->body, true);
		
		$slides = Slide::all();

		return view('frontend.page.home', compact('locale', 'slides', 'data'));
	}

}
