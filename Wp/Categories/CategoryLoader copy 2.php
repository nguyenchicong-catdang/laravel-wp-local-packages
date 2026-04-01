<?php
namespace Ncc\Wp\Categories;

use Corcel\Model\Taxonomy;

class CategoryLoader extends Taxonomy
{
    protected $connection = 'wp';
    protected $limit = 3; // Số bài viết trên mỗi trang, có thể thay đổi tùy ý
    public function loader(string $slug = ''): array
    {
        return $this->loaderWp($slug);
    }

    private function loaderWp(string $slug = ''): array
    {
        $dataCategoryCard = $this->getCategoryCard($slug);
        $dataPosts = $this->getAllPosts($slug);

        return [
            'category_card' => $dataCategoryCard,
            'pagination' => [
                'total_items' => $dataCategoryCard['count'] ?? 0, // Số lượng bài viết trong category này   
                // 'total_items' => 0,
                'limit' => $this->limit, // Số bài viết trên mỗi trang
            ],
            'posts' => $dataPosts
        ];

    }

    private function getCategoryCard(string $slug = ''): array
    {
        $data = $this::category()->slug($slug)->firstOrFail();
        // Logic to load categories, e.g., from a database or an API
        return [
            'name'        => $data?->term?->name,
            'slug'        => $data?->term?->slug,
            'description' => $data?->description, // Lưu ý: description thường nằm ở table taxonomy, không phải term
            'count' => $data?->count, // Số lượng bài viết trong category này
        ];
        
    }

    private function getAllPosts(string $slug = ''): array
    {
        $limit = $this->limit; // Số bài trên 1 trang
        $currentPage = (int) request()->query('page', 1); // Trang hiện tại
        $offset = ($currentPage - 1) * $limit; // Tính vị trí bắt đầu lấy


        $category = $this::category()->slug($slug)->firstOrFail();
        // $posts = $category->posts()->status('publish')->with(['thumbnail', 'thumbnail.attachment'])->get(); // Lấy tất cả bài viết thuộc category này
        $posts = $category->posts()
            ->status('publish')
            ->with(['thumbnail', 'thumbnail.attachment'])
            ->skip($offset) // Bỏ qua n bài đầu
            ->take($limit)  // Lấy đúng n bài tiếp theo
            ->get();

        return $posts->map(function ($post) {
            // 1. Check xem có ảnh hay không (Vị thần canh cửa)
            // $hasImage = $post->image && $post->thumbnail && $post->thumbnail->attachment;
            $hasImage = $post->thumbnail && $post->thumbnail->attachment;

            return [
                'title'         => $post->post_title,
                'slug'          => $post->slug,
                'excerpt'       => $post->post_excerpt,
                'thumbnail_alt' => $hasImage ? $post->thumbnail->attachment->alt : 'alt default',
                'thumbnail_url' => $hasImage ? $post->thumbnail->size('thumbnail')['url'] : '/uploads/default.jpg',
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