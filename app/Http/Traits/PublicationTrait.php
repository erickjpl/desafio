<?php

namespace App\Http\Traits;

use App\Http\Data\PublicationRepository;

trait PublicationTrait
{

    public function getPublicationsUser()
    {
        return \DB::table('publications')->where('user_id', \Auth::id())->get();
    }
}
