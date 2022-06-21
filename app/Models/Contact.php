<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * @property int $id
     * @property string $full_name
     * @property string $email
     * @property Carbon $date_of_birth
     * @property string $company
     * @property int $phone
     * @property string $image_path
     * @property Carbon $created_at
     * @property Carbon $updated_at
     */
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
