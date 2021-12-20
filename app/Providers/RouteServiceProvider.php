<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    private $connection;

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            $this->mapApiRoutes();
        });

        $this->connection = env('DB_CONNECTION');

        Route::bind('lang', function ($language) {
            switch ($language) {
                case 'en':
                    $this->connection = env('DB_CONNECTION_ENGLISH');
                    break;

                case 'si':
                    $this->connection = env('DB_CONNECTION_SINHALA');
                    break;
                
                default:
                    $this->connection = env('DB_CONNECTION');
                    break;
            }
            return $this->connection;
        });

        Route::bind('tag', function ($id) {
            return (new Tag())->on($this->connection)->findOrFail($id);
        });

        Route::bind('post', function ($id) {
            return (new Post())->on($this->connection)->findOrFail($id);
        });

        Route::bind('comment', function ($id) {
            return Comment::findOrFail($id);
        });

        Route::bind('role', function ($id) {
            return Role::findOrFail($id);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api/v1/api.php'));
    }
}
