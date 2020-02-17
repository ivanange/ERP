import Command from "./components/commands/Command";
import CreateCommand from "./components/commands/CreateCommand";
import EditCommand from "./components/commands/EditCommand";
import ShowCommand from "./components/commands/ShowCommand";
import CommandSidebar from "./components/commands/CommandSidebar";
// categories
import Category from "./components/categories/Category";
import CreateCategory from "./components/categories/CreateCategory";
import EditCategory from "./components/categories/EditCategory";
import ShowCategory from "./components/categories/ShowCategory";
import CategorySidebar from "./components/categories/CategorySidebar";
// products
import Product from "./components/products/Product";
import CreateProduct from "./components/products/CreateProduct";
import EditProduct from "./components/products/EditProduct";
import ShowProduct from "./components/products/ShowProduct";
import ProductSidebar from "./components/products/ProductSidebar";
import StockUpdate from "./components/products/StockUpdate";

import Stock from "./components/Stock";
import StockHome from "./components/StockHome";
import StockStats from "./components/StockStats";


import Home from "./components/Home";
import Login from "./components/Login";

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [{
        path: '/login',
        name: 'Login',
        components: {
            default: Login,
        },
    },
    {
        path: '/',
        name: 'Home',
        components: {
            default: Home,
        },
        alias: '/home',
    },
    {
        path: '/stock',
        name: 'Stock',
        component: Stock,
        children: [{
                path: 'stats',
                name: 'Stats',
                component: StockStats,
            },
            {
                path: 'commands',
                name: 'Command',
                components: {
                    default: Command,
                    sideBar: CommandSidebar,
                },
                children: [{
                        path: 'create',
                        component: CreateCommand,
                        name: 'CreateCommand',
                        props: true
                    },
                    {
                        path: ':id/edit',
                        name: 'EditCommand',
                        component: EditCommand,
                        props: true
                    },
                    {
                        path: ':id',
                        name: 'ShowCommand',
                        component: ShowCommand,
                        props: true
                    },
                ]
            }, {
                path: 'products',
                name: 'Product',
                components: {
                    default: Product,
                    sideBar: ProductSidebar,
                },
                children: [{
                        path: 'update',
                        name: 'StockUpdate',
                        component: StockUpdate,
                        props: true
                    },
                    {
                        path: 'create',
                        component: CreateProduct,
                        name: 'CreateProduct',
                        props: true
                    },
                    {
                        path: ':id/edit',
                        name: 'EditProduct',
                        component: EditProduct,
                        props: true
                    },
                    {
                        path: ':id',
                        name: 'ShowProduct',
                        component: ShowProduct,
                        props: true
                    },

                ]
            },
            {
                path: 'categories',
                name: 'Category',
                components: {
                    default: Category,
                    sideBar: CategorySidebar,
                },
                children: [{
                        path: 'create',
                        component: CreateCategory,
                        name: 'CreateCategory',
                        props: true
                    },
                    {
                        path: ':id/edit',
                        name: 'EditCategory',
                        component: EditCategory,
                        props: true
                    },
                    {
                        path: ':id',
                        name: 'ShowCategory',
                        component: ShowCategory,
                        props: true
                    },
                ]
            },
            {
                path: '',
                name: 'StockHome',
                component: StockHome,
                props: true
            },
        ]
    },


];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});





export default router;
