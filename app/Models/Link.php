<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * 对应数据表
     * @var string
     */
    protected $table = 'links';

    /**
     * 白名单
     * @var array
     */
    protected $fillable = [
        'url', 'name', 'logo', 'description', 'visited', 'type'
    ];

    /**
     * 要触发的所有关联关系
     *
     * @var array
     */
//    protected $touches = ['category'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')
            ->withTimestamps();
        # 第二个参数是连接表的表名
        # 第三个参数是定义此关联的模型在连接表里的外键名
        # 第四个参数是另一个模型在连接表里的外键名
//        return $this->belongsToMany('App\Models\Category', 'category_link', 'link_id', 'category_id')
//            ->withTimestamps();


    }

}
