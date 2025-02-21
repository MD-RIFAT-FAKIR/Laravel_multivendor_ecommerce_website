<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //all category
    public function AllCategory() {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    //add category
    public function AddCategory() {
        return view('backend.category.category_add');
    }
}
