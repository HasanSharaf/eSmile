<?php


namespace Modules\User\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class UserResource extends BaseResource
{
   /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        try {
            $this->collection = $this->collection->map(function ($item) {
                return [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'gender' => $this->gender,
                'user_picture' => $this->user_picture,
                'phone_number' => $this->phone_number,
                'birthday' => $this->birthday,
                'location' => $this->location,
                'location_details' => $this->location_details,
                'createdAt' => $this->created_at ? Carbon::parse($this->created_at)->format('m/d/Y H:i') : null,
                'updatedAt' => $this->updated_at ? Carbon::parse($this->updated_at)->format('m/d/Y H:i') ?? null : $this->updated_at,
                ];
            });
            return $this->resolvePaginationResults($this);
        } catch (\Throwable $th) {
            dd('aaa');
        }
    }
}
