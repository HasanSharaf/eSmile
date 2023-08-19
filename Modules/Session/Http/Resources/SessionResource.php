<?php


namespace Modules\Session\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Modules\SubSession\Http\Resources\SubSessionResource;

class SessionResource extends BaseResource
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
                'financial_account_id' => $item->financialAccount->id,
                'full_cost' => $item->full_cost,
                'paid' => $item->paid,
                'payment_type' => $item->payment_type,
                'remaining_cost' => $item->remaining_cost,
                'description' => $item->description,
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
