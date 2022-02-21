<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\PromoteLevel;

class TargetMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'levels_id',
        'status',
    ];

    public function promote()
    {
        return $this->belongsTo(PromoteLevel::class, 'levels_id');
    }
}
