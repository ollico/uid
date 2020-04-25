<?php

namespace Tests\Fakes;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Ollico\Uid\Traits\HasUid;

class Model extends EloquentModel
{
    use HasUid;
}
