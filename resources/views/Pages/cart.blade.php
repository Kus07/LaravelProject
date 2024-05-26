<x-dashboardNavbar />


        </header>
        <section class="bar">
            <div class="bar-frame">
                <ul class="breadcrumbs">
                    <li><a href="index.html">Home</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </section>
        <section id="main">
            <ul class="list-table">
                <li>
                    <div class="rows rows-item">
                        <img src="{{ asset('storage/' . $cartItem->product->productImage) }}" height="99" width="99" alt="{{ $cartItem->product->productName }}">
                        <h3>{{ $cartItem->product->productName }}</h3>
                        <p>{{ $cartItem->product->productDescription }}</p>
                    </div>
                    <div class="rows-holder">
                        <div class="rows rows-select">
                            <div class="row">
                                <label for="quantity">Quantity:</label>
                                <select id="quantity">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                        <div class="rows rows-price">
                            <span>${{ $cartItem->product->price }}</span>
                        </div>
                        <div class="rows rows-delete">
                            <a class="btn-delete" href="#">delete</a>
                        </div>
                    </div>
                </li>
            </ul>
            <form action="#" class="form-payment">
                <fieldset>
                    <div class="column">
                        <h2>Delivery address:</h2>
                        <div class="row">
                            <label for="name">Name:</label>
                            <input type="text" id="name" placeholder="Patrick Biggins" />
                        </div>
                        <div class="row">
                            <label for="street">Street:</label>
                            <input type="text" id="street" placeholder="Winkle" />
                        </div>
                        <div class="row">
                            <label for="city">City:</label>
                            <input type="text" id="city" placeholder="Detroit" />
                        </div>
                        <div class="row">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" placeholder="(46) 527 526 763" />
                        </div>
                        <div class="row">
                            <label for="email">Email:</label>
                            <input type="text" id="email" placeholder="Patrick_biggie@hotmail.com" />
                        </div>
                    </div>
                    <div class="column column-add">
                        <h2>Payment method:</h2>
                        <ul class="pay-list">
                            <li class="paypal">
                                <div class="pay-holder">
                                    <p>Paypal</p>
                                </div>
                                 <input type="radio" name="pay" value="paypal" />
                            </li>
                            <li class="mastercard">
                                <div class="pay-holder">
                                    <p>MasterCard</p>
                                </div>
                                <input type="radio" name="pay" value="mastercard" />
                            </li>
                            <li class="visa">
                                <div class="pay-holder">
                                    <p>MasterCard</p>
                                </div>
                                <input type="radio" name="pay" value="visa" />
                            </li>
                            <li class="express">
                                <div class="pay-holder">
                                    <p>American Express</p>
                                </div>
                                <input type="radio" name="pay" value="american express" />
                            </li>
                            <li class="discover">
                                <div class="pay-holder">
                                    <p>Discover</p>
                                </div>
                                <input type="radio" name="pay" value="discover" />
                            </li>
                        </ul>
                        <div class="row row-total">
                            <h4 class="total">Total to pay: <strong>$599.00</strong></h4>
                            <input type="submit" class="btn black normal"  value="Make a payment" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>

</div>
<x-dashboardFooter />
