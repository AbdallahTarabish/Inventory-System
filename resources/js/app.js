/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));
// import Swal from "sweetalert2";
//
// window.Swal = Swal

import CategoryComponent from "./components/Categories/CategoryComponent";
import MainCategoryComponent from "./components/Categories/MainCategoryComponent";
import CreateCategoryComponent from "./components/Categories/CreateCategoryComponent";
import EditCategoryComponent from "./components/Categories/EditCategoryComponent";
import MainStore from "./components/Stores/MainStore";
import SubStore from "./components/Stores/SubStore";
import Supplier from "./components/Supplier/Supplier";
import Sector from "./components/SortStore/Sector";
import SubSector from "./components/SortStore/SubSector";
import Shelf from "./components/SortStore/Shelf";


const app = new Vue({
    el: '#app',
    components: {
        MainCategoryComponent,
        CategoryComponent,
        CreateCategoryComponent,
        EditCategoryComponent,
        MainStore,
        SubStore,
        Supplier,
        Sector,
        SubSector,Shelf
    }
});
