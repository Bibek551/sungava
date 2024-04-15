<div class="form-group">
    <div class="panel panel-default">
        <div class="panel-header">
            <h4>Select Destination</h4>
        </div>

        <div class="panel-body product_category">
            <ul style="padding-left:0" class="category_checkbox">
                @foreach ($destinations as $d)
                    <li>
                        <input type="checkbox" name="destination_ids[]" class=""
                            @if (in_array($d->id, $packageDestinations)) {{ 'checked' }} @endif
                            value="{{ $d->id }}"><label for="option">{{ $d->name }}</label>
                        <ul>
                            @if (count($d->children))
                                @include('admin.package.includes.subdestinations', [
                                    'subDestinations' => $d->children,
                                ])
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
