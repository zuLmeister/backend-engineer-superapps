<?php

namespace App\Http\Resources\ListProject;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pjo_name' => $this->pjo_name,
            'phone' => $this->phone,
            'location' => $this->location,
            'position' => $this->position,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'notes' => $this->notes,
            'project_type' => $this->project_type,
            
        ];
    }
}
