<template>

    <section class="">
        <div class="container flex items-left flex-wrap pt-4 pb-12 w-full float-left">
            <nav id="store" class=" w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                       href="#">
                        My Orders
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
        </div>

        <div class="container flex items-left flex-wrap pt-4 pb-12 w-full float-left" v-if="order">

            <nav class="w-full z-30 top-0 px-6 py-1">

                <div class="w-full container mx-auto  items-center justify-between mt-0 px-2 py-3">

                    <a class=" d-block uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl"
                       href="#">
                        Hello <b>{{ customer.full_name }}</b>
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
                                        <div class="font-semibold text-left">Order No</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Piece</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Price</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Adres</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full"
                                                                                                   :src="order.product.image"
                                                                                                   width="40"
                                                                                                   height="40"
                                                                                                   alt="Alex Shatov">
                                            </div>
                                            <div class="font-medium text-gray-800">{{ order.product.name }}</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ order.no }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ order.piece }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">
                                            {{ formatPrice(order.product.price) }}
                                            €
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-red-500">
                                            {{ order.address ? order.address.address : '-' }}
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-primary border-bottom-2">
                                    <td colspan="4" class="text-left ">Delivery Fee : {{ row.delivery_fee }}</td>
                                </tr>
                                <tr class="text-primary border-bottom-2">
                                    <td colspan="4" class="text-left ">Total : {{ row.total }}</td>
                                </tr>
                                </tbody>
                            </table>
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
    props: ['orderNumber'],
    data() {
        return {
            products: null,
            order: {},
            customer: {},
            total: 0,
            deliveryPrice: 15,
            deliveryFree: false,
        }
    },

    mounted() {
        this.getOrder();
        this.me()
    },

    methods: {
        getOrder() {
            axios.get('/api/orders/' + this.orderNumber).then(response => {
                this.orders = response.data.data;
                console.log(this.orders);
            }).catch(error => {
                alert(error.response.data.message);
            });
        },

        me() {
            axios.get('/api/me').then(response => {
                this.customer = response.data.data;
            }).catch(error => {
                alert(error.data.data.message);
            });
        },
    }
}
</script>

<style scoped>

</style>
