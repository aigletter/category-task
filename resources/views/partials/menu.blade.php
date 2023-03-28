<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link @if($language === 'ru') active @endif" aria-current="page"
               href="{{ route('categories.index', ['language' => 'ru']) }}">RU</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($language === 'en') active @endif" aria-current="page"
               href="{{ route('categories.index', ['language' => 'en']) }}">EN</a>
        </li>
    </ul>
</nav>
