<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Poli;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {

        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' kategori dari ' . $category->name;
        };

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' Postingan dari ' . $author->name;
        };

        $poli = Poli::where('isActive', 1)->latest()->get();
        $antrian = [];

        foreach ($poli as $poli) {
            $query = DB::table('antrian')
                ->where('kode_poli', $poli->kode_poli)
                ->where('status', 0)
                ->orderByRaw("SUBSTRING_INDEX(antrian, '-', -1) ASC")
                ->value('antrian');

            $data = [
                "antrian" => $query,
                "kode_poli" => $poli->kode_poli
            ];
            array_push($antrian, $data);
        }

        return view('posts', [
            "title" => $title,
            'active' => 'posts',
            'polis' => Poli::where('isActive', 1)->latest()->get(),
            'antrian' => json_decode(json_encode($antrian), false),
            // "posts" => Post::all()
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString() //menampilkan 7per halaman dan data/postingan terbaru
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => "Postingan",
            'active' => 'posts',
            "post" => $post
        ]);
    }

    public function search(Request $request)
    {
        $output = "";
        $query = $request->input('query');
        $results = Post::where('title', 'like', '%' . $query . '%')->get();

        if (count($results) == 0) {
            $output = '<p>Tidak ada hasil yang ditemukan</p>';
        } else {
            foreach ($results as $result) {
                $output .= '
                <hr>
                <div class="btn-search-post">
                    <a class="text-dark" href="/posts/' . $result->slug . '">
                        <div class="post-content">
                            <h5>' . $result->title . '</h5>
                            <p class="mb-1" disabled>' . $result->category->name . '</p>
                            <p>' . $result->excerpt . '</p>
                        </div>
                    </a>
                </div>
                <style>
                    .btn-search-post a {
                        text-decoration: none;
                    }
                    .post-content {
                        padding: 10px;
                        transition: all 0.2s ease-in-out;
                    }
                    .post-content:hover {
                        background-color: grey;
                        color: white;
                        cursor: pointer;
                    }
                </style>
                ';
            }
        }
        return response($output);
    }
}
