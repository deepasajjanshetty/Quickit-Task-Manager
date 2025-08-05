<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DealsController extends Controller
{
    public function index()
    {
        return Inertia::render('Deals');
    }
} 