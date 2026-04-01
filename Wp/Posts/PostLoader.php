<?php
namespace Ncc\Wp\Posts;

use Corcel\Model\Post;
class PostLoader extends Post
{
    protected $connection = 'wp';

    public function load($slug)
    {
        return $this->loadWp($slug);
    }

    public function loadWp($slug)
    {
        $postObject = $this::published()->where('post_name', $slug)->first();
        $postCard = $this->getPostCard($postObject);
        $postContent = $this->getPostContent($postObject);
        return [
            'post_card' => $postCard,
            'post_content' => $postContent,
            'test' => $this->test($postObject),
        ];
    }

    private function getPostCard($postObject)
    {
        $hasImage = $postObject->thumbnail && $postObject->thumbnail->attachment;
        return [
            'title' => $postObject?->post_title,
            'excerpt' => $postObject?->post_excerpt,
            'featured_url' => $hasImage ? $postObject->thumbnail->attachment->url : '/uploads/default.jpg',
            'featured_alt' => $hasImage ? $postObject->thumbnail->attachment->alt : 'Default Image',
        ];
    }

    private function getPostContent($postObject)
    {
        $content = $postObject?->post_content;
        $content = $this->formatContent($content);
        return [
            'content' => $content,
        ];
    }

    private function formatContent($content)
    {
        return $this->cleanWpContent_v2($content);
    }

    private function formatContent_V1($content)
    {
        
        // Thêm lazy load và class responsive cho ảnh
        $content = preg_replace(
            '/<img(.*?)class="(.*?)"/',
            '<img$1class="$2 img-fluid" loading="lazy" decoding="async"',
            $content
        );

        // Nếu ảnh chưa có class thì thêm mới
        $content = preg_replace(
            '/<img((?!(class=)).)*?\/>/i',
            '<img $1 class="img-fluid" loading="lazy" decoding="async" />',
            $content
        );

        return $content;
    }

    public function cleanWpContent_v2($content)
    {
        // 1. Xóa các comment Gutenberg $content = preg_replace('//', '', $content);
        $content = preg_replace('/<!--.*?-->/', '', $content);
        // 2. Xóa các class mặc định của WP trong thẻ figure và img (giữ lại align nếu cần)
        // Bạn có thể dùng regex để thay thế class="..." bằng class="img-fluid"
        // $content = preg_replace(
        //     '/<img(.*?)class="[^"]*"(.*?)>/i',
        //     '<img$1class="figure-img img-fluid rounded" loading="lazy" decoding="async"$2>',
        //     $content
        // );

        $content = preg_replace(
            '/<img(.*?)class="[^"]*"(.*?)>/i',
            '<img$1class="figure-img img-fluid rounded object-fit-cover" loading="lazy" $2>',
            $content
        );

        // <figure class="figure">
        $content = preg_replace(
            '/<figure(.*?)class="[^"]*"(.*?)>/i',
            '<figure class="figure ratio ratio-1x1">',
            $content);

        // <figcaption class="figure-caption">
        $content = preg_replace(
            '/<figcaption(.*?)class="[^"]*"(.*?)>/i',
            '<figcaption class="figure-caption">',
            $content);

        // bỏ <p></p> thừa
        // $content = preg_replace('/<p><\/p>/', '', $content);
        $content = preg_replace('/<p[^>]*>(\s|&nbsp;)*<\/p>/', '', $content);

        // 3. Xóa các ký tự xuống dòng dư thừa giữa các tag
        $content = preg_replace("/\r|\n/", "", $content);

        return trim($content);
    }

    private function test(object $postObject)
    {
        return $postObject;
    }
}