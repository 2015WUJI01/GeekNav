@extends('layouts.app')

@section('title', '修改站点')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('link.update', ['id' => $link->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        站点名：
        <input type="text" name="name" value="{{ $link->name }}">
        <br>

        网址：
        <input type="text" name="url" value="{{ $link->url }}">
        <br>

        Logo地址：
        <input type="text" name="logo" value="{{ $link->logo }}">
        <br>

        描述：
        <textarea name="description" id="description" cols="30" rows="4" value="{{ $link->description }}"></textarea>
        <br>

        分类：
        <select name="category" id="category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"{{ ($link->categories()->first() && $link->categories()->first()->id == $category->id) ? "selected" : ""}}>{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">提交</button>
    </form>
@endsection
