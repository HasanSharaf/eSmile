<?php


namespace Modules\FinancialAccount\Http\Resources;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Session\Http\Resources\SessionResource;
use Modules\User\Http\Resources\UserResource;

class FinancialAccountResource extends BaseResource
{   
    private $withAdditionalData;

    public function __construct($resource, $withAdditionalData = true)
    {
        parent::__construct($resource);
        $this->withAdditionalData = $withAdditionalData;
    }

    public function toArray($request)
    {
        $this->collection = $this->collection->map(function ($item) {
            $item->loadMissing('financialAccount.user', 'financialAccount.session'); // Load session and sub session relationships

            $additionalData = [
                'user' => $item->financialAccount->user ?? [],
                'sessions' => $item->financialAccount->session->map(function ($session) {
                    return [
                        'session_id' => $session->id,
                        'full_cost' => $session->full_cost,
                        'paid' => $session->paid,
                        'remaining_cost' => $session->remaining_cost,
                        'createdAt' => $session->created_at ? Carbon::parse($session->created_at)->format('m/d/Y H:i') : null,
                        'updatedAt' => $session->updated_at ? Carbon::parse($session->updated_at)->format('m/d/Y H:i') : null,
                        'sub_sessions' => $session->subSession->map(function ($subSession) {
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
                }),
            ];

            $dataToReturn = [
                'session_id' => $item->id,
                'user_id' => $item->financialAccount->user->id,
                'full_cost' => $item->full_cost,
                'paid' => $item->paid,
                'remaining_cost' => $item->remaining_cost,
                'createdAt' => $item->created_at ? Carbon::parse($item->created_at)->format('m/d/Y H:i') : null,
                'updatedAt' => $item->updated_at ? Carbon::parse($item->updated_at)->format('m/d/Y H:i') ?? null : $item->updated_at,
            ];

            if ($this->withAdditionalData) {
                $dataToReturn = array_merge($dataToReturn, $additionalData);
            }

            return $dataToReturn;
        });

        return $this->resolvePaginationResults($this);
    }

}

