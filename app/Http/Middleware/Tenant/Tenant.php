<?php

namespace App\Http\Middleware\Tenant;

use App\Company;
use App\Tenant\Manager;
use Closure;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* resolveTenant -г дуудаад request company байвал 
        параметр дээр нь аргуmент болгож тавина байхгүй бол session -с 
        tenant авч тавина энэ үед компани id олно*/

        $tenant = $this->resolveTenant(
            $request->company ? $request->company : session()->get('tenant')
        );
        
        /*нэвтэрч орсон user ийн relationship method болох companies
        дотор тухайн company_user таарахгүй байвал хүсэлтийг нь буцааж /home руу илгээнэ */
        if (!auth()->user()->companies->contains('id', $tenant->id)) {
            return redirect('/home');
        }
        /*хайж олсон компани мэдээллийг tenent хувьсагч 
        болгон энэ method -н парам дээр дээр тавьж ажилуулна
         */
        $this->registerTenant($tenant);
        //ингээд хүсэлтийг цааш үргэлжлүүлнэ
        return $next($request);
    }
    

    protected function registerTenant($tenant)
    {
            /* appserviceprovider дээр manager класс boot дээр нь бүртгүүлэсэн болохоор
        app method -г дуудаж manager class -г ажилуулж байна settenant дээр нь 
        дээр үүсгэсэн компани мэдээллийг тавьж manager классыг утгатай болгож байна ингэснээр
        manager class цаашдаа tenant-ийн талаарх мэдээллээр ханган ажиллана */
       app(Manager::class)->setTenant($tenant);
       
       /* үүгээр зогсохгүй session дээр тенант id өгч байна*/
       session()->put('tenant', $tenant->id);
    }
    
    /* параметр дээр хүсэлт илгээсэн компаниин id 
    тавих үед тухайн Id-гаар компанийг хайж олно */
    protected function resolveTenant($id)
    {
        return Company::find($id);
    }
}
