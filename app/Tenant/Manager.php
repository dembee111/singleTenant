<?php 

namespace App\Tenant;

class Manager 
{
	protected $tenant;

    /* setTenant --р мэдээллийг авна*/
	public function setTenant($tenant)
	{
		$this->tenant = $tenant;

	}
    
    //getTenant -р авсан мэдээллээ өөр газарт гаргана 
	public function getTenant()
	{
		return $this->tenant;
	}
}

 ?>