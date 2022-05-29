<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;

class PagebuilderController extends Controller
{
    public function index(Request $request)
    {
        $content = Page::select('body')->where('id', $request->page_id)->get();
        $data = json_decode($content[0]['body'], true);
        return view('admin.pagebuilder.index', $data);
    }

    public function upload(Request $request)
    {
        $files = $request->file('files');
        $assets = [];

        foreach ($files as $key => $file) {
            $directory = "assets/img/pagebuilder/";
            @mkdir($directory, 0775, true);
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);


            $path = url($directory . $filename);
            $name = $file->getClientOriginalName();

            $assets[] = [
                'name' => $name,
                'type' => 'image',
                'src' =>  $path,
                'height' => 350,
                'width' => 250
            ];
        }

        return response()->json(['data' => $assets]);
    }

    public function remove(Request $request)
    {
        $path = str_replace(url('/') . '/', '', $request->path);
        @unlink($path);
    }

    public function save(Request $request)
    {

        $page = Page::find($request->id);

        $data['css'] = $request->css;
        $data['style'] = $request->styles;
        $data['html'] = "<div class='pagebuilder-content'>" . $request->html . "</div>";
        $data['components'] = $request->components;

        $page->body = $data;
        $page->save();

        return "success";
    }
}
