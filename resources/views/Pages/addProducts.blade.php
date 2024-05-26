@include('templates.header')
<x-dashboardNavbar />

<?php
use Illuminate\Support\Facades\Session;
?>

<section class="bar">
    <div class="bar-frame">
        <ul class="breadcrumbs">
            <li><a href="/myProducts">Back</a></li>
            <li>
                Add Products
            </li>
        </ul>
    </div>
</section>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (!$errors->isEmpty())
        <div class="alert alert-danger" style="border-radius: 0;" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <br>

    <h2 class="text-center">Add Products</h2>
    <form action="{{ route('addProducts') }}" method="post" class="form-group" style="width: 70%; margin: 0 auto;" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" class="form-control" id="productName" name="productName" value="{{ session('addProductName') }}" required>
        </div>

        <div class="form-group">
            <label for="productDescription">Product Description:</label>
            <input type="text" class="form-control" id="productDescription" name="productDescription" value="{{ session('addProductDescription') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ session('addQuantity') }}" min="1" required>
            </div>
            <div class="form-group col-md-6">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ session('addPrice') }}" step="0.01" min="0.01" required>
            </div>
        </div>

        <div class="form-group row" style="padding-top: 10px">
            <div class="col-md-3">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select a category</option>
                    <option value="1" {{ session('addCategoryId') == 1 ? 'selected' : '' }}>Coats</option>
                    <option value="2" {{ session('addCategoryId') == 2 ? 'selected' : '' }}>Suits</option>
                    <option value="3" {{ session('addCategoryId') == 3 ? 'selected' : '' }}>Jackets</option>
                    <option value="4" {{ session('addCategoryId') == 4 ? 'selected' : '' }}>Shirts</option>
                    <option value="5" {{ session('addCategoryId') == 5 ? 'selected' : '' }}>Shoes</option>
                </select>
            </div>
        </div>

        <div class="form-group row" style="padding-top: 10px">
            <div class="col-md-12">
                <label for="productImage">Upload Image:</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="productImage" name="productImage" required>
                    <label class="custom-file-label" for="productImage">{{ session('addProductImage') ?? 'Choose file' }}</label>
                </div>
            </div>
        </div><br>

    <div class="text-center d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div><br>
    </form>
<br>

</div>
</div>
<x-dashboardFooter />
