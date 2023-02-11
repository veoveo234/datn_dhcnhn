<?php

namespace App\Repositories;

use App\Models\User\Member\Member;
use Illuminate\Support\Facades\DB;

class MemberRepository extends BaseRepository
{
    protected $path = "admin-assets/uploads/blog/";

    public function model()
    {
        return Member::class;
    }

    public function getStatisticalUser($limit = 10)
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

    public function getStatisticalUserNew($limit = 30)
    {
        return $this->model
            ->whereBetween('created_at', [now()->subDays($limit), now()])
            ->orderBy('created_at', 'DESC')
            ->count();
    }


}
