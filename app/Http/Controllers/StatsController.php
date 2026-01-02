<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visitor;

class StatsController extends Controller
{
    public function getStats()
    {
        $visitorCount = Visitor::count();
        $userCount = User::count();

        return response()->json([
            'visitors' => $visitorCount,
            'users' => $userCount
        ]);
    }
}
