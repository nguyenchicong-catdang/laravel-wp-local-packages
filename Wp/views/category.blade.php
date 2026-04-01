{{debug($data)}}
<x-wp-comp::layout>
    <x-wp-comp::category.cat-card :data="$data['category_card']" />
    <x-wp-comp::category.cat-posts :data="$data['posts']" />
    <x-wp-comp::pagination :data="$data['pagination']" />
</x-wp-comp::layout>