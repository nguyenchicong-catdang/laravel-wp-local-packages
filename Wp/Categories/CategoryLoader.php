<?php
namespace Ncc\Wp\Categories;

use Corcel\Model\Taxonomy;

class CategoryLoader extends Taxonomy
{
    protected $connection = 'wp';
    public function loader(string $slug = '')
    {
        return $this->loaderWp($slug);
    }

    private function loaderWp(string $slug = '')
    {
        $dataCategoryCard = $this->getCategoryCard($slug);
        $dataPosts = $this->getAllPosts($slug);

        return [
            'category_card' => $dataCategoryCard,
            'posts' => $dataPosts
        ];

    }

    private function getCategoryCard(string $slug = '')
    {
        $data = $this::category()->slug($slug)->firstOrFail();
        // Logic to load categories, e.g., from a database or an API
        return [
            'name'        => $data?->term?->name,
            'slug'        => $data?->term?->slug,
            'description' => $data?->description, // Lưu ý: description thường nằm ở table taxonomy, không phải term
            'total_posts' => $data?->count, // Số lượng bài viết trong category này
        ];
        
    }

    private function getAllPosts(string $slug = '')
    {
        $category = $this::category()->slug($slug)->firstOrFail();
        $posts = $category->posts()->get(); // Lấy tất cả bài viết thuộc category này

        return $posts->map(function ($post) {
            return [
                'title' => $post->post_title,
                'slug' => $post->slug,
                'excerpt' => $post->post_excerpt,
                'thumbnail_alt' => $post->thumbnail?->attachment?->alt ?? 'alt default', // Nếu bạn đã thiết lập quan hệ thumbnail trong model Post
                // 'thumbnail_url' => $post->thumbnail?->size('thumbnail') ?? '/uploads/default.jpg', // URL ảnh thumbnail, có fallback nếu không có
                'dev' => $post->toArray(), // Thêm dòng này để xem toàn bộ dữ liệu của bài viết
            ];
        })->all();

        // app(\Ncc\Wp\Categories\CategoryLoader::class)->test();
    }

    public function devGetAllCategories()
    {
        $data = $this->category()->get();
        //return $data;
        // Cách này sẽ trả về 1 Collection chỉ chứa các chuỗi String (tên)
        return $data->map(function ($item) {
            return [
                'name' => $item->term->name,
                'slug' => $item->term->slug,
                ];
        })->all(); // Thêm ->all() nếu muốn chuyển về array thuần PHP

        // app(\Ncc\Wp\Categories\CategoryLoader::class)->test();
    }

    public function test(string $slug = '')
    {
        $category = $this::category()->slug($slug)->firstOrFail();
        $posts = $category->posts()->get(); // Lấy tất cả bài viết thuộc category này

        return $posts->map(function ($post) {
            return [
                'title' => $post->post_title,
                'slug' => $post->slug,
                'excerpt' => $post->post_excerpt,
                'dev' => $post->toArray(), // Thêm dòng này để xem toàn bộ dữ liệu của bài viết
            ];
        })->all();

        // app(\Ncc\Wp\Categories\CategoryLoader::class)->test();
    }

    // app(\Ncc\Wp\Categories\CategoryLoader::class)->loader()
}