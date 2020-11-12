<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Toastr;
use File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Banner::latest()->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:banners|max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('slider')) {
                Storage::disk('public')->makeDirectory('slider');
            }
            // $slider = Image::make($image)->resize(1600, 480)->save();
            Storage::disk('public')->put('slider/' . $imagename, \File::get($image));
//            if (config('app.env') == 'test') {
//                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/slider/'. $imagename;
//                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/slider/' . $imagename;
//                File::copy($full_path_source, $full_path_dest);
//            }
        } else {
            $imagename = 'default.png';
        }

        $slider = new Banner();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $imagename;
        $slider->save();

        Toastr::success('message', 'Thêm banner thành công');
        return redirect()->route('admin.sliders.index');
    }

    public function edit($id)
    {
        $slider = Banner::find($id);

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        $slider = Banner::find($id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('slider')) {
                Storage::disk('public')->makeDirectory('slider');
            }
            if (Storage::disk('public')->exists('slider/' . $slider->image)) {
                Storage::disk('public')->delete('slider/' . $slider->image);
            }
            // $sliderimg = Image::make($image)->resize(1600, 480)->save();
            // Storage::disk('public')->put($imagename, $sliderimg);
            // $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put('slider/' . $imagename, \File::get($image));
//            if (config('app.env') == 'test') {
//                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/slider/'. $imagename;
//                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/slider/' . $imagename;
//                File::copy($full_path_source, $full_path_dest);
//            }
        } else {
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $imagename;
        $slider->save();

        Toastr::success('message', 'Sửa banner thành công');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($id)
    {
        $slider = Banner::find($id);

        if (Storage::disk('public')->exists('slider/' . $slider->image)) {
            Storage::disk('public')->delete('slider/' . $slider->image);
        }

        $slider->delete();

        Toastr::success('message', 'Xoá Banner thành công');
        return back();
    }
}
