<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        return \view('student.dashboard');
    }

    public function instructorRegistration()
    {
        return \view('student.instructor-request');
    }
}
