<?php

namespace App\Services;

use App\Repositories\OfferRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OfferService
{

    protected  $offersRepository;
    public function __construct(RepositoryInterface $offersRepository)
    {
        $this->offersRepository = $offersRepository;
    }

    public function getAllOffers()
    {
        return $this->offersRepository->all();
    }

    public function getOffer($id)
    {
        try {
            return $this->offersRepository->find($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Offer not found", 404);
        }
    }

    public function createOffer($data)
    {
        return $this->offersRepository->create($data);
    }

    public function updateOffer($id, $data)
    {

        try {
            return $this->offersRepository->update($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Offer not found", 404);
        }
    }

    public function deleteOffer($id)
    {
        try {
            return $this->offersRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Offer not found", 404);
        }
    }
}
