<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'provider', 'api_key', 'base_url', 'model', 'is_default', 'web_search_enabled'])]
class AiProvider extends Model
{
    //
}
