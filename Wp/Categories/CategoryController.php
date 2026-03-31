<?php
namespace Ncc\Wp\Categories;

class CategoryController
{
    public function show(CategoryService $service, $slug)
    {
        $data = $service->service($slug);
        return view('wp-view::category', compact('data'));
    }
}