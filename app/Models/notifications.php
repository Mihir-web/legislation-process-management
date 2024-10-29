<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Sortable\Traits\Sortable;
  
class notifications extends Model
{
    use HasFactory, Sortable;
    // use ;
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    

    protected $fillable = [
        'id',
        'user_id',
        'message',
        'status',
        'created_at', 
        'updated_at'
    ];

    protected  $table = 'notifications';
}