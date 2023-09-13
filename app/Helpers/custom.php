<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('toStars')) {
    function toStars(int $numeric)
    {
        $stars = null;
        for ($i = 0; $i < $numeric; $i++) {
            $stars .= '⭐';
        }
        return $stars;
    }
}

if (!function_exists('toColoredBadge')) {
    function toColoredBadge(string $status = null)
    {
        if (!$status) $status = 'invalid';
        switch ($status) {
            case 0:
                $badge = 'badge-danger';
                $status = 'inactive';
                break;
            case 1:
                $badge = 'badge-success';
                $status = 'active';
                break;
            default:
                $badge = 'badge-danger';
        }
        $rendered = "<span class='badge {$badge} p-1'>" . strtoupper($status) . "</span>";
        return $rendered;
    }
}

if (!function_exists('storeFile')) {
    function storeFile($location, $file, $customName = null)
    {
        $storage = Storage::disk('cloud_local');
        if (!$customName) {
            $fileName = $file->hashName();
        } else {
            $fileExt = $file->extension();
            $fileName = $customName . "." . $fileExt;
        }
        $storeFile = $storage->putFileAs($location, $file, $fileName);
        $storedFile = $storage->url($location . "/" . $fileName);

        return $storedFile;
    }
}
