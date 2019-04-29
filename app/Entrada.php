<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
	protected $table = 'entrada';
   	protected $fillable = ['entrada_h', 'saida_h','placa'];
   	public $timestamps = false;
}
