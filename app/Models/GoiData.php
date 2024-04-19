<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoiData extends Model
{
    protected $table = 'goidata';
    protected $fillable = [
        'loaigoidata_id',
        'tengoidata_id',
        'tengoicuoc',
        'tengoicuoc_slug',
        'thongtingoicuoc',
        //'soluong',
        'dongia',
        'hinhanh',
        ];
    public function LoaiGoiData(): BelongsTo
        {
            return $this->belongsTo(LoaiGoiData::class, 'loaigoidata_id', 'id');
        }
    public function GiaGoiData(): BelongsTo
    {
    return $this->belongsTo(TenGoiData::class, 'tengoidata_id', 'id');
    }
    public function DonHang_ChiTiet(): HasMany
    {
    return $this->hasMany(DonHang_ChiTiet::class, 'goidata_id', 'id');
    }
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('tengoicuoc','like','%'.$key.'%')
            ->orWhere('dongia',$key);
        }
        return $query;
    }
}