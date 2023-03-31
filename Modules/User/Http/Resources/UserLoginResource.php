<?php

namespace Modules\User\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class UserLoginResource extends BaseResource
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
                'email' =>$item->email,
                'password' => $item->password,
                
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
