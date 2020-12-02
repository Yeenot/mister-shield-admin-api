<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CompletedServiceCollection;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class LatestCompletedServiceController extends Controller
{
    /**
     * @var AppointmentService
     */
    private $appointmentService;

    /**
     * Initialization
     * 
     * @param App\Services\AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    /**
     * Get list of latest completed services
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\CompletedServiceCollection
     */
    public function index(Request $request, $company)
    {
        request()->merge(['status' => 'completed']);
        return (new CompletedServiceCollection(
            $this->appointmentService->getWithPublicServices(
                $company,
                null,
                [[ 'column' => 'serviced_at', 'dir' => 'DESC']],
                ['limit' => 10]
            )
        ));
    }
}
