<?php


namespace Modules\User\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class UserResource extends BaseResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'gender' => $item->gender,
                'user_picture' => $item->user_picture,
                'phone_number' => $item->phone_number,
                'birthday' => $item->birthday,
                'location' => $item->location,
                'location_details' => $item->location_details,
                'clinic_knowledge' => $item->clinic_knowledge,
                'clinic_note' => $item->clinic_note,
                'sickness' => $item->sickness,
                'sensitive' => $item->sensitive,
                'sensitive_note' => $item->sensitive_note,
                'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null,
                'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') : null,
            ];
        });
    }
}

