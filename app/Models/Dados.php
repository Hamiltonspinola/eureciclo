<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dados extends Model
{
    use HasFactory;
    
    protected $table = 'dados';
    protected $fillable = ['comprador', 'descricao', 'endereco' , 'preco_unitario', 'quantidade', 'fornecedor', 'file_id'];

    public function file(){
        return $this->belongsTo(File::class);
    }
}
