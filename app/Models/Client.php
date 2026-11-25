<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Client extends Model {protected $fillable=['name','email','company','phone','notes']; public function user(){return $this->belongsTo(User::class);} public function invoices(){return $this->hasMany(Invoice::class);}}
