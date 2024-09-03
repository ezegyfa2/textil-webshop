<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {

            $this->mapWebsiteRoutes();
            $this->mapAdminRoutes();
            $this->mapApiRoutes();
        });
    }

    protected function mapWebsiteRoutes(): void
    {
        Route::middleware(['web'])
            ->group(function () {
                Route::group([], base_path('routes/website/web.php'));
            });
    }

    protected function mapAdminRoutes(): void
    {
        Route::middleware('admin')
            ->group(function () {

                Route::prefix('admin')
                    ->name('admin:')
                    ->group(base_path('routes/admin/auth.php'));

                Route::middleware(['auth:admin'])
                    ->prefix('admin/profile')
                    ->name('admin:')
                    ->group(base_path('routes/admin/profile.php'));

                Route::middleware(['auth:admin', 'verified']) // 'role:admin|superadmin'
                    ->prefix('admin')
                    ->name('admin:')
                    ->group(base_path('routes/admin/web.php'));

                Route::middleware(['auth:admin', 'verified'])
                    ->prefix('admin')
                    ->name('admin:')
                    ->group(base_path('routes/admin/devops.php'));
            });

        Route::middleware('api')
            ->name('admin:api:')
            ->prefix('admin/api')
            ->group(base_path('routes/admin/api.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::middleware('throttle:api')
            ->as('passport.')
            ->prefix(config('passport.path', 'oauth'))
            ->namespace('\Laravel\Passport\Http\Controllers')
            ->group(base_path('routes/api/passport.php'));

        Route::middleware(['api', 'client'])
            ->prefix('api')
            ->group(base_path('routes/api/api.php'));
    }
}
