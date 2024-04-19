<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiGoiData extends Model
{

    protected $table = 'loaigoidata';
    public function GoiData(): HasMany
    {
    return $this->hasMany(GoiData::class, 'loaigoidata_id', 'id');
    }
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('tenloai','like','%'.$key.'%');
        }
        return $query;
    }


}