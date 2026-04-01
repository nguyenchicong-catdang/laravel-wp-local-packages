{{debug($data)}}
<x-wp-comp::layout>
    <x-wp-comp::post.post-card :data="$data['post_card']" />
    <x-wp-comp::post.post-content :data="$data['post_content']" />
</x-wp-comp::layout>