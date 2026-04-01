@php
    $totalItems = $data ?? 1;
    $limit = $data['limit'] ?? 2;
    $totalPages = ceil($totalItems / $limit);
    $currentPage = request()->get('page', 1);
    $urlPath = url(request()->path());
@endphp
{{debug($urlPath)}}
<nav aria-label="Page navigation example">
  <ul class="pagination">
    @if ($currentPage > 1)
        <li class="page-item"><a class="page-link" href="?page={{ $currentPage - 1 }}">Previous</a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    @endif

    {{-- foreach --}}
    <li class="page-item"><a class="page-link" href="/{{ $urlPath }}">1</a></li>

    @for ($i = 2; $i <= $totalPages; $i++)
        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
        </li>
    @endfor

    @if ($currentPage < $totalPages)
        <li class="page-item"><a class="page-link" href="?page={{ $currentPage + 1 }}">Next</a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
    @endif
  </ul>
</nav>