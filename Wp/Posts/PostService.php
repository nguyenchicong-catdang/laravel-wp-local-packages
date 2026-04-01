<?php
namespace Ncc\Wp\Posts;
class PostService
{
    public function __construct(protected PostLoader $postLoader)
    {
    }
    public function service($slug)
    {
        $data = $this->postLoader->load($slug);
        return $data;
    }
}