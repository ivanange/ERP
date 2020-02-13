import Command from "./components/Command";
import CreateCommand from "./components/CreateCommand";
import EditCommand from "./components/EditCommand";
import ShowCommand from "./components/ShowCommand";
import CommandSidebar from "./components/CommandSidebar";
// categories
import Category from "./components/Category";
import CreateCategory from "./components/CreateCategory";
import EditCategory from "./components/EditCategory";
import ShowCategory from "./components/ShowCategory";
import CategorySidebar from "./components/CategorySidebar";
// products
import Product from "./components/Product";
import CreateProduct from "./components/CreateProduct";
import EditProduct from "./components/EditProduct";
import ShowProduct from "./components/ShowProduct";
import ProductSidebar from "./components/ProductSidebar";

import Home from "./components/Home";
import Login from "./components/Login";

export const routes = [{
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
        path: '/commands',
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
        path: '/products',
        name: 'Product',
        components: {
            default: Product,
            sideBar: ProductSidebar,
        },
        children: [{
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
        path: '/categories',
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

];
