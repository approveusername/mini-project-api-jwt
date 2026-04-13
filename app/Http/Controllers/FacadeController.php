<?php

namespace App\Http\Controllers;

use App\Services\CustomGreetingService;
use App\Facades\CustomGreetingFacade; // Import the facade

class FacadeController extends Controller
{
    // Inject the service via the constructor (dependency injection)
    protected $greetingService;

    public function __construct(CustomGreetingService $greetingService)
    {
        $this->greetingService = $greetingService;
    }

    // Method to show greeting using the injected service
    public function showUsingService($name)
    {
        return $this->greetingService->greet($name);
    }

    // Method to show greeting using the facade
    public function showUsingFacade($name)
    {
        return Greeting::greet($name); // Using the facade to call the service
    }
}
