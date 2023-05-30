<?php

namespace App\Exports;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;




class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Post::select('id', 'name', 'age', 'salary', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS created_at"), DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') AS updated_at"))->get();

    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Age',
            'Salary',
            'Created_at',
            'Updated_at',
            // Add more columns if needed
        ];
    }
}
