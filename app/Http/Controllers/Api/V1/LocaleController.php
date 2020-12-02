<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LocaleCollection;
use App\Http\Resources\Api\V1\LanguageResource;
use App\Http\Resources\BaseJsonResource;
use App\Services\CountryService;
use App\Services\CountryLanguageService;
use Illuminate\Http\Request;

/**
 * Api controller for countries
 */
class LocaleController extends Controller
{
    /**
     * @var App\Services\CountryService $countryService
     * @var App\Services\CountryLanguageService $countryLanguageService
     */
    protected $countryService;
    protected $countryLanguageService;
    
    /**
     * Initialization
     * 
     * @param App\Services\CountryService $countryService
     * @param App\Services\CountryLanguageService $countryLanguageService
     */
    public function __construct(CountryService $countryService, CountryLanguageService $countryLanguageService)
    {
        $this->countryService = $countryService;
        $this->countryLanguageService = $countryLanguageService;
    }

    /**
     * Get list of locales
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\LocaleCollection
     */
    public function index(Request $request)
    {
        return (new LocaleCollection($this->countryService->getAvailable()));
    }

    /**
     * Check if a locale is available
     *
     * @param Request $request
     * @param string $country
     * @param string $language
     * @return App\Http\Resources\Api\V1\LocaleCollection
     */
    public function check(Request $request, $country, $language)
    {
        $status = ['enabled', 'draft'];
        $locale = $this->countryLanguageService->getBothByCode($country, $language);
        if (!(!empty($locale) && (in_array($locale->status_public, $status) && in_array($locale->pivot->status, $status)))) {
            $locale = $this->countryLanguageService->getTopRankLanguageByCode($country, ['except' => $language]);
        }
        return (new BaseJsonResource(
            LanguageResource::class,
            $locale)
        )->run();
    }
}
