<?php


namespace Modules\FinancialAccount\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Session\Http\Resources\SessionResource;

class ListFinancialAccountResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'user_id' => $item->user->id,
                        'first_name' => $item->user->first_name,
                        'last_name' => $item->user->last_name,
                        'email' => $item->user->email,
                        'gender' => $item->user->gender,
                        'phone_number' => $item->user->phone_number,
                        'location' => $item->user->location,
                        'location_details' => $item->user->location_details,
                        'birthday' => $item->user->birthday,
                        'user_picture' => $item->user->user_picture,
                        'note' => $item->note,
                        'full_cost' => $item->full_cost,
                        'paid' => $item->paid,
                        'remaining_cost' => $item->remaining_cost,
                        'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null,
                        'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') : null,
                        'sessions' => [
                            'data' => $item->session->map(function ($session) {
                                return [
                                    'id' => $session->id,
                                    'financial_account_id' => $session->financialAccount->id,
                                    'full_cost' => $session->full_cost,
                                    'paid' => $session->paid,
                                    'payment_type' => $session->payment_type,
                                    'remaining_cost' => $session->remaining_cost,
                                    'description' => $session->description,
                                    'createdAt' => $session->created_at ? Carbon::parse($session->created_at)->format('m/d/Y H:i') : null,
                                    'updatedAt' => $session->updated_at ? Carbon::parse($session->updated_at)->format('m/d/Y H:i') : null,
                                    'subSessions' => [
                                        'data' => $session->subSession->map(function ($subSession) {
                                            return [
                                                'id' => $subSession->id,
                                                'session_id' => $subSession->session->id,
                                                'paid' => $subSession->paid,
                                                'note' => $subSession->note,
                                                'createdAt' => $subSession->created_at ? Carbon::parse($subSession->created_at)->format('m/d/Y H:i') : null,
                                                'updatedAt' => $subSession->updated_at ? Carbon::parse($subSession->updated_at)->format('m/d/Y H:i') : null,
                                            ];
                                        }),
                                    ],
                                ];
                            }),
                        ],
                    ];
        });
    }

}
