<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'assigned_to',
        'user_id',
        'start_date',
        'end_date',
        'priority',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function getStatusAttribute($value)
    {
        # Bu kısım dil fonksiyonları ile de ayarlanabilir ben basitçe array kullandım.
        return ['todo' => 'Yapılacak','in_progress' => 'Devam Ediyor','done' => 'Tamamlandı'][$value];
    }

    public function getPriorityAttribute($value)
    {
        return ['low' => 'Düşük','medium' => 'Orta','high' => 'Yüksek'][$value];
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date('Y-m-d', strtotime($value));
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = date('Y-m-d', strtotime($value));
    }
}
