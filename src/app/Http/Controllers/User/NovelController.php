<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNovelRequest;
use App\Http\Requests\UpdateNovelRequest;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $novels = Novel::query()
            ->where('user_id',$id)
            ->get();
        return Inertia::render('User/Novel/Index', ['novels' => $novels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Novel/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNovelRequest $request)
    {
        $model = new Novel();
        $model->title = $request->title;
        $model->user_id = Auth::id();
        $model->save();

        return redirect()
            ->route('user.novels.index')
            ->with(['message' => '小説を作成しました', 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Novel $novel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel)
    {
        return Inertia::render('User/Novel/Edit', ['novel' => $novel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNovelRequest $request, Novel $novel)
    {
        $model = $novel;
        $model->title = $request->title;
        $model->user_id = Auth::id();
        $model->save();
        return redirect()
            ->route('user.novels.index')
            ->with(['message' => '小説を更新しました', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel)
    {
        $novel->delete();
        return redirect()
            ->route('user.novels.index')
            ->with(['message' => '小説を削除しました', 'status' => 'success']);
    }
}
