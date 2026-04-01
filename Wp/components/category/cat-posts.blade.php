@if ($data)
    @foreach ($data as $post)
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $post['thumbnail_url'] }}" class="img-fluid rounded-start" alt="{{ $post['thumbnail_alt'] }}">
                </div>
                <div class="col-md-8 d-flex flex-column">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post['title'] }}</h5>
                        <p class="card-text">{{ $post['excerpt'] }}</p>
                    </div>
                    <div class="card-footer mt-auto ms-auto">
                      <a href="{{ route('post', $post['slug']) }}" class="btn btn-sm btn-primary stretched-link">Xem Them ...</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No posts found in this category.</p>
@endif
