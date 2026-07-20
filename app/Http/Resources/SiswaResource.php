<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'nisn' => $this->nisn,
            'kelas'=> $this->kelas,
            'waktu_absensi' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
