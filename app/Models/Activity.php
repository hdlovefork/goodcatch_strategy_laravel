<?php

namespace App\Models;

use App\Services\Contract\Chain;
use App\Services\Pipeline;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model implements Chain
{
    use HasFactory;

    public function strategies()
    {
        return $this->belongsToMany(Strategy::class);
    }

    public function handle(mixed $payload, $next)
    {
        $result = (new Pipeline($this->strategies))->process($payload);
        if (false !== $result) {
            return $result;
        }
        return $next($payload);
    }
}
