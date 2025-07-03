<?php
namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Post::with('category', 'author')->get()->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'category' => $post->category?->name,
                'author' => $post->author?->name,
                'created_at' => $post->created_at->toDateTimeString(),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Body', 'Category', 'Author', 'Created At'];
    }
}

