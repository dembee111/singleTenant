<?php

namespace App\Providers;

use App\Tenant\Manager;
use App\Tenant\Observers\TenantObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* manager class тенантыг мэдээллээр байнга хангах
         зорилготой учир bootstrap дээр шууд ачааллуулж байна
        */
        $this->app->singleton(Manager::class, function(){
            return new Manager();
        });
         /* tenantObserver -н парам дээр manager-class-с getTenant method -р
         tenant object-г авч байрлуулж байна ингэснээр тенант обьектын файл 
         үүсгэх процессыг хянах боломжтой болж байна*/
         $this->app->singleton(TenantObserver::class, function(){
            return new TenantObserver(app(Manager::class)->getTenant());
        });
         /* middleware deer getTenant aar tenant object utga awhad zoriulj tenant()
         macrobale beldej bna*/
         Request::macro('tenant', function(){
             return app(Manager::class)->getTenant();
         });
    }
}
