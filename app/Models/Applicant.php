<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'phone', 'address', 'education_level',
        'institution', 'gpa_average', 'birth_date', 'birth_place',
        'gender', 'status', 'notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function documents()
    {
        return $this->hasOne(Document::class);
    }
}