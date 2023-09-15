<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryAssetRequest;
use App\Http\Requests\UpdateCategoryAssetRequest;
use App\Models\CategoryAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryAssetController extends Controller
{
    public function index() {

        $title = "Category";
        $categories = CategoryAsset::latest()->get();
        return view('dashboard.category.index', compact('title', 'categories'));
    }

    public function store(StoreCategoryAssetRequest $request) {
        $data = $request->validated();
        CategoryAsset::create($data);

        return Redirect::route('index_category')->with('success', 'Data category has been inserted succesfully');
    }

    public function update(UpdateCategoryAssetRequest $request, string $id) {
        $data = $request->validated();

        CategoryAsset::find($id)->update($data);

        return Redirect::route('index_category')->with('success', 'Category has been updated');
    }

    public function destroy(string $id){
        CategoryAsset::find($id)->delete();

        return Redirect::back()->with('success', 'Data Category has been deleted');
    }
}
