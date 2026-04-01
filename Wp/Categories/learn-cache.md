use Illuminate\Support\Facades\Cache;

$cacheKey = "category_posts_{$slug}_page_{$currentPage}";

$dataPosts = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($slug) {
    return $this->getAllPosts($slug);
});