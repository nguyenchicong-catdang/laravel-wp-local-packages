@if ($data)
<h1>{{$data['title']}}</h1>
<p>{{$data['excerpt']}}</p>
<div class="ratio ratio-1x1">
    <img class="img-fluid rounded object-fit-cover" src="{{$data['featured_url']}}" alt="{{$data['featured_alt']}}">
</div>
@endif