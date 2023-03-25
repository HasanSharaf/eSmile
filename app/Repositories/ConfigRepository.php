<?php

namespace  App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use App\Helpers\Classes\Logger;

class ConfigRepository extends EloquentBaseRepository
{
   


    /**
     * get config by key.
     * @return Config
     */
    public function getConfigByKey($key)
    {
       $result = Config::where(['key'=>$key])->get()->first() ?? null;
       return $result;
    }

    /**
     * set config by key.
     * @return Config
     */
    public function setConfigByKey($key,$value)
    {
       $result = Config::updateOrCreate(['key'=>$key],['value'=>$value]);
       return $result;
    }
}
