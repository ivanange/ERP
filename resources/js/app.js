require('es7-object-polyfill');
import Vue from 'vue';
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VuexPersist from 'vuex-persist';
import BootstrapVue from 'bootstrap-vue';
import vSelect from 'vue-select';
import Datetime from 'vue-datetime';
import VuePageTitle from 'vue-page-title'
import {
    DateTime as LuxonDateTime,
    Settings
} from "luxon";
import {
    library
} from '@fortawesome/fontawesome-svg-core';
import {
    faMinusCircle,
    faPlusCircle,
    faPencilAlt,
    faChevronUp,
    faPrint
} from '@fortawesome/free-solid-svg-icons';
import {
    faTrashAlt
} from '@fortawesome/free-regular-svg-icons'
import {
    FontAwesomeIcon
} from '@fortawesome/vue-fontawesome';

import 'vue-select/dist/vue-select.css';
import 'vue-datetime/dist/vue-datetime.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import {
    routes
} from './routes';
import {
    stateMap,
    state,
    actions
} from './store';

import Navbar from "./components/Navbar";

library.add(
    faMinusCircle,
    faPrint,
    faPlusCircle,
    faTrashAlt,
    faPencilAlt,
    faChevronUp
);

// setup global config
Vue.config.productionTip = false;
Vue.http.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.http.headers.common['Accept'] = 'application/json';
Vue.http.headers.common['Content-Type'] = 'application/json';
Settings.defaultLocale = "en";

// setup vue plugins and components
Vue.use(Vuex)
Vue.use(BootstrapVue);
Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(Datetime)
Vue.use(VuePageTitle, {
    prefix: 'Pharma | ',
});
Vue.component('v-select', vSelect);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('Navbar', Navbar);

// setup global data and methods
Vue.mixin({
    computed: {
        ...stateMap,
        statuses: function () {
            return Object.keys(this.STATUS).map(el => ({
                text: (el[0] + el.substr(1).toLowerCase()).replace(/er$/, "é"),
                value: this.STATUS[el]
            }));
        }
    },

    methods: {
        ...actions,
        goback: function () {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/');
        },
        getStatusText: function (code) {
            for (let [key, value] of Object.entries(this.STATUS)) {
                if (value == code) {
                    return (key[0] + key.substr(1).toLowerCase()).replace(/er$/, "é");
                }
            }
            console.log("should not reach here");
        },
        setupDate(date) {
            return LuxonDateTime.fromFormat(
                date,
                "yyyy-MM-dd HH:mm:ss", {
                    zone: "UTC"
                }
            );
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        }
    },

});

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});


const vuexLocalStorage = new VuexPersist({
    key: 'vuex',
    storage: window.localStorage,
})

const store = new Vuex.Store({
    ...state,
    plugins: [vuexLocalStorage.plugin],
});

router.beforeEach(function (to, from, next) {
    if (to.path.indexOf("/login") == -1 && !store.state.logged) {
        next("/login");
    }
    if (to.path.indexOf("/commands") !== -1) {
        store.commit("setList", store.getters.commandList);
    } else if (to.path.indexOf("/products") !== -1) {
        store.commit("setList", store.getters.productList);
    } else if (to.path.indexOf("/categories") !== -1) {
        store.commit("setList", store.getters.categoryList);
    }
    next();

});

const vm = new Vue({
    store,
    router,
    el: '#app',
    components: {
        Navbar
    },
    data: function () {
        return {
            categoryid: null
        };
    },
    watch: {
        lang: function () {
            this.updateLocal();
        }
    },
    methods: {},
    created: function () {
        this.$store.watch(
            (state, getters) => state.logged,
            () => {
                if (this.logged) {
                    this.fetchCommands();
                    this.fetchProducts();
                    this.fetchCategories();
                }
            }, {
                immediate: true,
                deep: true
            }
        );

    }
});
