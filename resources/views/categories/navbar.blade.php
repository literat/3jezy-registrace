<h1>Categories</h1>

<ul class="nav navbar-nav">
    <li><a href="{{ route('contests.categories.index', ['contest' => $contest]) }}">View All</a></li>
    <li><a href="{{ route('contests.categories.create', ['contest' => $contest]) }}">Create</a>
</ul>