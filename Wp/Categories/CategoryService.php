<?php
namespace Ncc\Wp\Categories;

class CategoryService
{
    public function __construct(
        protected CategoryLoader $loader
    )
    {
    }
    public function service($slug)
    {
        $data = $this->loader->loader($slug);
        return $data;
        // Logic to retrieve category by slug
        // return [
        //     'name' => 'Example Category',
        //     'slug' => $slug,
        //     'description' => 'This is an example category description.',
        // ];
    }
}