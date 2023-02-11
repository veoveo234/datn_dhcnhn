<?php

namespace App\Repositories;

use App\Models\User\Affiliate\AffiliatePartner;
use Illuminate\Support\Facades\DB;

class AffiliatePartnerRepository extends BaseRepository
{
    protected $path = "admin-assets/uploads/blog/";

    public function model()
    {
        return AffiliatePartner::class;
    }

    public function getStatisticalAffiliatePartner($limit = 7)
    {
        $query = DB::raw('Date(created_at) as date');
        $sub_query = DB::raw('COUNT(*) as "count"');
        return $this->model
            ->whereBetween('created_at', [now()->subDays($limit), now()])
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->limit($limit)
            ->get([$query, $sub_query]);
    }


}
