<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //Tabela de Despesas

    //atributos da tabela
    protected $fillable = ['id', 'description', 'date', 'user_id', 'price', 'created_at', 'updated_at'];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function user(){
        $this->belongsTo(User::class);
    }
}
