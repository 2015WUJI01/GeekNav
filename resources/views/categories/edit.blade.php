@extends('layouts.app')

@section('title', '修改分类')

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

    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        类别名：
        <input type="text" name="name" value="{{ $category->name }}">
        <br>

        <button type="submit">提交</button>
    </form>
@endsection
