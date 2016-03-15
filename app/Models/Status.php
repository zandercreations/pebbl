<?php

namespace Pebbl\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    
    protected $fillable = [
        'body'
    ];
    
    public function user()
    {
        return $this->belongsTo('Pebbl\Models\User', 'user_id');
        
    }
    
    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }
    
    public function replies()
    {
        return $this->hasMany('Pebbl\Models\Status', 'parent_id');
    }
    
    public function likes()
    {
        return $this->MorphMany('Pebbl\Models\Like', 'likeable');
    }
}