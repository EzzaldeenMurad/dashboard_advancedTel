<?php

namespace App\Http\Services;

use App\Models\Offer;

class OffersServices
{
    public function getOffers()
    {
        return Offer::all();
    }

    public function getOffer(int $id)
    {
        return Offer::find($id);
    }


    public function createOffer($data)
    {
        $offer = Offer::create($data);
        return $offer;
    }


    public function updateOffer($id, $data)
    {
        $offer = $this->getOffer($id);

        optional($offer)->update($data);

        return $offer;
    }

    public function deleteOffer($id)
    {
        $offer = $this->getOffer($id);

        if ($offer) {
            return $offer->delete();
        }

        return false;
    }
}
