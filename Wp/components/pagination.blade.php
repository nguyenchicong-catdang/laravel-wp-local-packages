@php
    $totalItems = $data['total_items'] ?? 1;
    $limit = $data['limit'] ?? 12;
    $totalPages = ceil($totalItems / $limit);
    $currentPage = request()->query('page', 1);
    $urlPath = request()->path();
@endphp
<nav aria-label="Page navigation example">
  <ul class="pagination">
    @if ($currentPage > 1)
        <li class="page-item"><a class="page-link" href="{{url()->query($urlPath, $currentPage > 2 ? ['page' => $currentPage - 1] : [])}}">Previous</a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    @endif

    {{-- HIEN THI TRANG 1 NEU LA TRANG 1, DE TRANG 1 LUON HIEN THI VA ACTIVE NEU LA TRANG 1 --}}
    <li class="page-item"><a class="page-link {{$currentPage == 1 ? 'active' : ''}}" href="/{{ $urlPath }}">1</a></li>
    
    {{-- foreach --}}
    @for ($i = 2; $i <= $totalPages; $i++)
        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
            <a class="page-link" href="{{url()->query($urlPath, ['page' => $i])}}">{{ $i }}</a>
        </li>
    @endfor

    @if ($currentPage < $totalPages)
        <li class="page-item"><a class="page-link" href="{{url()->query($urlPath, ['page' => $currentPage + 1])}}">Next</a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
    @endif
  </ul>
</nav>