@extends('layouts.app')
  
@section('title', 'Home Product')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    
    <!-- <div class="row">
        <div class="col-md-5">
            <from action="{{ route('products.search') }}" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search keyword.." aria-label="Search keyword.." name="keywoard" autocomplete="off">
                <div>    
                    <input class="btn btn-primary" type="submit" name="submit">
                </div>
            </div>
            </from>
        </div>
    </div>
-->

    <table class="table table-hover">
        <thead class="btn-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($product->count() > 0)
                @foreach($product as $key => $rs)
                    <tr>
                        <td class="align-middle">{{ $product->firstItem() + $key }}</td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ $rs->price }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>  
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('products.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="pull-right">
    {{ $product->links() }}
    </div>


    <!--<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
        <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
        <a class="page-link" href="#">Next</a>
        </li>
        </ul>
    </nav> -->
@endsection