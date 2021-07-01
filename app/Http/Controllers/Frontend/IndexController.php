<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactFeedback;
use App\Models\Gallery;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

  
}
