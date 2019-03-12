<?php 

namespace App\Tenant\Traits;

use App\Tenant\Manager;
use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait ForTenants

{
	public static function boot()
	{
		parent::boot();

        /* app method- г ашиглан manager class -г хялбархан обьект болгож байна */
		$manager =app(Manager::class);
        /* tenantScope class дээр manager class-н мэдээллийг тависнаар
        project болон бусад моделууд use method--р хөнгөн авч ашиглах боломжыг 
        бүрдүүлж байна*/
		static::addGlobalScope(
            new TenantScope($manager->getTenant())
		);
        /* апп методоор TenantObserver class-г дуудаж оруулж ирж байна
        ингэснээр модел дээр шууд ачааллах боломжтой болж байна*/
		static::observe(
           app(TenantObserver::class)
		);
	}
}

 ?>