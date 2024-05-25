<x-dashboardNavbar />

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


    <section class="bar">
        <div class="bar-frame">
            <ul class="breadcrumbs">
                <li><a href="/dashboard">Home</a></li>
                <li>
                    My Products
                </li>
            </ul>
        </div>
    </section>
    <section id="main">
        <div class="top-bar">
            <ul class="paging">
                @if ($products->currentPage() > 1)
                <li class="prev"><a href="{{ $products->previousPageUrl() }}">prev</a></li>
                @endif

                @if ($products->currentPage() > 1)
                <li><a href="{{ $products->url($products->currentPage() - 1) }}">{{ $products->currentPage() - 1 }}</a></li>
                @endif

                <li class="active"><a href="{{ $products->url($products->currentPage()) }}">{{ $products->currentPage() }}</a></li>

                @if ($products->currentPage() < $products->lastPage())
                <li><a href="{{ $products->url($products->currentPage() + 1) }}">{{ $products->currentPage() + 1 }}</a></li>
                @endif

                @if ($products->currentPage() < $products->lastPage())
                <li class="next"><a href="{{ $products->nextPageUrl() }}">next</a></li>
                @endif
            </ul>

            <form class="form-sort" action="#">
                <fieldset>
                    <div class="row">
                        <a class = 'btn btn-info' href="/myProducts">Add Products</a>
                    </div>

                    <div class="row">
                        <label for="sort">Sort by:</label>
                        <select id="sort">
                            <option>price</option>
                            <option>price</option>
                        </select>
                    </div>
                    <div class="row">
                        <label for="page">Products per page:</label>
                        <select id="page">
                            <option>8</option>
                            <option>8</option>
                        </select>
                    </div>

                </fieldset>
            </form>
        </div>

        <ul class="item-list">
            @foreach ($products as $product)
            <li>
                <div class="item">
                    <div style="height:320px"class="image">
                        <img src="{{ $product->productImage }}" alt="{{ $product->productName }}" />
                        <div class="hover">
                            <div class="item-content">
                                <a href="{{ route('cart.add', $product->id) }}" class="btn white normal">Add to cart</a>
                                <a href="{{ route('product.show', $product->id) }}" class="btn white normal">See details</a>
                            </div>
                            <span class="bg"></span>
                        </div>
                    </div>
                    <span class="name">{{ $product->productName }}</span>
                    <span>${{ $product->price }}</span>
                </div>
            </li>
            @endforeach
        </ul>
        <br>
    </section>
</div>
</div>

<x-dashboardFooter />
