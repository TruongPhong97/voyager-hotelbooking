<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;

class PageController extends Controller
{
    public function dynamicpage(Request $request, $slug)
    {
        if( $request->route()->getPrefix() ){
            $locale = $request->segment(1) ?? config('voyager.multilingual.default');
            $slug = $request->segment(2);
            $page = Page::whereTranslation('slug', '=', $slug, [$locale])->firstOrFail();
            $content = $page->getTranslatedAttribute('body', $locale);
        }else{
            $page = Page::where('slug', $slug)->firstOrFail();
            $content = $page->body;
        }
        return view('frontend.page.dynamic', compact('content'));
    }
}
