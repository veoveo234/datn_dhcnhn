<?php

namespace App\Repositories;

use App\Models\User\ShoppingCart\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderDetailRepository extends BaseRepository
{
    protected $path = "admin-assets/uploads/blog/";

    public function model()
    {
        return OrderDetail::class;
    }

    public function getStatisticalTotalProductSell($limit = 30)
    {
        return $this->model
            ->whereBetween('created_at', [now()->subDays($limit), now()])
            ->orderBy('created_at', 'DESC')
            ->sum('quantity');
    }
}
