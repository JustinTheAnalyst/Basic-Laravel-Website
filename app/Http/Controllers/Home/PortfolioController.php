<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Image;
use Illuminate\Support\Carbon;


class PortfolioController extends Controller
{
    public function AllPortfolio(){
        
        $allPortfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('allPortfolio'));
    }

    public function AddPortfolio(Request $request){
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request){

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio name is required',
            'portfolio_title.required' => 'Portfolio title is required',
            'portfolio_image.required' => 'Portfolio image is required',
        ]);

        $image = $request->file('portfolio_image');
        $new_file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$new_file_name);

        $save_url = 'upload/portfolio/'.$new_file_name;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Portfolio inserted successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id){

        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request){

        $portfolio_id  = $request->id;

        if($request->file('home_slide')){
            $image = $request->file('home_slide');
            $new_file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$new_file_name);

            $save_url = 'upload/portfolio/'.$new_file_name;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Portfolio with image has been updated successfully', 
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);
    
            $notification = array(
                'message' => 'Portfolio without image has been updated successfully', 
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }
}