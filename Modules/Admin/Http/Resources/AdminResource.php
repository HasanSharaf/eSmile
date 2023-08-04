<?php


namespace Modules\Admin\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class AdminResource extends BaseResource
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
                    'first_name' => $item->first_name,
                    'last_name' => $item->last_name,
                    'email' =>$item->email,
                    'phone_number' => $item->phone_number,
                    'location' => $item->location ,
                    'birthday' => $item->birthday,
                    'admin_picture' => $item->admin_picture,
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
