<?php

namespace App\Services;

use App\Services\StaffService;
use App\Services\CompanyCountryService;

class PreService
{
    protected $staffService, $countryService, $companyCountryService;
    protected $timezone = 'Asia/Bangkok';

    public function __construct(StaffService $staffService, CompanyCountryService $companyCountryService)
	{
        $this->staffService = $staffService;
        $this->companyCountryService = $companyCountryService;
    }

    public function forPublic()
    {
        $main = app('shared')->get('main');
        $main['company'] = $this->companyCountryService->getFirstCompanyByCountry($main['country']->id);
        $main['timezone'] = $main['company']->timezone ?? $this->timezone;
        app('shared')->set('main', $main);
    }

    public function forAdmin()
    {
        $admin = $this->staffService->getCurrent();
        if (isset($admin)) {
            $others = ['timezone' => $admin->active_company->timezone ?? $this->timezone];
            app('shared')->set('admin', $admin);
            app('shared')->set('others', $others);
        }
    }
}