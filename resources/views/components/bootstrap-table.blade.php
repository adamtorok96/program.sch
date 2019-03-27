<table class="table"
       data-toggle="table"
       @isset($toolbar)
       data-toolbar="{{ $toolbar }}"
       @endisset
       @isset($rowStyle)
       data-row-style="{{ $rowStyle }}"
       @endisset
       @isset($params)
       data-query-params="{{ $params }}"
       @endisset
       @isset($clickToSelect)
       data-click-to-select="{{ $clickToSelect }}"
       @endisset
       data-search="{{ isset($search) && $search ? 'true' : 'false' }}"
       data-pagination="true"
       data-side-pagination="server"
       data-url="{{ $url }}">
    <thead>
    <tr>
        {{ $slot }}
    </tr>
    </thead>
</table>