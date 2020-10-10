<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // gett articles
        $articles=Article::orderBy('created_at', 'desc')->paginate(7);
        //return collection of articles as a resource
        return ArticleResource::collection($articles);      
    }

    public function show($id)
    {
        // get article
        $article=Article::findOrFail($id);
        //return single articles as a resource
        return new ArticleResource($article);
    }

    public function store(Request $request)
    {
        $article=Article::create([
            'title'=>request('title'),
            'body'=>request('body')
        ]);
        return new ArticleResource($article);
    }

    public function update(Request $request, $id)
    {
        $article=Article::findOrFail($id);
        $article->title=request('title');
        $article->body=request('body');
        $article->update();
        return new ArticleResource($article);
    }

    public function destroy($id)
    {
        $article=Article::findOrFail($id);
        $article->delete();
        return new ArticleResource($article);
    }
}
