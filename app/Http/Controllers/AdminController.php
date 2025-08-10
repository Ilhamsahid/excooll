<?php

namespace App\Http\Controllers;

use App\Services\EkskulService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(EkskulService $ekskulService)
    {
        $ekstra = $ekskulService->getEkskulAllWithRelation();

        return view('admin.main', compact('ekstra'));
    }
}
