@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{url('/product_create')}}" method="post" enctype='multipart/form-data' class="border p-2">
        <h1 class="">Create new product !</h1>
        @csrf

        <div class="d-flex justify-content-between border p-4">
            <div class="mb-3">
                @if($errors->has('name_am'))
                    <label class="text-danger small">{{ $errors->first('name_am') }}</label>
                @else
                    <label for="name_am" class="form-label">Name in Armenian</label>
                @endif
                <input type="name_am" class="form-control" id="name_am" placeholder="Enter name in Armenian" name="name_am" value="{{old('name_am')}}">
            </div>
            <div class="mb-3">
                @if($errors->has('name_ru'))
                    <label class="text-danger small">{{ $errors->first('name_ru') }}</label>
                @else
                    <label for="name_ru" class="form-label">Name in Rusian</label>
                @endif
                <input type="name" class="form-control" id="name_ru" placeholder="Enter name in Rusian" name="name_ru" value="{{old('name_ru')}}">
            </div>
            <div class="mb-3">
                @if($errors->has('name_en'))
                    <label class="text-danger small">{{ $errors->first('name_en') }}</label>
                @else
                    <label for="name_en" class="form-label">Name in English</label>
                @endif
                <input type="name_en" class="form-control" id="name_en" placeholder="Enter name in English " name="name_en" value="{{old('name_en')}}">
            </div>
        </div>
        <div class="mb-3 mt-3">
            @if($errors->has('image'))
                <label class="text-danger small">{{ $errors->first('image') }}</label>
            @else
                <label for="image" class="form-label">Image:</label>
            @endif
            <input type='file' id="image" name="image" accept="image/*" />
        </div>
        <div class="d-flex justify-content-between border p-4">
            <div class="mb-3">
                @if($errors->has('description_am'))
                    <label class="text-danger small">{{ $errors->first('description_am') }}</label>
                @else
                    <label for="description_am" class="form-label">Description in Armenian:</label>
                @endif
                <textarea type="text" class="form-control" id="description_am" placeholder="Description in Armenian" cols="20" rows="8" name="description_am" value="{{old('description_am')}}"></textarea>
            </div>
            <div class="mb-3">
                @if($errors->has('description_ru'))
                    <label class="text-danger small">{{ $errors->first('description_ru') }}</label>
                @else
                    <label for="description_ru" class="form-label">Description in Russian:</label>
                @endif
                <textarea type="text" class="form-control" id="description_ru" placeholder="Description in Russian" cols="20" rows="8" name="description_ru" value="{{old('description_ru')}}"></textarea>
            </div>
            <div class="mb-3">
                @if($errors->has('description_en'))
                    <label class="text-danger small">{{ $errors->first('description_en') }}</label>
                @else
                    <label for="description_en" class="form-label">Description in English:</label>
                @endif
                <textarea type="text" class="form-control" id="description_en" placeholder="Description in English" cols="20" rows="8" name="description_en" value="{{old('description_en')}}"></textarea>
            </div>
        </div>
        <div class="mb-3">
            @if($errors->has('tag'))
                <label class="text-danger small">{{ $errors->first('tag') }}</label>
            @else
                <label for="description" class="form-label">Tags</label>
            @endif
            @foreach ($tags as $item)
                <div class="btn">
                    <label> {{ $item->name}} </label>
                    <input value="{{$item->id}}" type="checkbox" name="tag[]">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection