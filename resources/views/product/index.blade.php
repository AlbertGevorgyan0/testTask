@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Tags</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>
                    <img width="40" src="{{asset('images/'.$product->image)}}">
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>
                    <ul>
                        @foreach($product->producttags as $producttags)
                            <li>{{ $producttags->tags->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <button>
                        <a href="{{route('product_update', ['product_id' => $product->id] )}}"> Update </a>
                    </button>
                    <form action="{{url('/product_delete')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        <button>Delete</button>
                    </form>
                </td> 
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection
