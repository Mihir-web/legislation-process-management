<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Sortable\Traits\Sortable;
  
class amendments extends Model
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
        'bill_id',
        'user_id',
        'comment',
        'created_at', 
        'updated_at'
    ];

    protected  $table = 'amendments';

    public function user()
{
    return $this->belongsTo(User::class);
}
}