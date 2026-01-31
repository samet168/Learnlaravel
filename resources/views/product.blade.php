@extends('components.master')

@section('contents')
    <div class="container">
            <div class="col-md-12 grid-margin">
            <div class="card">

                @include('message.message')

                <div class="d-flex justify-content-between">
                    <h4>Product Stock</h4>
                    <form>
                        <input type="search" name="search" id="search" placeholder="Search Product" class="form-control " style="width: 250px; display: inline-block;" value="{{ request('search') }}">
                    </form>
                    <a href="/product/create" class="btn btn-primary">New Product</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>Product ID</th>
                        <th>name</th>
                        <th>price</th>
                        <th>Qty</th>
                        <th>image</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product) 
                    <tr>
                        <td>
                            <input type="checkbox" onclick="handleSelect()" value="{{ $product->id }}" name="" id="">
                            {{ $product->id }}
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>
                            <img src="{{ asset('uploads/'.$product->image) }}" alt="{{ $product->name }}" width="50">
                        </td>
                        <td>
                            <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('product.delete',$product->id) }}" onclick="confirm('Are you sure to delete this product?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                    </table>
                    <div class="mt-3 d-flex justify-content-between">
                        <div class="show-page  ">
                            {{ $products->links() }}
                        </div>
                        <div class="">
                            <button product-ids="" onclick="DeleteWithSelect()" id="btn-delete-select" class="btn btn-sm btn-primary d-none">Delete with select</button>
                        </div>
                        <div class="show-refresh">
                            <a href="{{ route('product.index') }}" class="btn btn-sm btn-info">Refresh</a>
                        </div>
                    </div>
                   
                </div>
                </div>
            </div>
            </div>
    </div>
@endsection

@section('scripts')
<script>
    function handleSelect() {
        let selected = [];

        let checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

        checkboxes.forEach(function(i) {
            selected.push(i.value);
        });

        console.log(selected);
       

        //  $('#btn-delete-select').attr('product-ids', productIds);
        if(selected.length > 0) {
            //convert array to string with comma
            let productIds = selected.join(',');
            console.log(productIds);

            $('#btn-delete-select').removeClass('d-none');
            $('#btn-delete-select').text(`Delete with select (${selected.length})`);
             $('#btn-delete-select').attr('product-ids', productIds);

        } else {
            $('#btn-delete-select').addClass('d-none');
        }
    }

    
    const DeleteWithSelect = ()=>{
            
            if(confirm('Are you sure to delete selected products?')) {
                let productIds = $('#btn-delete-select').attr('product-ids');
                // let productIds = $(this).attr('product-ids');
                $.ajax({
                    url: '{{ route("product.deleteSelect") }}',
                    method: 'POST',
                    data: {
                        ids: productIds,
                    },
                    dataType: 'json',
                    success: function(res) {
                        window.location.href = '{{ route("product.index") }}';
                    },

                });
            }
        };

    // const DeleteWithSelect = () => {
    //     if(confirm('Are you sure to delete selected products?')) {
    //         let productIds = $('#btn-delete-select').attr('product-ids');

    //         $.ajax({
    //             url: '{{ route("product.deleteSelect") }}',
    //             method: 'POST',
    //             data: {
    //                 ids: productIds,             // the selected product IDs
    //                 // _token: '{{ csrf_token() }}' // <-- add CSRF token here
    //             },
    //             dataType: 'json',
    //             success: function(res) {
    //                 // redirect after delete
    //                 window.location.href = '{{ route("product.index") }}';
    //             }
    //         });
    //     }
    // };
</script>
@endsection

 