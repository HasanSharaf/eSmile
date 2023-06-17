<?php


namespace Modules\FinancialAccount\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class listFinancialAccountResource extends BaseResource
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
                    'user_id' => $item->user_id,
                    'session_id' => $item->session_id,
                    'first_name' => $item->user->first_name,
                    'last_name' => $item->user->last_name,
                    'email' =>$item->user->email,
                    'gender' => $item->user->gender ,
                    'phone_number' => $item->user->phone_number,
                    'location' => $item->user->location ,
                    'location_details' => $item->user->location_details ,
                    'birthday' => $item->user->birthday,
                    'user_picture' => $item->user->user_picture,
                    'selected_time' => $item->selected_time ? Carbon::parse($item->selected_time)->format('m/d/Y H:i') : null ,
                    'note' => $item->note,
                    'full_cost' => $item->session->full_cost,
                    'paid' => $item->session->paid,
                    'remaining_cost' => $item->session->remaining_cost,
                    'description' => $item->session->description,
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