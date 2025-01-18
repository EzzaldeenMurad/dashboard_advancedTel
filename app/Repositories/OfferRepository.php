<?php

namespace App\Repositories;

use App\Models\Offer;

class OfferRepository implements RepositoryInterface
{
    public function all()
    {
        return Offer::all();
    }

    public function find($id)
    {
        return Offer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Offer::create($data);
    }

    public function update($id, array $data)
    {
        $offer = Offer::findOrFail($id);
        $offer->update($data);
        return $offer;
    }

    public function delete($id)
    {
        return Offer::destroy($id);
    }
}
