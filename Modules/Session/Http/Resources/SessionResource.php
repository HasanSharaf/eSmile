<?php


namespace Modules\Session\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class SessionResource extends BaseResource
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
                    'financial_account_id' => $item->financialAccount->id,
                    'full_cost' => $item->full_cost,
                    'paid' =>$item->paid,
                    'payment_type' => $item->payment_type ,
                    'remaining_cost' => $item->remaining_cost ,
                    'description' => $item->description ,
                    'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null ,
                    'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null :$item->updated_at,
                ];
            });
            return $this->resolvePaginationResults($this);
        } catch (\Throwable $th) {
           dd('aaa');
        }
       
    }

}
