<?php

namespace App\Repositories;

use App\Models\User\ShoppingCart\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    protected $path = "admin-assets/uploads/blog/";

    public function model()
    {
        return Order::class;
    }

    public function getStatisticalOrder($limit = 10)
    {
        $query = DB::raw('Date(created_at) as date');
        $sub_query = DB::raw('SUM(total_money) as "price"');
        return $this->model
            ->whereBetween('created_at', [now()->subDays($limit), now()])
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->limit($limit)
            ->get([$query, $sub_query]);
    }

    public function getStatisticalTotalSales($limit = 30)
    {
        return $this->model
            ->whereBetween('created_at', [now()->subDays($limit), now()])
            ->orderBy('created_at', 'DESC')
            ->sum('total_money');
    }

    public function getStatisticalTotalOrder($limit = 30)
    {
        return $this->model
            ->whereBetween('created_at', [now()->subDays($limit), now()])
            ->orderBy('created_at', 'DESC')
            ->count();
    }
}
