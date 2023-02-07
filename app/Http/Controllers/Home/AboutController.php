<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Image;

class AboutController extends Controller
{
    public function AboutPage(){

        // About model to access abouts table to get specific 1 data
        $aboutpage = About::find(1);
        // in the admin folder, create another folder namely about_page, then create another page call about_page_all
        // passing compact method into about page
        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }
}