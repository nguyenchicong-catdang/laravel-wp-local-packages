@php
    $data = app(\Ncc\Wp\Categories\CategoryLoader::class)->devGetAllCategories();
@endphp
<div class="list-group border">
@if($data)
<a href="/" class="list-group-item list-group-item-action">
    Home
  </a>
  {{-- foreach --}}
  @foreach($data as $category)
    <a href="/category/{{ $category['slug'] }}" class="list-group-item list-group-item-action">
      {{ $category['name'] }}
    </a>
  @endforeach
@else
  <a href="/" class="list-group-item list-group-item-action">
    Home
  </a>
</div>
@endif