<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offers\CreateOfferRequst;
use App\Http\Requests\Offers\UpdateOfferRequst;
use App\Http\Resources\OfferResource;
use App\Http\Services\OffersServices;
use App\Http\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{
    use ApiResponseTrait;
    public $offersServices;
    public function __construct(OffersServices $offersServices)
    {
        $this->offersServices = $offersServices;
    }

    public function index()
    {
        try {
            $response = OfferResource::collection($this->offersServices->getOffers());
            if ($response) {
                return $this->apiResponse($response, 'تم عرض العمليات بنجاح', Response::HTTP_OK);
            } else {
                return $this->apiResponse([], 'لا يوجد عمليات', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(CreateOfferRequst $createOfferRequest)
    {
        try {
            if (!empty($createOfferRequest->getError())) {
                return $this->apiResponse(null, $createOfferRequest->getError(), Response::HTTP_NOT_ACCEPTABLE);
            }
            $data = $createOfferRequest->all();
            $response = $this->offersServices->createOffer($data);
            return $this->apiResponse($response, 'تم اضافة الباقه بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update($id, UpdateOfferRequst $updateOfferRequest)
    {
        try {
            if (!empty($updateOfferRequest->getError())) {
                return $this->apiResponse(null, $updateOfferRequest->getError(), Response::HTTP_NOT_ACCEPTABLE);
            }
            // $this->authorize('update',[User::class,Offer::class]);
            $data = $updateOfferRequest->getRequest()->all();
            $response = $this->offersServices->updateOffer($id, $data);
            if ($response) {
                return $this->apiResponse($response, 'تم تعديل الباقه بنجاح', Response::HTTP_CREATED);
            } else {
                return $this->apiResponse($response, 'لا يوجد بيانات', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $response = $this->offersServices->deleteOffer($id);
        if ($response) {
            return $this->apiResponse($response, 'تم حذف الباقه بنجاح', Response::HTTP_OK);
        } else {
            return $this->apiResponse($response, 'لا يوجد باقات لعرضها', Response::HTTP_NOT_FOUND);
        }
    }
}
