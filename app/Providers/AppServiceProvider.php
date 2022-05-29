<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// update
use TCG\Voyager\Facades\Voyager;
use App\Classes\STA_Image;
use App\Classes\Image_Gallery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(STA_Image::class);
        Voyager::addFormField(Image_Gallery::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
