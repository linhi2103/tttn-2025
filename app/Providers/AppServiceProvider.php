<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Observers\ModelObserver;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registers();
    }

    public function registers(): void
    {
        $path = app_path('Models');

        if (!File::exists($path)) {
            return;
        }
        
        $models = File::allFiles($path);

        foreach ($models as $model) {
            $name = 'App\\Models\\' . $model->getFilenameWithoutExtension();
            if (class_exists($name) && is_subclass_of($name, Model::class)) {
                if($name !== 'App\\Models\\PasswordResetTokens') {
                    $name::observe(ModelObserver::class);
                }
            }
        }
    }
}
