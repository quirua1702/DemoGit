<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('tengoicuoc','tenloai','tengoi','like','%'.$key.'%');
        }
        return $query;
    }
   

}