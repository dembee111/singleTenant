<?php 

namespace App\Tenant\Observers;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class TenantObserver
{
	protected $tenant;

    /* fortenant хэсэгт харуулах зорилгоор байгуулагч функц үүсгэж байна*/ 
	public function __construct(Model $tenant)
	{
		$this->tenant = $tenant;
	}


	public function creating(Model $model)
	{
        /* хэрвээ энэ дээд байгуулагч функцын парам дээр утга тавьбал
        ажиллаж tenant property-c object-н getForeignKey функц ашиглаж
        компани айдиг авч байна */
		$foreignKey = $this->tenant->getForeignKey();


        /*хэрвээ гадаад кей байхгүй байвал */
		if (!isset($model->{$foreignKey})) {
			$model->setAttribute($foreignKey, $this->tenant->id);
		}
	}

}


 ?>