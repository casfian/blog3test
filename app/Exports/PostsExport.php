<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; //add for heading
use App\Models\Post; //add this 

class PostsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $posts = Post::all();
        return $posts;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tajuk',
            'Kandungan',
            'Created at',
            'Updated at',
            'user_id',
            'photo'
        ];
    }

}
