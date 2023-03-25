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
                'email' => $item->email ?? null,
                'password'=> $item->password ?? null,
                'phone_number' => $item->phone_number ?? null,
                'address' => $item->address ?? null,
                'status' => $item->status ?? null,
                'approved_at' => $item->approved_at ?? null,
                'approved_by' => $item->approved_by ?? null,
                // 'role_id' => $item->role_id,
                // 'clinic_id' => $item->clinic_id,
                
            ];
        });
        return $this->resolvePaginationResults($this);
    }
}
