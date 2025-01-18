<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offers\CreateOfferRequst;
use App\Http\Requests\Offers\UpdateOfferRequst;
use App\Http\Resources\OfferResource;
use App\Http\Traits\ApiResponseTrait;
use App\Services\OfferService;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{
    use ApiResponseTrait;

    protected  $offersService;

    public function __construct(OfferService $offersService)
    {
        $this->offersService = $offersService;
    }

    public function index()
    {
        try {
            $offers = OfferResource::collection($this->offersService->getAllOffers());
            return $this->apiResponse($offers, 'تم عرض الباقات بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(CreateOfferRequst $createOfferRequest)
    {
        try {
            $offer = $this->offersService->createOffer($createOfferRequest->validated());
            return $this->apiResponse($offer, 'تم اضافة الباقه بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update($id, UpdateOfferRequst $updateOfferRequest)
    {
        try {
            $offer = $this->offersService->updateOffer($id, $updateOfferRequest->validated());
            return $this->apiResponse($offer, 'تم تعديل الباقه بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $offer = $this->offersService->deleteOffer($id);
            return $this->apiResponse($offer, 'تم حذف الباقه بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
