<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 对应数据表
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array 白名单
     */
    protected $fillable = [
        'name'
    ];

    /**
     * 要触发的所有关联关系
     *
     * @var array
     */
//    protected $touches = ['link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function links()
    {
        return $this->belongsToMany('App\Models\Link')
            ->withTimestamps();
    }

}
