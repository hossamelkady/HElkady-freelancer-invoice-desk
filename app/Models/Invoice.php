<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model {protected $fillable=['number','client_id','issue_date','due_date','amount','currency','status']; protected $casts=['issue_date'=>'date','due_date'=>'date','amount'=>'decimal:2']; public function client(){return $this->belongsTo(Client::class);}}
