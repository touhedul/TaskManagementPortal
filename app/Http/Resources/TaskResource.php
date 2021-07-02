<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'details' => $this->details,
            'status' => $this->status,
            'employee_id' => $this->employee_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
