<?php
namespace config;

class general
{
    public static function filter()
    {
        return [
            'sortBy' => [
                'price' => [
                    0 => ['id' => 'price,asc', 'name' => 'Low to High'],
                    1 => ['id' => 'price,desc', 'name' => 'High to Low'],
                ],
                'status' => [
                    0 => ['id' => 'status,available', 'name' => 'Available'],
                    1 => ['id' => 'status,sold', 'name' => 'Sold'],
                    2 => ['id' => 'status,rented', 'name' => 'Rented'],
                ],
                'recency' => [
                    0 => ['id' => 'created_at,desc', 'name' => 'New'],
                    1 => ['id' => 'created_at,asc', 'name' => 'Old'],
                ],
            ],
            'perpage' => array_map(function ($item) {
                return [
                    'id' => $item,
                    'name' => $item . '/Page',
                ];
            }, range(2, 10, 2)),
        ];
    }
}