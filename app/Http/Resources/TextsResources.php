<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TextsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_title' => $this->first_title,
            'first_paragraph' => $this->first_paragraph,
            'second_title' => $this->second_title,
            'second_paragraph' => $this->second_paragraph,
            'third_title' => $this->third_title,
            'third_paragraph' => $this->third_paragraph,
            'epilogue' => $this->epilogue
        ];
    }
}
