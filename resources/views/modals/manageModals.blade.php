
<div class="modal fade" id="productManageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form"  method="POST">
          @csrf
          @method('PATCH')
            <div class="form-row">
              <div class="col">
                <label for="productName">
                  Product Name
                </label>
                <input type="text" name="name" class="form-control" id='productName'>  
              </div>
              <div class="col">
                <label for="date">
                  Date
                </label>
                <input type="date" name="date" class="form-control" id='date'>  
              </div>
            </div>
            <div class="form-group">
              <label for="category">
                Category 
              </label>
              {{-- <input type="text" name="category" class="form-control" id='category'>  --}}
              <select class='form-control' name='category_id' id='category'>
                
                @foreach($categories as $category)
                  <option value={{$category->id}}>{{$category->categories}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="brand">
                Brand 
              </label>
              {{-- <input type="text" name="brand" class="form-control" id='brand'>  --}}
              <select class="form-control" name='brand_id' id='brand'>
               
                @foreach($brands as $brand)
                  <option value={{$brand->id}}>{{$brand->name}}</option>
                @endforeach
              </select>
            </div>
        <div class="form-row">
          <div class="col">
                <label for="productPrice">
                  Product Price
                </label>
                <input type="number" name="price" class="form-control" id='productPrice'>  
              </div>
              <div class="col">
                <label for="quantity">
                  Quantity
                </label>
                <input type="number" name="quantity" class="form-control" id='quantity'>  
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submit">submit</button>
          </div>
      </form>
      </div>
      
    </div>
  </div>
</div>

                  {{-- Category Modal --}}
<div class="modal  fade" id="categoryManageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  id ="categoryForm" method='post'>
          @csrf
          @method('PATCH')
        <div class="modal-body">
            <div class="form-group">
              <label for="categoryName">
                Category Name
              </label>
              <input type="text" name="categoryName" class="form-control" id='categoryName'> 
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">submit</button>
        </div>
        </form>
    </div>
  </div>
</div>


<div class="modal  fade" id="brandManageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Brand Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  id ="brandForm" method='post'>
          @csrf
          @method('PATCH')
        <div class="modal-body">
            <div class="form-group">
              <label for="categoryName">
                Brand Name
              </label>
              <input type="text" name="brandName" class="form-control" id='brandName'> 
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">submit</button>
        </div>
        </form>
    </div>
  </div>
</div>