<th scope="{{ $scope }}" {{ $attributes }}>
    {!! $slot!!}
    @if($direction === 'desc')
        ▲
    @elseif($direction === 'asc')
        ▼
    @elseif($sortable)
        ▼▲
    @endif
</th>
