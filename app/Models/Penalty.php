<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = ['borrowing_id', 'overdue_days', 'amount'];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}
