<?php


namespace Modules\Appointment\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class AppointmentResource extends BaseResource
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
                    'user_id' => $item->user->id,
                    'doctor_id' => $item->doctor->id,
                    'first_name' => $item->user->first_name,
                    'last_name' => $item->user->last_name,
                    'email' =>$item->user->email,
                    'gender' => $item->user->gender ,
                    'phone_number' => $item->user->phone_number,
                    'location' => $item->user->location ,
                    'location_details' => $item->user->location_details ,
                    'birthday' => $item->user->birthday,
                    'user_picture' => $item->user->user_picture,
                    'doctor_first_name' => $item->doctor->first_name,
                    'doctor_last_name' => $item->doctor->last_name,
                    'doctor_email' => $item->doctor->email,
                    'doctor_gender' => $item->doctor->gender,
                    'doctor_picture' => $item->doctor->doctor_picture,
                    'doctor_phone_number' => $item->doctor->phone_number,
                    'doctor_birthday' => $item->doctor->birthday,
                    'doctor_location' => $item->doctor->location,
                    'doctor_location_details' => $item->doctor->location_details,
                    'years_of_experience' => $item->doctor->years_of_experience,
                    'selected_time' => $item->selected_time ? Carbon::parse($item->selected_time)->format('m/d/Y H:i') : null ,
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
