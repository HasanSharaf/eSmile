<?php


namespace Modules\Session\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Modules\Doctor\Http\Resources\DoctorResource;
use Modules\SubSession\Http\Resources\SubSessionResource;

class UserSessionResource extends BaseResource
{   
    private $withAdditionalData;
    /**
    *
    *
    *
    */
    public function __construct($resource,$withAdditionalData = true)
    {
        parent::__construct($resource);
        $this->withAdditionalData = $withAdditionalData;
    }
    /**
    * Transform the resource collection into an array.
    *
    * @param  \Illuminate\Http\Request
    * @return array
    */
    public function toArray($request)
    {
        $this->collection = $this->collection->map(function ($item) {
            $item->loadMissing('financialAccount');

            $dataToReturn = [
                'id' => $item->id,
                // 'doctor' => [
                //     'doctor_id' => $item->doctor_id,
                //     'first_name' => $item->doctor->first_name,
                //     'last_name' => $item->doctor->last_name,
                //     'email' => $item->doctor->email,
                //     'gender' => $item->doctor->gender,
                //     'doctor_picture' => $item->doctor->doctor_picture,
                //     'phone_number' => $item->doctor->phone_number,
                //     'birthday' => $item->doctor->birthday,
                //     'location' => $item->doctor->location,
                //     'location_details' => $item->doctor->location_details,
                //     'years_of_experience' => $item->doctor->years_of_experience,
                //     'type' => $item->doctor->type,
                //     'competence_type' => $item->doctor->competence_type,
                //     'availability_type' => $item->doctor->availability_type,
                //     'availability' => $item->doctor->doctorWorkTime->map(function ($availability) {
                //         return [
                //             'day_of_week' => $availability->day_of_week,
                //             'start_time' => $availability->start_time,
                //             'end_time' => $availability->end_time,
                //         ];
                //     }),
                // ],
                'financial_account_id' => $item->financialAccount->id,
                'full_cost' => $item->full_cost,
                'paid' => $item->paid,
                'payment_type' => $item->payment_type,
                'remaining_cost' => $item->remaining_cost,
                'description' => $item->description,
                'xray_picture' => $item->xray_picture,
                'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null,
                'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null : $item->updated_at,
                'subSessions' => $item->subSession->map(function ($subSession) {
                    return [
                        'id' => $subSession->id,
                        'session_id' => $subSession->session->id,
                        'paid' => $subSession->paid,
                        'note' => $subSession->note,
                        'createdAt' => $subSession->created_at ? Carbon::parse($subSession->created_at)->format('m/d/Y H:i') : null,
                        'updatedAt' => $subSession->updated_at ? Carbon::parse($subSession->updated_at)->format('m/d/Y H:i') : null,
                    ];
                }),
                    // 'createdAt' => $item->doctor->created_at ? Carbon::parse($item->doctor->created_at)->format('m/d/Y H:i') : null,
                    // 'updatedAt' => $item->doctor->updated_at ? Carbon::parse($item->doctor->updated_at)->format('m/d/Y H:i') ?? null : $item->doctor->updated_at,
            ];

            $additionalData = [
                'subSessions' => new SubSessionResource($item->subsession) ?? [],
            ];

            if ($this->withAdditionalData) {
                $dataToReturn = array_merge($dataToReturn, $additionalData);
            }

            return $dataToReturn;
        });

        return $this->resolvePaginationResults($this);
    }
    
}
