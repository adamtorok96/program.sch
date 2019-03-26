<h2>{{ $resort->name }}</h2>
<div class="row">
    @each('filters.circle', $resort->circles, 'circle')
</div>
