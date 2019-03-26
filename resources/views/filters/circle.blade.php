<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $circle->name }}
            </h3>
        </div>
        <button data-toggle="filter-toggle" data-type="program" data-circle="{{ $circle->id }}" class="list-group-item {{ Auth::user()->isProgramFilteredAt($circle) ? 'list-group-item-success' : 'list-group-item-danger' }}">
            Program
        </button>
        <button data-toggle="filter-toggle" data-type="newsletter" data-circle="{{ $circle->id }}" class="list-group-item {{ Auth::user()->isNewsletterFilteredAt($circle) ? 'list-group-item-success' : 'list-group-item-danger' }}">
            Hírlevél
        </button>
    </div>
</div>