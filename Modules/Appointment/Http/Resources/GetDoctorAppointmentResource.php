<?php


namespace Modules\Appointment\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class GetDoctorAppointmentResource extends BaseResource
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
                    'id' => $item->id,
                    'doctor' => [
                        'doctor_id' => $item->doctor_id,
                        'first_name' => $item->doctor->first_name,
                        'last_name' => $item->doctor->last_name,
                        'email' => $item->doctor->email,
                        'gender' => $item->doctor->gender,
                        'doctor_picture' => $item->doctor->doctor_picture,
                        'phone_number' => $item->doctor->phone_number,
                        'birthday' => $item->doctor->birthday,
                        'location' => $item->doctor->location,
                        'location_details' => $item->doctor->location_details,
                        'years_of_experience' => $item->doctor->years_of_experience,
                        'type' => $item->doctor->type,
                        'competence_type' => $item->doctor->competence_type,
                        'availability_type' => $item->doctor->availability_type,
                        'availability' => $item->doctor->doctorWorkTime->map(function ($availability) {
                            return [
                                'day_of_week' => $availability->day_of_week,
                                'start_time' => $availability->start_time,
                                'end_time' => $availability->end_time,
                            ];
                        }),
                        'createdAt' => $item->doctor->created_at ? Carbon::parse($item->doctor->created_at)->format('m/d/Y H:i') : null,
                        'updatedAt' => $item->doctor->updated_at ? Carbon::parse($item->doctor->updated_at)->format('m/d/Y H:i') ?? null : $item->doctor->updated_at,
                    ],
                    'selected_time' => $item->selected_time ? Carbon::parse($item->selected_time)->format('H:i') : null ,
                    'selected_date' => $item->selected_date ? Carbon::parse($item->selected_date)->format('m/d/Y') : null ,
                    'note' => $item->note,
                    'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null ,
                    'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null :$item->updated_at,
                    // 'status' => $item->status ,
                    // 'approved_at' => $item->approved_at ,
                    // 'approved_by' => $item->approved_by  ,
                ];
            });
            return $this->resolvePaginationResults($this);
        } catch (\Throwable $th) {
           dd('aaa');
        }
       
    }

}
