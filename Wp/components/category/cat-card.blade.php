@if ($data)
    <div class="cat-card">
        <h1>{{ $data['name'] }}</h1>
        <p>{{ $data['description'] }}</p>
    </div>
@endif
