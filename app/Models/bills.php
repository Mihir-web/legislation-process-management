<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Sortable\Traits\Sortable;
  
class bills extends Model
{
    use HasFactory, Sortable;
    // use ;
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    public $sortable = [
        'name',
        'model',
        'is_active'
    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'author_id',
        'status',
        'version_id',
        'created_at', 
        'updated_at'
    ];

    protected  $table = 'bills';
}