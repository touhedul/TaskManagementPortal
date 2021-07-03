<?php

namespace App\Http\Controllers\API;

use App\Helpers\FileHelper;
use App\Http\Requests\API\CreateEmployeeAPIRequest;
use App\Http\Requests\API\UpdateEmployeeAPIRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeInterface;

class EmployeeAPIController extends Controller
{

    private $employeeRepository;


    public function __construct(EmployeeInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }


    public function index(Request $request)
    {
        $employees = $this->employeeRepository->latestEmployee();

        return $this->jsonResponse(EmployeeResource::collection($employees), 'Employees retrieved successfully', 200);
    }


    public function store(CreateEmployeeAPIRequest $request)
    {
        $input = $request->all();
        $imageName = (new FileHelper())->uploadImage($request);
        $employee = $this->employeeRepository->create(array_merge($input, ['image' => $imageName]));

        return $this->jsonResponse(new EmployeeResource($employee), 'Employee saved successfully', 201);
    }


    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);

        return $this->jsonResponse(new EmployeeResource($employee), 'Employee retrieved successfully', 200);
    }


    public function update(UpdateEmployeeAPIRequest $request, $id)
    {
        $employee = $this->employeeRepository->find($id);
        $input = $request->all();
        $imageName = (new FileHelper())->uploadImage($request, $employee);
        $employee = $this->employeeRepository->update(array_merge($input, ['image' => $imageName]), $id);

        return $this->jsonResponse(new EmployeeResource($employee), 'Employee updated successfully', 200);
    }


    public function destroy($id)
    {
        $employee = $this->employeeRepository->find($id);

        FileHelper::deleteImage($employee);

        $employee->delete();

        return $this->jsonResponse([], 'Employee deleted successfully', 200);
    }
}
