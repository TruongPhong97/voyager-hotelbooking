<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(){

    }

    public function upload( Request $request ){

    	if( $request->file('image') ){

    		$file = $request->image;

    		$fileName = $file->getClientOriginalName();

    		$file_url = $file->storeAs( 'public', $fileName );

            return response()->json(compact('file_url'));
    	}

    }
}
