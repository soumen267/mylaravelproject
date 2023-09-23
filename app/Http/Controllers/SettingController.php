<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function store(){
        abort_if(! auth()->guard('admin')->user(), 403);
        $banner = Image::first('url');
        $logo = Logo::first('url');
        return view('settings.index',compact('banner','logo'));
    }

    public function update(Request $request){
        $request->validate([
            'bannerimage' => 'required',
            'logo' => 'required'
        ]);

        if ($request->hasFile('bannerimage')) {
            // foreach ($request->file('bannerimage') as $file) {
                $bannerimagename = Image::first('url');
                if($bannerimagename != null){
                $imagePath = public_path('public/images/banner/'.$bannerimagename->url);
                  if(File::exists($imagePath)){
                        File::delete($imagePath);
                  }
                }                
                $file = $request->file('bannerimage');
                $name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('public/images/banner', $name);
                $image = new Image;
                $image->url = $name;
                $image->save();
            // }
        }

        if ($request->hasFile('logo')) {
            $logoimagename = Image::first('url');
            if($logoimagename != null){
                $imagePath1 = public_path('public/images/logo/'.$logoimagename->url);
                if(File::exists($imagePath1)){
                    File::delete($imagePath1);
                }
            }
            $file = $request->file('logo');
            $imagename = time().rand(1,50).'.'.$file->extension();
            $file->storeAs('public/images/logo', $imagename);
            $image = new Logo;
            $image->url = $imagename;
            $image->save();
        }
        return redirect(route('settings.index'))->with('success', 'Successfully upload images.');
    }
    
}
