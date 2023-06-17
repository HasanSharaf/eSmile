<?php


namespace Modules\FinancialAccount\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Modules\Session\Http\Resources\SessionResource;

class FinancialAccountResource extends BaseResource
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
                $dataToReturn = [
                    'id' => $item->id,
                    'user_id' => $item->user->id,
                    'first_name' => $item->user->first_name,
                    'last_name' => $item->user->last_name,
                    'email' =>$item->user->email,
                    'gender' => $item->user->gender ,
                    'phone_number' => $item->user->phone_number,
                    'location' => $item->user->location ,
                    'location_details' => $item->user->location_details ,
                    'birthday' => $item->user->birthday,
                    'user_picture' => $item->user->user_picture,
                    'note' => $item->note,
                    'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null ,
                    'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null :$item->updated_at,
                ];
                $additionalData = [
                    'sessions' =>new SessionResource($item->session) ?? [],
                ];
                if($this->withAdditionalData){
                    $dataToReturn =  array_merge($dataToReturn,$additionalData);
                }
                return $dataToReturn;
    
            });
            return $this->resolvePaginationResults($this);
        }
}
