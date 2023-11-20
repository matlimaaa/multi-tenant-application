<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'domain' => $this->domain,
            'bd_database' => $this->bd_database,
            'bd_hostname' => $this->bd_hostname,
            'bd_username' => $this->bd_username,
            'bd_password' => $this->bd_password,
            'created_at' => $this->created_at
        ];
    }
}
