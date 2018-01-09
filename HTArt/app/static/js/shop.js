$(document).ready(function(){
    new Vue({
        el: '#vue-shop-app',
        data: {
            products: undefined,
            categories: undefined,
            got_products: false,
            got_categories: false,
            products_to_show: undefined,
            prods_in_cart: 0,
        },
        methods: {
            getProducts: function(){
                $.ajax({
                    method: "GET",
                    url: "/api/products/",
                    async: true,
                    success: function(response){
                        this.products = response;
                        this.prepare_products();
                        this.got_products = true;
                    }.bind(this)
                });
            },
            getCategories: function(){
                $.ajax({
                    method: "GET",
                    url: "/api/categories/",
                    async: true,
                    success: function(response){
                        this.categories = response;
                        this.got_categories = true;
                    }.bind(this)
                });
            },
            prepare_products: function(){
                this.products_to_show = [];
                for(var i = 0; i <= Math.ceil(this.products.length/3); i++) {
                    var line = [];
                    for(var j = 0; j < 3; j++) {
                        var index = i * 3 + j;
                        if(index < this.products.length) {
                            line.push(this.products[index]);
                        }
                    }
                    this.products_to_show.push(line);
                }
            },
            add_to_cart: function(product_name){
                this.add_product_to_cookie(product_name, 1);
                this.set_amount_of_prods_in_cart();
            },
            add_product_to_cookie(product_name, amount) {
                var cart = this.get_cart_from_cookie();
                var prod_index = cart.indexOf(product_name);
                if(cart.length < 2) {
                    cart = [product_name, amount];
                }
                else if(prod_index == -1) {
                    cart.push(product_name);
                    cart.push(amount);
                } else {
                    cart[prod_index + 1] = amount;
                }

                this.save_cart_to_cookie(cart);
            },
            get_cart_from_cookie: function() {
                var cookie = document.cookie;
                if(!cookie.includes('cart')){
                    cookie += '; cart=(); path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT';
                }
                var index_of_cart = cookie.indexOf('cart=') + 6;
                var cart = '';
                var last_index = null;
                for(var i = index_of_cart; i < cookie.length; i++){
                    if(cookie[i] === ')') {
                        last_index = i;
                        break;
                    }
                    cart += cookie[i];
                }
                cart = cart.split(',');
                return cart;
            },
            save_cart_to_cookie: function(cart) {
                cart = cart.join(',');
                var cookie = 'cart=(' + cart + '); path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT';
                document.cookie = cookie;
            },
            set_amount_of_prods_in_cart: function() {
                this.prods_in_cart = Math.floor(this.get_cart_from_cookie().length/2);
            }
        },
        computed: {
        },
        mounted: function(){
            var $that = this;
            setTimeout(function(){
                $that.getProducts();
                $that.getCategories();
                $that.set_amount_of_prods_in_cart();
            }, 2000);
        }
    });
});