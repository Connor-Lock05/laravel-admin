<?php

namespace ConnorLock05\LaravelAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Process;
use Illuminate\View\View;

class ArtisanController extends Controller
{
    public function show(): View
    {
        return view('admin::artisan');
    }

    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'command' => 'nullable',
        ]);

        $process = Process::command(
            config('laravel-admin.php_executable') . " artisan " . $validated['command']
        )
            ->path(base_path())
            ->run();

        $output = htmlentities($process->output());
        $output = preg_replace("/\e\[[0-9;]*m/", '', $output);

        return response()->json([
            'output' => $output,
        ]);
    }
}
