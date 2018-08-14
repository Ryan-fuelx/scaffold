<?php namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\HasActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasActivity;
    use SoftDeletes;

    public $table = 'posts';

    public $fillable = [
    "title",
    "content",
    "password",
    "email",
    "category",
    "status",
    "created_by"
];

    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
    "title",
    "content",
    "password",
    "email",
    "category",
    "status",
    "created_by"
];

    /**
     * The attributes that should be casted to native types.
     *
     * @var  array
     */
    protected $casts = [
  'title' => 'string',
  'content' => 'string',
  'password' => 'string',
  'email' => 'string',
  'category' => 'string',
  'status' => 'integer',
  'created_by' => 'integer',
];
    protected $dates = ['deleted_at'];

    /**
     * Validation rules
     *
     * @var  array
     */
    public static $rules = [
  'title' => 'required',
  'content' => 'required',
  'password' => '',
  'email' => 'email',
  'category' => '',
  'status' => '',
  'created_by' => '',
  'comments' => '',
];
    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo('Modules\User\Models\User', 'created_by', 'id');
    }
    /**
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comments()
    {
        return $this->hasMany('Modules\Blog\Models\Comment', 'blog_id', 'id');
    }
}
