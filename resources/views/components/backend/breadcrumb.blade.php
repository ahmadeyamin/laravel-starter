<nav class="breadcrumb-container" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="{{ route('backend.home') }}"><i class="ik ik-home"></i></a>
        </li>
        @foreach (request()->segments() as $item)
            <li class="breadcrumb-item">
                <a >{{ucfirst($item)}}</a>
            </li>
        @endforeach
    </ol>
</nav>
