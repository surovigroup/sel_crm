@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="row row-sm">
                        <div class="col-md-12">
                            <div v-if="loading" style="position:absolute; width:100%; height:100%;">
                                <img style="position:fixed; left:50%; top:50%;" src="/images/spinner.gif" alt="">
                            </div>
                            <table id="brands-table" class="table">
                                <thead>
                                    <tr>
                                        <th width="200px;">Item Number</th>
                                        <th>Name</th>
                                        <th width="150px;">Regular Price</th>
                                        <th width="150px;">Sale Price</th>
                                        <th width="80px;">Stock</th>
                                        <th width="100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products">
                                        <td v-text="product.sku"></td>
                                        <td><a target="_blank" v-bind:href="product.permalink"><span v-text="product.name"></span></a></td>
                                        <td><input class="form-control" type="text" v-model="product.regular_price"></td>
                                        <td><input class="form-control" type="text" v-model="product.sale_price"></td>
                                        <td><input class="form-control" type="text" v-model="product.stock_quantity"></td>
                                        <td><button v-on:click="update(product)" class="btn btn-sm btn-oval btn-info">Update</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if($page_count>1)
                        <div class="col-md-12">
                            @for ($i = 1; $i <= $page_count; $i++)
                                <a class="btn btn-sm btn-success" href="?page={{$i}}">{{$i}}</a>
                            @endfor
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="{{mix('js/app.js')}}"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            api_token: '{{Auth::user()->api_token}}',
            loading: false,
            products: {!! json_encode($products) !!}
        },

        methods: {
            update(product){
                console.log(product.stock_quantity);
                console.log(product.regular_price);
                vm = this;
                this.loading = true,
                axios.post('/api/products', {
                    api_token: vm.api_token,
                    id: product.id,
                    regular_price: product.regular_price,
                    sale_price: product.sale_price,
                    stock_quantity: product.stock_quantity
                })
                .then(response => {
                    console.log(response);
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    })
</script>
<script>
    // $('#brands-table').DataTable();
</script>
@endsection