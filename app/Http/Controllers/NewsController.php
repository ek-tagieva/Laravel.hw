<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('id', 'desc')->get();
        return view('news.list', ['news' => $news]);
    }

    public function show(int $newsId)
    {
        $newsSingle = News::query()->find($newsId);
        return view('news.single-news', ['newsSingle' => $newsSingle]);
    }
    public function newsList()
    {
        $news = News::orderBy('id', 'desc')->get();
        return view('news.list-admin', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        News::create($input);

        $photo = $request->file('photo');
        $lastId = News::query()->latest()->value('id');
        $photoName =  '/img/news/photo-' . $lastId . '.' . $photo->getClientOriginalExtension();
        News::query()->find($lastId)->update([
            'photo' =>  $photoName
        ]);
        $photo->move(__DIR__ . '../../../../public/img/news', $photoName); // эта строка для локального компьютера Win10
//        $photo->move('img/news', $photoName);  // эта строка для хостинга

        return redirect('admin/news');
    }

    public function deleteNews(News $news)
    {
        $news->delete();

        return redirect('admin/news');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News  $news
     * @return Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  News  $news
     * @return Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News  $news
     * @return Response
     */
    public function destroy(News $news)
    {
        //
    }
}
