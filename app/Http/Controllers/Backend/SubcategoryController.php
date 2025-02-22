<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategor;

class SubcategoryController extends Controller
{
    //all subcategory
    public function AllSubcategory() {
        $subcategory = Subcategor::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subcategory'));
    }//end

    //add subcategory
    public function AddSubcategory() {
        $category = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('category'));
    }//end

    //store subcategory
    public function StoreSubcategory(Request $request) {
        Subcategor::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace('','-',$request->subcategory_name))
        ]);

        $notification = array (
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.subcategory')->with($notification);
 
    }//end

    //edit subcategory
    public function EditSubcategory($id) {
        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategor::findOrFail($id);

        return view('backend.subcategory.subcategory_edit', compact('category', 'subcategory'));
    }
}
