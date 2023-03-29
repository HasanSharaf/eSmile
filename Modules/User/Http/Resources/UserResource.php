<?php

namespace Modules\User\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class UserResource extends BaseResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
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
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toArray($request)
    { 
        $this->collection = $this->collection->map(function ($item) {
            $dataToReturn = [
                'id' => $item->id,
                'name' => $item->name,
                'email' =>$item->email,
                'phone_number' => $item->phone_number,
                'address' => $item->address ,
                'status' => $item->status ,
                'approved_at' => $item->approved_at ,
                'approved_by' => $item->approved_by  ,
                'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null ,
                'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null :$item->updated_at,
            ];
            $additionalData = [
                // 'orders' => collect(new OrderResource($item->quotationOrders))->toArray()['data'] ?? [],
                // 'orders' =>new OrderResource($item->quotationOrders) ?? [],
                // 'fixedItems' => $item->fixedItems->count()? (new GroupingFixedItemResource($item->fixedItems,false))->getResult(false) ?? [] :[],
                // 'contacts' => $item->userContacts->count()? (new ContactResource($item->userContacts))->toArray($item->userContacts)['data'] ?? [] :[],
                // 'userInformation' => $item->userInformations ? (new UserInformationResource([$item->userInformations]))->toArray([$item->userInformations])['data'][0] ?? [] : [],
            ];
            if($this->withAdditionalData){
                $dataToReturn =  array_merge($dataToReturn,$additionalData);   
            }
            return $dataToReturn;
          
        });
        return $this->resolvePaginationResults($this);
    }
}
