<?php

namespace Tests\Fakes;

use WeAreAlgomas\Uid\Traits\HasUid;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasUid;
}
