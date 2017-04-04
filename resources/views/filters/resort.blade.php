<div class="col-md-4">
    <div class="list-group">
        <li class="list-group-item">
            <h4 class="list-group-item-heading">
                <b>{{ $resort->name }}</b>
            </h4>
        </li>
        @each('filters.circle', $resort->circles, 'circle')
    </div>
</div>