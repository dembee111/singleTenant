<?php 

namespace App\Tenant\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope

{
	protected $tenant;
    
    /* энэхүү классыг өөр газар ажиллуулах 
    зорилгоор байгуулагч функц бэлдэж байна manager-н 
    getTenant method -g param deer tawij ajluulna*/
	public function __construct(Model $tenant)
	{
		$this->tenant = $tenant;
	}
	/* ForTenant - trait ашиглах query бэлдэж байна компани id тай тэнцэх тенант айди*/
    public function apply(Builder $builder, Model $model)
    {
    	return $builder->where('company_id', '=', $this->tenant->id);
    }
}


 ?>