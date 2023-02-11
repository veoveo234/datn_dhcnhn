<?php

namespace App\Services;

use App\Repositories\AffiliatePartnerRepository;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\CategoryBlog\CategoryBlogRepository;
use App\Repositories\MemberRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;

class StatisticalService extends BaseServices
{
    protected $blogRepository;

    protected $categoryBlogRepository;

    protected $memberRepository;

    protected $affiliatePartnerRepository;

    protected $orderRepository;

    protected $orderDetailRepository;

    public function __construct(
        BlogRepository $blogRepository,
        CategoryBlogRepository $categoryBlogRepository,
        MemberRepository $memberRepository,
        AffiliatePartnerRepository $affiliatePartnerRepository,
        OrderRepository $orderRepository,
        OrderDetailRepository $orderDetailRepository

    ){
        $this->blogRepository = $blogRepository;
        $this->categoryBlogRepository = $categoryBlogRepository;
        $this->memberRepository = $memberRepository;
        $this->affiliatePartnerRepository = $affiliatePartnerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function getStatisticalUser($day = 10)
    {
        $data = $this->memberRepository->getStatisticalUser();
        return $this->getResponse($data, $day);
    }

    public function getResponse($data, $day)
    {
        $response = [];
        foreach ($data as $key => $value) {
            $response[] = [$key + 1, $value->count];

        }
        if (count($data) < $day){
            for ($i = count($data); $i <= $day; $i++) {
                $response[] = [$i, 0];
            }
        }

        return $response;
    }

    public function getStatisticalAffiliatePartner($day = 7)
    {
        $data = $this->affiliatePartnerRepository->getStatisticalAffiliatePartner();
        return $this->getResponse($data, $day);
    }

    public function getStatisticalOrder($day = 10)
    {
        $data = $this->orderRepository->getStatisticalOrder();
        $response = [];
        foreach ($data as $key => $value) {
            $response[] = [$key + 1, $value->price];

        }
        if (count($data) < $day){
            for ($i = count($data); $i <= $day; $i++) {
                $response[] = [$i, 0];
            }
        }

        return $response;
    }

    public function getStatisticalTotalOrder()
    {
        return $this->orderRepository->getStatisticalTotalOrder();
    }

    public function getStatisticalTotalSales()
    {
        return $this->orderRepository->getStatisticalTotalSales();
    }

    public function getStatisticalTotalProductSell()
    {
        return $this->orderDetailRepository->getStatisticalTotalProductSell();
    }

    public function getStatisticalUserNew()
    {
        return $this->memberRepository->getStatisticalUserNew();
    }

}
