<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    
    protected $table = 'files';
    protected $fillable = ['nome_arquivo', 'valor_total'];

    public function dados(){
        return $this->hasMany(Dados::class);
    }
}
