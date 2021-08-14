<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\ArticleStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticleResource::collection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleStoreRequest  $request
     * @return ArticleResource
     */
    public function store(ArticleStoreRequest $request): ArticleResource
    {
        $article = $this->attachOrDetachTagsOfArticle(
            Article::create($request->validated()),
            $request->tags
        );

        $article->save();

        return new ArticleResource(
            $article
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Article  $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArticleStoreRequest $request
     * @param  Article  $article
     * @return ArticleResource
     */
    public function update(ArticleStoreRequest $request, Article $article): ArticleResource
    {
        $article->update($request->validated());

        $updated_article = $this->attachOrDetachTagsOfArticle(
            $article,
            $request->tags
        );

        $updated_article->save();

        return new ArticleResource(
            $updated_article
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Article $article
     * @param Array $tags
     */
    private function attachOrDetachTagsOfArticle(Article $article, Array $tags): Article
    {
        $article->tags()->detach();

        foreach ($tags as $tag) {
            if ($hasTag = Tag::where('title', $tag['title'])->first()) {
                $article->tags()->attach($hasTag->id);
            } else {
                $new_tag = Tag::create($tag);
                $article->tags()->attach($new_tag);
            }
        }

        return $article;
    }
}
