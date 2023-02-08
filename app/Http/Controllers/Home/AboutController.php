<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Image;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function AboutPage(){

        // About model to access abouts table to get specific 1 data
        $aboutpage = About::find(1);
        // in the admin folder, create another folder namely about_page, then create another page call about_page_all
        // passing compact method into about page
        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }

    public function UpdateAbout(Request $request){
        $about_id  = $request->id;

        if($request->file('about_image')){
            $image = $request->file('about_image');
            $new_file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(523,605)->save('upload/home_about/'.$new_file_name);

            $save_url = 'upload/home_about/'.$new_file_name;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => trim($request->short_description),
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'About page is updated successfully with image', 
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => trim($request->short_description),
                'long_description' => $request->long_description,
            ]);
    
            $notification = array(
                'message' => 'About page is updated successfully without image', 
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    public function HomeAbout(){
        
        $aboutpage = About::find(1);
        return view('frontend.about_page', compact('aboutpage'));
    }

    public function AboutMultiImage(){
        
        return view('admin.about_page.multimage');
    }

    public function StoreMultiImage(Request $request){

        $image = $request->file('multi_image');

        foreach ($image as $multi_image) {

            $new_file_name = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();

            Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$new_file_name);

            $save_url = 'upload/multi/'.$new_file_name;

            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Multiple images inserted successfully', 
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
}