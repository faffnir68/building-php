<?php 
namespace App\class\helpers;

use App\class\helpers\URLHelper;


class TableHelper {

    const SORT_KEY ='sort';
    const DIR_KEY = 'dir';
    
    public static function sort(string $sortKey, string $label, array $data): string 
    {

        $sort = $data[self::SORT_KEY] ?? null;
        $direction = $data[self::DIR_KEY] ?? null;
        
        $direction === 'asc' ? $chevron = '<i class="fa-solid fa-angle-up"></i>' : $chevron = '<i class="fa-solid fa-angle-down"></i>';
        
        $url = URLHelper::withParams($data, [
            'sort' => $sortKey, 
            'dir' => $direction === 'asc' ? 'desc' : 'asc'
        ]);

        return <<<HTML
        <a class="ml-1 cursor-pointer" href="?$url">
            $label
        </a>
        $chevron
        HTML;
    }

}