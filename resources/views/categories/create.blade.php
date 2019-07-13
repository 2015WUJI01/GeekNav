@extends('layouts.app')

@section('content')
    @include('layouts.error')
    <form action="{{ route('category.store') }}" method="post">
        {{ csrf_field() }}

        类别名：
        <input type="text" name="name">
        <br>

        <button type="submit">提交</button>
    </form>
@endsection
