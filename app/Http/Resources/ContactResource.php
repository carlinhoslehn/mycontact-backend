<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        unset($data['category_id']);
        $data['categories'] = new CategoryResource($this->category);
        $data['created_at'] = $this->created_at->format('d-m-Y h:i:s');
        $data['updated_at'] = $this->updated_at->format('d-m-Y h:i:s');

        return $data;
    }
}
