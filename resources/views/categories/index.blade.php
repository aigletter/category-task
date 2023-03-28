@extends('layouts.main', [
    'language' => $language
])

@section('content')
    <form action="{{ route('categories.update', ['language' => $language]) }}" method="post">
        @method('put')
        @csrf()
        <div class="row py-1">
            <div class="col-1">
                @lang('ID')
            </div>
            <div class="col-5">
                @lang('Name')
            </div>
            <div class="col-6">
                @lang('Parent category')
            </div>
        </div>
        @foreach($categories as $category)
            <div class="row py-1">
                <div class="col-1">
                    {{ $category->id }}
                </div>
                <div class="col-5">
                    <input type="text" name="categories[{{ $category->id }}]" value="{{ $category->translation->content ?? '' }}">
                </div>
                <div class="col-6">
                    {{ $category->parent->translation->content ?? '-' }}
                </div>
            </div>
        @endforeach
        <div class="row pt-4">
            <div class="col">
                <div class="">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
@endsection
