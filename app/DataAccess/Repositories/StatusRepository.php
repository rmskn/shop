<?php

namespace App\DataAccess\Repositories;

use App\Models\Status;

class StatusRepository
{
    public function getStatusTitleByCode(int $code):string
    {
        return Status::query()
            ->select('title')
            ->where('code', $code)
            ->first()
            ->title;
    }
}
