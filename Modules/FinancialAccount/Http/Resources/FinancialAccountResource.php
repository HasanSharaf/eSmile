<?php


namespace Modules\FinancialAccount\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Modules\Session\Http\Resources\SessionResource;
use Modules\User\Http\Resources\UserResource;

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
                    'users' => new UserResource($item->user) ?? [],
                    'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null ,
                    'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null :$item->updated_at,
                ];
                if ($item->session()->isNotEmpty()) {
                $additionalData = [
                    'sessions' => new SessionResource($item->session()->get()) ?? [],
                ];
                
                if($this->withAdditionalData){
                    $dataToReturn =  array_merge($dataToReturn,$additionalData);
                }
                return $dataToReturn;
    
            }});
            return $this->resolvePaginationResults($this);
        }
}
