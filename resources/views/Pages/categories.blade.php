<x-dashboardNavbar />


    <section class="bar">
        <div class="bar-frame">
            <ul class="breadcrumbs">
                <li><a href="/dashboard">Home</a></li>
                <li>
                    {{$category->name}}
                </li>
            </ul>
        </div>
    </section>
    <section id="main">
        <div class="top-bar">
            <form class="form-sort" action="{{ route('search') }}" method="Get">
                <fieldset>
                    <div class="row" style="padding-left: 100px">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search products..." aria-label="Search">
                                <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </fieldset>
            </form>

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

            <form class="form-sort" action="" method="GET">
                <fieldset>
                    <div class="row">
                        <a class="btn btn-info" href="/myProducts">My Products</a>
                    </div>
                </fieldset>
            </form>


        </div>

        <ul class="item-list">
            <ul class="item-list">
                @if(session('success'))
            <div style="color:green" class="alert alert-success" role="alert">
                <br>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color:red" class="alert alert-danger" role="alert">
                <br>{{ session('error') }}
            </div>
        @endif

        @if (!$errors->isEmpty())
            <div style="color:red" class="alert alert-danger" style="border-radius: 0;" role="alert">
                <br>{{ $errors->first() }}
            </div>
        @endif
            @foreach ($products as $product)
            <li>
                <div class="item">
                    <div style="height:320px"class="image">
                        <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}">
                        <div class="hover">
                            <div class="item-content">
                                <a href="{{ route('cartAdd', $product->id) }}" class="btn white normal">Add to cart</a>
                                <a href="{{ route('productDetails', $product->id) }}" class="btn white normal">See details</a>
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


<x-dashboardFooter />
