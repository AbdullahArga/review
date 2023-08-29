<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable=['title','body','image','user_id','is_active','is_admin'];
    protected $cast=[
        'is_active'=>'boolean'
    ];

    public function deleteImage(){
        //TODO - delete Image
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeSelf($query,$self=false){
        if($self)
        return $query->where('user_id',auth()->id());

        return $query;
    }
    public function scopeAdmin($query,$is_admin=false){
        if($is_admin)
        return $query->whereNotNull('is_admin')->whereIsActive(true);
        return $query;
    }
    public function scopeSearch($query){
        if($search=request()->input('search')){
            $query->where(function($query)use($search){
                return $query->where('title','like',"%$search%");
                return $query->orWhere('title','like',"%$search%");
            });
        }
        return $query;
    }


}
