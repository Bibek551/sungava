<?php

use App\Models\Destination;
use App\Models\Package;
use App\Models\Setting;

function getSettings()
{
    return Setting::pluck('value', 'key')->toArray();
}

function getAllChildrenIds($parentId)
{
    $destination = Destination::findOrFail($parentId);
    $childrenIds = $destination->children()->pluck('id');

    foreach ($destination->children as $child) {
        $childrenIds = $childrenIds->merge(getAllChildrenIds($child->id));
    }
    return $childrenIds;
}


function getDestinationWisePackages($parentId)
{
    $packages = Package::with('activity')->select('packages.*')->distinct('packages.id');
    $destinations_ids = getAllChildrenIds($parentId);

    $destinations_ids = $destinations_ids->merge($parentId);

    if ($destinations_ids) {
        $packages = $packages->join('destination_package', 'destination_package.package_id', '=', 'packages.id')
            ->join('destinations', 'destinations.id', '=', 'destination_package.destination_id')
            ->whereIn('destination_package.destination_id', $destinations_ids);
    }

    $packages = $packages->inRandomOrder()->latest()->get();
    return $packages;
}


function price_format($money)
{
    $decimal = (string)($money - floor($money));
    $money = floor($money);
    $length = strlen($money);
    $m = '';
    $money = strrev($money);
    for ($i = 0; $i < $length; $i++) {
        if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
            $m .= ',';
        }
        $m .= $money[$i];
    }
    $result = strrev($m);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);
    if ($decimal != '0') {
        $result = $result . $decimal;
    }
    return $result;
}
