<?php


namespace Modules\Doctor\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class DoctorResource extends BaseResource
{
   /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
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
                    'doctor_picture' => $item->doctor_picture,
                    'phone_number' => $item->phone_number,
                    'birthday' => $item->birthday,
                    'location' => $item->location,
                    'location_details' => $item->location_details,
                    'years_of_experience' => $item->years_of_experience,
                    'type' => $item->type,
                    'competence_type' => $item->competence_type,
                    'availability_type' => $item->availability_type,
                    'availability' => $item->doctorWorkTime->map(function ($availability) {
                        return [
                            'day_of_week' => $availability->day_of_week,
                            'start_time' => $availability->start_time,
                            'end_time' => $availability->end_time,
                        ];
                    }),
                    'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null,
                    'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null : $item->updated_at,
                ];
            });
    }
}






