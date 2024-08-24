<?php

namespace ConnorLock05\LaravelAdmin\Controllers;

use ConnorLock05\LaravelAdmin\Services\ModelService;
use Illuminate\Routing\Controller;

class AdminPanelController extends Controller
{
    public function __construct(
        private ModelService $modelService,
    )
    {
    }

    public function index()
    {
        $models = $this->modelService->getModels();

        return view('admin::dashboard', compact(
            'models'
        ));
    }
}