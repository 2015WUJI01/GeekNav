<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Exception;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::all();
        return $links;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Category::all();
        $categories = Category::where("parent_id","><", 0)->get();
        return view('links.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $messages = [
            'url.required' => '网址为必填项',
            'url.unique' => '已存在该网址',
            'url.url' => '网址格式错误',
            'name.required' => '网站名为必填项',
        ];

        $rules = [
            'url' => 'required|unique:links|url',
            'name' => 'required'
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('/link/create')
                ->withErrors($validator)
                ->withInput();
        }

        $link = new Link;
        $link->url = $input['url'];
        $link->name = $input['name'];
        $link->logo = $input['logo'];
        $link->description = $input['description'];
        try {
            $link->save();
        } catch (\Exception $e) {
            throw $e;
        }
        $link->categories()->attach($input['category']);

        return redirect('/')->with('success', "创建站点 {$link->name} 成功！");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = Link::findOrFail($id);
        if ($link)
            return $link;
        else
            return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::findOrFail($id);
//        $categories = Category::all();
        $categories = Category::where("parent_id","><", 0)->get();

        return view('links.edit', [
            'link' => $link,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $link = Link::findOrFail($id);

        $messages = [
            'url.required' => '网址为必填项',
            'url.url' => '网址格式错误',
            'name.required' => '网站名为必填项',
        ];

        $rules = [
            'url' => 'required|url',
            'name' => 'required',
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('/link/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $link->url = $input['url'];
        $link->name = $input['name'];
        $link->logo = $input['logo'];
        $link->description = $input['description'];
        try {
            $link->save();
        } catch (\Exception $e) {
            throw $e;
        }

        $old_category = $link->categories()->first()->id;
        $new_category = $input['category'];
        if ($old_category != $new_category)
            $link->categories()->updateExistingPivot($old_category, [
                'category_id' => $new_category
            ]);

        return $link;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $link = Link::find($id);
//        if ($link)
//            $link->delete();
    }

    public function visitLink(Request $request, $id)
    {
        if ($request->ajax() && $request->method() == 'POST') {
            $link = Link::findOrFail($id);
            $link->visited += 1;
            $link->save();
            return response(json_encode($link), 200);
        }

        return response("请求失败", 500);
    }
}
