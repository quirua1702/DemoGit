<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class TenGoiData extends Model
{
protected $table = 'tengoidata';
protected $fillable = [
    'tengoi',
    'tengoi_slug',
    ];
    public function GoiData(): HasMany
    {
    return $this->hasMany(GoiData::class, 'tengoidata_id', 'id');
    }
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('tengoi','like','%'.$key.'%');
        }
        return $query;
    }
}