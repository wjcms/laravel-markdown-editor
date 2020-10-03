<?php
namespace wjcms\laravelmd;

use Illuminate\Support\ServiceProvider;

class LarvelmdServiceProvider extends ServiceProvider
{
   
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../vendor' => public_path('vendor'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/layouts/md'),
        ], 'views');
    }

}
