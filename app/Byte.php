<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Byte extends Model
{
    /**
     * @var array
     */
    public $guarded = [];
    //public $fillable = ['name', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place() {
        return $this->belongsTo('App\Place');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timezone() {
        return $this->belongsTo('App\Timezone');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lines() {
        return $this->belongsToMany('App\Line');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function people() {
        return $this->belongsToMany('App\Person');
    }
}
