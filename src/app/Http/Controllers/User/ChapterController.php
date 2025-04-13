<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Novel $novel)
    {
        $chapters = Chapter::query()
            ->with('novel')
            ->where('novel_id', $novel->id)
            ->get();

        return Inertia::render('User/Chapter/Index', [ 'novel' => $novel, 'chapters' => $chapters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Novel $novel)
    {
        return Inertia::render('User/Chapter/Create', ['novel' => $novel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request, Novel $novel)
    {
        $model = new Chapter();
        $model->title = $request->title;
        $model->novel_id = $novel->id;
        $model->save();

        return redirect()
            ->route('user.chapters.index', ['novel' => $novel])
            ->with(['message' => '章を作成しました', 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel, Chapter $chapter)
    {
        $chapter->load('novel');
        return Inertia::render('User/Chapter/Edit', ['chapter' => $chapter]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreChapterRequest $request, Novel $novel, Chapter $chapter)
    {
        $model = $chapter;
        $model->title = $request->title;
        $model->novel_id = $novel->id;
        $model->save();

        return redirect()
            ->route('user.chapters.index', ['novel' => $novel])
            ->with(['message' => '章を更新しました', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel, Chapter $chapter)
    {
        $chapter->delete();
        return redirect()
            ->route('user.chapters.index', ['novel' => $novel])
            ->with(['message' => '章を削除しました', 'status' => 'success']);
    }
}
