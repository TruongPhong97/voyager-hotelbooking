<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;

class HomepageContentController extends Controller
{
    public function content()
    {
        $home = Page::find( setting('site.homepage_id') );
        $data = json_decode($home->body, true);
        
        return view('admin.HomepageContent', compact('data'));
    }

    public function update(Request $request)
    {
        $home = Page::find( setting('site.homepage_id') );
        $home->body = $request->except('_token', '_method');
        $home->save();

        return redirect()->back();
    }
}
