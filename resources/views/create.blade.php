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


                    <form class="forms-sample formCreateProduct"  method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        <p></p>
                      </div>
                      <div class="form-group">
                        <label for="Price">product Price</label>
                        <input type="number" class="form-control" name="price" id="Price" placeholder="Price">
                        <p></p>
                      </div>
                      <div class="form-group">
                        <label for="Qty">QTY</label>
                        <input type="number" class="form-control" name="qty" id="Qty" placeholder="QTY">
                        <p></p>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                       <input type="file" name="image" id="image" class="form-control">
 
                      </div>

                      <div class="form-group">
                        <label for="exampleTextarea1">Textarea</label>
                        <textarea class="form-control" id="desc" name="desc" rows="2"></textarea>
                        <p></p>
                      </div>
                      <button onclick="StoreProduct('.formCreateProduct')" type="button" class="btn btn-success mr-2">Save</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
    </div>
@endsection

@section('scripts')
<script>

const StoreProduct = (form) => {
    let payload = new FormData($(form)[0]);

    $.ajax({
        type: "POST",
        url: "{{ route('product.store') }}",
        data: payload,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(response) {

// reset 
          if (response.status == 200) {
              // form reset trigger
              $(form).trigger('reset');

              // remove field error
              $("input").removeClass("is-invalid").siblings('p').removeClass('text-danger').text("");

              // redirect to product list
              window.location.href = "{{ route('product.index') }}";
          }
// end Reset
          else {
           
//show field error            
                if(response.errors.name) {
                    $("#name").addClass("is-invalid").siblings('p').addClass('text-danger').text(response.errors.name);
                }else{
                    $("#name").removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                }
                if(response.errors.price) {
                    $("#Price").addClass("is-invalid").siblings('p').addClass('text-danger').text(response.errors.Price);
                }else{
                    $("#Price").removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                }
                if(response.errors.qty) {
                    $("#Qty").addClass("is-invalid").siblings('p').addClass('text-danger').text(response.errors.Qty);
                }else{
                    $("#Qty").removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                }
                if(response.errors.desc) {
                    $("#Desc").addClass("is-invalid").siblings('p').addClass('text-danger').text(response.errors.Desc);
                }else{
                    $("#Desc").removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                }
//end show field error
            }
        }
    });
}
</script>
@endsection
