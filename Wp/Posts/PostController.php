<?php
namespace Ncc\Wp\Posts;

class PostController
{
    public function __construct(protected PostService $postService)
    {
    }
    public function show($slug)
    {
        $data = $this->postService->service($slug);
        return view('wp-view::post', compact('data'));
    }
}