<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Project;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'projects' => Project::query()->published()->ordered()->get(),
            'activities' => Activity::query()->published()->ordered()->get(),
        ]);
    }
}
