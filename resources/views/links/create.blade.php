@extends('layouts.app')

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

    <form action="{{ route('link.store') }}" method="post">
        {{ csrf_field() }}

        站点名：
        <input type="text" name="name">
        <br>

        网址：
        <input type="text" name="url">
        <br>

        Logo地址：
        <input type="text" name="logo">
        <br>

        描述：
        <textarea name="description" id="description" cols="30" rows="4"></textarea>
        <br>

        分类：
        <select name="category" id="category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">提交</button>
    </form>
@endsection
