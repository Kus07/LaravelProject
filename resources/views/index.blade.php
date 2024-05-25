    @include('templates.header')

    <x-navbar />
    
    <x-products :products="$products"/>
                 <!-- no space in = -->

    @include('templates.footer')
