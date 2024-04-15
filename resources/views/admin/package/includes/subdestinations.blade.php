@if ($subDestinations)
    @foreach ($subDestinations as $sub)
        <li>
            <input type="checkbox" @if (in_array($sub->id, $packageDestinations)) {{ 'checked' }} @endif name="destination_ids[]"
                class="" value="{{ $sub->id }}">
            <label>{{ $sub->name }}</label>
            <ul>
                @if (count($sub->children))
                    @include('admin.package.includes.subdestinations', [
                        'subDestinations' => $sub->children,
                    ])
                @endif
            </ul>
        </li>
    @endforeach
@endif
