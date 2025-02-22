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
    }
}
