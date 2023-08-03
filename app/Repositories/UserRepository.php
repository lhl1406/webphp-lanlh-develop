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
}
