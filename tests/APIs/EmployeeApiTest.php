<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Employee;

class EmployeeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_employee()
    {
        $employee = Employee::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/employees', $employee
        );

        $this->assertApiResponse($employee);
    }

    /**
     * @test
     */
    public function test_read_employee()
    {
        $employee = Employee::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/employees/'.$employee->id
        );

        $this->assertApiResponse($employee->toArray());
    }

    /**
     * @test
     */
    public function test_update_employee()
    {
        $employee = Employee::factory()->create();
        $editedEmployee = Employee::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/employees/'.$employee->id,
            $editedEmployee
        );

        $this->assertApiResponse($editedEmployee);
    }

    /**
     * @test
     */
    public function test_delete_employee()
    {
        $employee = Employee::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/employees/'.$employee->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/employees/'.$employee->id
        );

        $this->response->assertStatus(404);
    }
}
