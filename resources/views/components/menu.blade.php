<nav class="nav flex-column">
@foreach ($list as $row)
        <a class="nav-link {{ $isActive($row['label']) ? 'active' : ''}}"
                href=" {{ route($row['route']) }}">
                        {{$row['label']}}
        </a>
@endforeach
</nav>