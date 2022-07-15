@include('layouts.header')

<div id="app">
    @php $orderNumber = (int)request()->orderNumber @endphp
    <single-order-component orderNumber="{{$orderNumber}}"></single-order-component>

</div>
@include('layouts.footer')
