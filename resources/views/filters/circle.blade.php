<a href="#" data-toggle="filter-toggle" data-circle="{{ $circle->id }}" class="list-group-item {{ Auth::user()->isInFilter($circle) ? 'list-group-item-success' : 'list-group-item-danger' }}">
    {{ $circle->name }}
</a>