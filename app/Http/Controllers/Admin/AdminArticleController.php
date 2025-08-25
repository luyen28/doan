<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequestArticle;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('menu:id,mn_name');

        // Lọc theo tên
        if ($request->name) {
            $articles->where('a_name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo trạng thái
        if ($request->has('status') && $request->status !== '') {
            $articles->where('a_active', $request->status);
        }

        $articles = $articles->orderByDesc('id')->paginate(10);

        return view('admin.article.index', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.article.create', compact('menus'));
    }

    public function store(AdminRequestArticle $request)
    {
        $data = $request->except('_token', 'a_avatar', 'a_position_1', 'a_position_2');
        $data['a_slug']      = Str::slug($request->a_name);
        $data['created_at']  = Carbon::now();

        $data['a_position_1'] = $request->a_position_1 ? 1 : 0;
        $data['a_position_2'] = $request->a_position_2 ? 1 : 0;

        if ($request->a_avatar) {
            $image = upload_image('a_avatar');
            if ($image['code'] == 1) {
                $data['a_avatar'] = $image['name'];
            }
        }

        Article::insertGetId($data);
        return redirect()->back()->with('success', 'Thêm mới bài viết thành công');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $menus   = Menu::all();
        return view('admin.article.update', compact('menus', 'article'));
    }

    public function update(AdminRequestArticle $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->except('_token', 'a_avatar', 'a_position_1', 'a_position_2');
        $data['a_slug']      = Str::slug($request->a_name);
        $data['updated_at']  = Carbon::now();

        $data['a_position_1'] = $request->a_position_1 ? 1 : 0;
        $data['a_position_2'] = $request->a_position_2 ? 1 : 0;

        if ($request->a_avatar) {
            $image = upload_image('a_avatar');
            if ($image['code'] == 1) {
                $data['a_avatar'] = $image['name'];
            }
        }

        $article->update($data);
        return redirect()->back()->with('success', 'Cập nhật bài viết thành công');
    }

    public function active($id)
    {
        $article = Article::findOrFail($id);
        $article->a_active = !$article->a_active;
        $article->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }

    public function hot($id)
    {
        $article = Article::findOrFail($id);
        $article->a_hot = !$article->a_hot;
        $article->save();

        return redirect()->back()->with('success', 'Cập nhật nổi bật thành công');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }

        return redirect()->back()->with('success', 'Xóa bài viết thành công');
    }
}
