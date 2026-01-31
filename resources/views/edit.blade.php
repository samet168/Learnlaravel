@extends('components.master')

@section('contents')
    <div class="container">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Product Stock</h4>
                        <a href="/product" class="btn btn-danger">Back</a>
                        
                    </div>


                    <form action="{{ route('product.update', $product->id) }}" class="forms-sample" method="POST" enctype="multipart/form-data">
                      @csrf
                       {{-- @method('PUT') --}}

                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" name="name" id="name" placeholder="Name">
                        @error('name')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="Price">product Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}" name="price" id="Price" placeholder="Price">
                        @error('price')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="Qty">QTY</label>
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" value="{{ $product->qty }}" name="qty" id="Qty" placeholder="QTY">
                        @error('qty')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="image" class="form-control">
                        @if ($product->image != null)
                          <div>
                            <img src="{{ asset('uploads/'.$product->image) }}" alt="" width="150" class="p-3">
                          </div>
                        @endif
                        

                      </div>

                      <div class="form-group">
                        <label for="exampleTextarea1">Textarea</label>
                        <textarea class="form-control"  id="desc" name="desc" rows="2">{{ $product->description }} </textarea>
                      </div>
                      <button type="submit" class="btn btn-success mr-2">Update</button>
                      <button class="btn btn-light" type="button">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
    </div>
@endsection