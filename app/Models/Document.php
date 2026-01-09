<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftar_id', 'cover_letter_path', 'transcript_path',
        'cv_path', 'photo_path', 'id_card_path'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(pendaftar::class);
    }
}