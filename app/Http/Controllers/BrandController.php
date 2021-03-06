<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;

use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validatedData = $request -> validate([
            'brand_name'=>'required|unique:brands|min:4',
            'brand_image'=>'required|mimes:jpg,jpeg,png',

          
        ],
        [
            'brand_name.required'=>'Please Input Category Name',
            'brand_image.min'=>'Brand longer than 4 character',
          
        ]);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/' ;//where to upload
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);


            //Using intervention
            // $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            // Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

            // $last_img = 'image/brand/'.$name_gen;

            //insert image
        Brand::insert([
            'brand_name' => $request-> brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]) ;
        return Redirect()->back()->with('success','Brand Inserted Successfully');
    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request,$id)
    {
        $validatedData = $request -> validate([
            'brand_name'=>'required|min:4',
        ],
        [
            'brand_name.required'=>'Please Input Category Name',
            'brand_image.min'=>'Brand Longer than 4 character',
          
        ]);

        $old_image = $request->old_image ;
        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/' ;//where to upload
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);
    
            unlink($old_image);
                //insert image
            Brand::find($id)->update([
                'brand_name' => $request-> brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]) ;
            return Redirect()->back()->with('success','Brand Updated Successfully');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request-> brand_name,
                'created_at' => Carbon::now(),
            ]) ;
            return Redirect()->back()->with('success','Brand Updated Successfully');
        }

       
    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

       Brand::find($id)->delete();
       return Redirect()->back()->with('success','Brand Deleted Successfully');
    }

    //  this is for multi image all methods

    public function Multipic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }

    public function StoreImg(Request $request)
    {
        // $image = $request->file('image');

        $image = $request->file('image');
        
        foreach($image as $multi_img){

        
        
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($multi_img->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/multi/' ;//where to upload
        $last_img = $up_location.$img_name;
        $multi_img->move($up_location,$img_name);


            //Using intervention
            // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            // Image::make($image)->resize(300,200)->save('image/multi/'.$name_gen);

            // $last_img = 'image/multi/'.$name_gen;

            //insert image
            Multipic::insert([
            'image' => $last_img,
            'created_at'=>Carbon::now(),
            
        ]) ;
            }   // end of for each 
        return Redirect()->back()->with('success','Brand Inserted Successfully');
    }
}
