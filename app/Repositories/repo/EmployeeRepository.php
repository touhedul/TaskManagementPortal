<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\repo\BaseRepository;

/**
 * Class EmployeeRepository
 * @package App\Repositories
 * @version June 30, 2021, 9:51 am +06
*/

class EmployeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'image'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Employee::class;
    }
}
