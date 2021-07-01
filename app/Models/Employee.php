<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Employee
 * @package App\Models
 * @version June 30, 2021, 9:51 am +06
 *
 * @property string $name
 * @property string $email
 * @property string $image
 */
class Employee extends Model
{

    use HasFactory;

    public $table = 'employees';




    public $fillable = [
        'name',
        'email',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'image' => 'required|image|max:10000'
    ];
}
