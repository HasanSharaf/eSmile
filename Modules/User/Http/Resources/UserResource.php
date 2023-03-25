<?php

namespace Modules\User\Http\Resources;

use App\Http\Resources\BaseResource;

class UserResource extends BaseResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toArray($request)
    {
        $this->collection = $this->collection->map(function ($item) {
            return [
                'id' => $item->id ?? null,
                'name' => $item->name ?? null,
                'tipo' => $item->tipo ?? null,
                'typology'=> $item->typology ?? null,
                'financial_status' => $item->financial_status ?? null,
                'integraa_id' => $item->integraa_id ?? null,
                'parent_id' => $item->parent ? $item->parent->id : null,
                'parent_integraa_id' => $item->parent_id,
                'vat' => $item->vat
                
            ];
        });
        return $this->resolvePaginationResults($this);
    }
}
