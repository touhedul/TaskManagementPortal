<?php

namespace App\Http\Controllers\API;

use App\Helpers\FileHelper;
use App\Http\Requests\API\CreateEmployeeAPIRequest;
use App\Http\Requests\API\UpdateEmployeeAPIRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployeeResource;
use Response;

use Image;
use File;

/**
 * Class EmployeeController
 * @package App\Http\Controllers\API
 */

class EmployeeAPIController extends AppBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
    }

    /**
     * Display a listing of the Employee.
     * GET|HEAD /employees
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $employees = $this->employeeRepository->model()::latest()->get();
        // $employees = $this->employeeRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        // );

        return $this->sendResponse(EmployeeResource::collection($employees), 'Employees retrieved successfully');
    }

    /**
     * Store a newly created Employee in storage.
     * POST /employees
     *
     * @param CreateEmployeeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeAPIRequest $request)
    {
        $input = $request->all();
        $imageName = (new FileHelper())->uploadImage($request);
        $employee = $this->employeeRepository->create(array_merge($input, ['image' => $imageName]));
        return $this->sendResponse(new EmployeeResource($employee), 'Employee saved successfully');
    }

    /**
     * Display the specified Employee.
     * GET|HEAD /employees/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Employee $employee */
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            return $this->sendError('Employee not found');
        }

        return $this->sendResponse(new EmployeeResource($employee), 'Employee retrieved successfully');
    }

    /**
     * Update the specified Employee in storage.
     * PUT/PATCH /employees/{id}
     *
     * @param int $id
     * @param UpdateEmployeeAPIRequest $request
     *
     * @return Response
     */
    public function update(UpdateEmployeeAPIRequest $request, $id)
    {
        $employee = $this->employeeRepository->find($id);
        $input = $request->all();
        $imageName = (new FileHelper())->uploadImage($request, $employee);
        $employee = $this->employeeRepository->update(array_merge($input, ['image' => $imageName]), $id);

        return $this->sendResponse(new EmployeeResource($employee), 'Employee updated successfully');
    }

    /**
     * Remove the specified Employee from storage.
     * DELETE /employees/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Employee $employee */
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            return $this->sendError('Employee not found');
        }

        FileHelper::deleteImage($employee);
        $employee->delete();

        return $this->sendSuccess('Employee deleted successfully');
    }
}
