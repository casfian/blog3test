<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

use App\Models\Post; //add this 

class PostsImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        
        return new Post([
                'id' => $row[0],
                'tajuk' => $row[1],
                'kandungan' => $row[2],
                'create_at' => $row[3],
                'updated_at' => $row[4],
                'user_id' => $row[5],
                'photo' => $row[6]
            ]);
    }
}
