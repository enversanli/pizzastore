<template>

    <section class="">
        <div class="container flex items-left flex-wrap pt-4 pb-12 w-1/2 float-left">

            <nav id="store" class=" w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                       href="#">
                        Products
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z"/>
                            </svg>
                        </a>

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </nav>

            <div class="w-full md:w-1/2 xl:w-1/2 p-6 flex flex-col" v-for="product in products">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg w-full h-75" style="height: 250px !important;"
                         :src="product.image">
                    <div class="pt-3 flex items-center justify-between">
                        <p class="">{{ product.name }}</p>
                        <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"/>
                        </svg>
                    </div>
                    <p class="pt-1 text-gray-900">{{ product.price }} €</p>
                </a>
                <button
                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                    @click="addToOrder(product)">Add
                </button>
            </div>
        </div>

        <div class="container flex items-left flex-wrap pt-4 pb-12 w-1/2 float-left" v-if="orders.length">

            <nav class="w-full z-30 top-0 px-6 py-1">

                <div class="w-full container mx-auto  items-center justify-between mt-0 px-2 py-3">

                    <a class=" d-block uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl"
                       href="#">
                        Orders
                    </a>
                    <div class="p-3 d-block w-full">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Name</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Piece</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Price</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Pr</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">
                                <tr v-for="(order, index) in orders">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full"
                                                                                                   :src="order.image"
                                                                                                   width="40"
                                                                                                   height="40"
                                                                                                   alt="Alex Shatov">
                                            </div>
                                            <div class="font-medium text-gray-800">{{ order.name }}</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ order.count }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">{{ formatPrice(order.price) }}
                                            €
                                        </div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500" @click="removeOrder(index)">
                                            Remove
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="mt-5">
                                <p class="w-full"><b>TOTAL :</b> {{ formatPrice(total) }} €</p> <br>
                                <p class="w-full">Delivery Cost : {{ deliveryPrice }}</p>
                                <p class="w-full" v-if="deliveryFree">Free Delivery</p>
                                <div class="w-full md:w-1/2 xl:w-1/2 p-6 flex flex-col mx-auto">
                                    <button
                                        class="w-full inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out w-full"
                                        @click="addToOrder">Complete Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </nav>

        </div>
    </section>
</template>

<script>
export default {
    name: "ProductComponent",
    data() {
        return {
            products: null,
            orders: [],
            total: 0,
            deliveryPrice: 15,
            deliveryFree: false,
        }
    },

    mounted() {
        this.getProducts()
    },

    methods: {
        addToOrder(product) {
            var exist = false;
            this.orders.forEach(data => {

                if (data.id === product.id) {
                    data.count = data.count + 1;
                    data.price = data.count * product.price;
                    exist = true;
                    this.calculateTotal(product);
                    return true;
                }
            });

            if (exist) {
                return true;
            }

            const newOrderProduct = this.getOrderData(product);
            this.orders.push(newOrderProduct);
            this.calculateTotal(product);

        },

        removeOrder(key) {
            Vue.delete(this.orders, key);
        },

        getProducts() {
            axios.get('/api/products').then(response => {
                this.products = response.data.data;
            }).catch(error => {
                alert("Something went wrong!");
            })
        },


        getOrderData(product) {
            return {
                'id': product.id,
                'name': product.name,
                'image': product.image,
                'count': 1,
                'price': product.price,
            }

        },

        calculateTotal(product) {

            var currentTotal = product.price + this.total;

            if (currentTotal > 15) {
                this.deliveryPrice = 0;
                this.deliveryFree = true;
            } else {
                this.deliveryPrice = 15;
                this.deliveryFree = false;
            }


            this.total += product.price;
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>

<style scoped>

</style>
