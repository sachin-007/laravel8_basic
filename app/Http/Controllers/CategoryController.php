<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){

        $categories = Category::all();
        // to display data 1st we have to do ::latest()->get()
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);
        $trachCat = Category::onlyTrashed()->latest()->paginate(3);
        
        
        //using query builder implement that data
        // $categories = DB::table('categories')->latest()->get();    //get all the data directly
        // $categories = DB::table('categories')->latest()->paginate(5);

        // $categories = DB::table('categories')
        // ->join('users','categories.user_id','users.id')
        // ->select('categories.*','users.name')
        // ->latest()->paginate(5);

        return view('admin.category.index',compact('categories','trachCat'));
    }

    public function AddCat(Request $request){
        $validatedData = $request -> validate([
            'category_name'=>'required|unique:categories|max:255',
          
        ],
        [
            'category_name.required'=>'Please Input Category Name',
            'category_name.max'=>'Category Less Than 255Chars',
          
        ]);

    //Using with ORM

    category::insert([
        'category_name'=> $request->category_name,
        'user_id'=>Auth::user()->id,
        'created_at'=>Carbon::now()
    ]);

    //Using with ORM

    // $category = new Category;
    // $category-> category_name = $request -> category_name;
    // $category->user_id=Auth::user()->id;
    // $category->save();


    // Using with DB Querry Builder
    // $data = array();
    // $data['category_name']=$request->category_name;
    // $data['user_id']=Auth::user()->id;
    // $data['created_at']=Carbon::now();
    // DB::table('categories')->insert($data);


    return Redirect() -> back() -> with('success','category inserted Successfull');
    }

    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request,$id)
    {
        $update = Category::find($id)->update([
            'category_name'=>$request -> category_name,
            'user_id' => Auth::user()->id
        ]);


        return Redirect() -> route('all.category') -> with('success','category Updated Successfull');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete Successfully');
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restored Successfully');
    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','category Permanently Deleted');
    }


}
