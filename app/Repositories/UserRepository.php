<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{
    public function getModel() {
        return User::class;
    }

     /**
     * Get user list by email
     * 
     * @param string email
     * @param @mixed id
     * @return @mixed $result
     */
    public function dupllicateEmail(string $email) {
        try{
            $result = $this->model->where('email', $email)
                ->whereNull('deleted_date')
                ->get();
            } catch (Exception $exption) {
                Log::error($exption->getMessage()); 
        }
        
        if($result) { 
            return $result;
        }

        return [];
    }
}
