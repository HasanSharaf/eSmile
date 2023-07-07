<?php

namespace Modules\Doctor\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class DoctorLoginResource extends BaseResource
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
        try {
            $this->collection = $this->collection->map(function ($item) {
                return [
                    'email' =>$item->email,
                    'password' => $item->password,
                ];
            });
            return $this->resolvePaginationResults($this);
        } catch (\Throwable $th) {
            dd('aaa');
        }
    }
}
