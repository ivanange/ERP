//require('es7-object-polyfill');
import {
    mapState,
    mapGetters,
    mapActions
} from 'vuex';
import Vue from 'vue';
import VueResource from 'vue-resource';
import Vuex from 'vuex';
import VuexPersist from 'vuex-persist';
import {
    DateTime,
    Duration,
    Settings
} from 'luxon';

// change date to use local with method .setLocale('en-GB') remove update locale and luxonSettings

Vue.use(VueResource);
Vue.use(Vuex);

// setup global config
Vue.config.productionTip = false;
Vue.http.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.http.headers.common['Accept'] = 'application/json';
Vue.http.headers.common['Content-Type'] = 'application/json';
Settings.defaultLocale = "en";


const expired = (state, product) => {
    if (product.expireDate) {
        let now = DateTime.utc();
        let expireDate = DateTime.fromFormat(
            product.expireDate,
            "yyyy-MM-dd HH:mm:ss", {
                zone: "UTC"
            }
        );
        return expireDate <= now
    }
    return false;
}

const nearlyExpired = (state, product) => {
    if (product.expireDate) {
        let now = DateTime.utc();
        let interval = Duration.fromObject(state.expiryInterval);
        let expireDate = DateTime.fromFormat(
            product.expireDate,
            "yyyy-MM-dd HH:mm:ss", {
                zone: "UTC"
            }
        );
        now.plus(interval);
        return expireDate <= now;
    }
    return false;
}

const state = {
    state: {
        lang: "en",
        currency: "XAF",
        searchResult: [],
        names: [],
        loaded: false,
        logged: false,
        loadCounter: 0,
        dues: [],
        expiryInterval: {
            days: 30
        },
        FRSTATUS: {
            ENCOURS: 1,
            LIVRER: 2,
            ANNULER: 3
        },
        ENSTATUS: {
            ONGOING: 1,
            DELIVERED: 2,
            ABORTED: 3
        },
        commands: {},
        categories: {},
        products: {},
        flows: {},
        flowcategories: {},

    },
    getters: {
        STATUS: state => state[state.lang.toUpperCase() + "STATUS"],
        manufacturers: (state, getters) => [...(new Set(getters.productList.map(el => el.manufacturer)))],
        //stock/commands
        commandList: state => Object.values(state.commands),
        getCommand: state => (id) => state.commands[id],
        getCommandByStatus: (state, getters) => (status) => getters.commandList.filter(el => el.status == status),
        deliveredCommands: (state, getters) => getters.getCommandByStatus(state.ENSTATUS.DELIVERED),
        ongoingCommands: (state, getters) => getters.getCommandByStatus(state.ENSTATUS.ONGOING),
        abortedCommands: (state, getters) => getters.getCommandByStatus(state.ENSTATUS.ABORTED),
        //stock/products
        productList: state => Object.values(state.products),
        availableProductsList: (state, getters) => getters.productList.filter(product => product.qte > 0),
        getProduct: state => (id) => state.products[id],
        expiredProducts: (state, getters) => getters.productList.filter(product => expired(state, product)),
        nearlyExpiredProducts: (state, getters) => getters.productList.filter(product => nearlyExpired(state, product) && !expired(state, product)),
        finishedProducts: (state, getters) => getters.productList.filter(product => product.qte == 0),
        goodProducts: (state, getters) => getters.productList.filter(product => !(nearlyExpired(state, product) || expired(state, product))),
        //stock/categories
        categoryList: state => Object.values(state.categories),
        getCategory: state => (id) => state.categories[id],
        // flowcategories
        flowcategoryList: state => Object.values(state.flowcategories),
        getFlowCategory: state => (id) => state.flowcategories[id],
        //flows
        getFlow: state => (id) => state.flows[id],
        flowList: state => Object.values(state.flows),
        inFlowsList: (state, getters) => getters.flowList.filter(flow => flow.type == 1),
        outFlowsList: (state, getters) => getters.flowList.filter(flow => flow.type == 2),
    },
    mutations: {
        setLogged(state, logged) {
            state.logged = logged;
        },
        setDues(state, dues) {
            state.dues = dues;
        },
        setNames(state, names) {
            state.names = names;
        },
        changeLang(state, lang) {
            state.lang = lang;
        },
        changeCurrency(state, curr) {
            state.currency = curr;
        },
        loadCheck(state) {
            state.loadCounter++
            if (state.loadCounter == 5) {
                state.loaded = true;
                state.loadCounter = 0;
            }
        },
        setList(state, searchResult) {
            state.searchResult = searchResult;
        },
        // Commands

        addCommands(state, commands) {
            state.commands = commands;
        },
        changeCommand(state, command) {
            Vue.set(state.commands, command.id, command);
        },
        addCommand(state, command) {
            state.commit('changeCommand', command);
        },
        editCommand(state, command) {
            state.commit('changeCommand', command);
        },
        deleteCommand(state, id) {
            Vue.delete(state.commands, id);
        },

        // Products

        addProducts(state, products) {
            state.products = products;
        },
        changeProduct(state, product) {
            Vue.set(state.products, product.id, product);
        },
        addProduct(state, product) {
            state.commit('changeProduct', product);
        },
        editProduct(state, product) {
            state.commit('changeProduct', product);
        },
        deleteProduct(state, id) {
            Vue.delete(state.products, id);
        },

        updateProductsQuantity(state, products) {
            Object.keys(products).forEach((id) => {
                Vue.set(state.products[id], 'qte', products[id]);
            });
        },

        //Category

        addCategories(state, categories) {
            state.categories = categories;
        },
        changeCategory(state, category) {
            Vue.set(state.categories, category.id, category);
        },
        addCategory(state, category) {
            state.commit('changeCategory', category);
        },
        editCategory(state, category) {
            state.commit('changeCategory', category);
        },
        deleteCategory(state, id) {
            Vue.delete(state.categories, id);
        },

        // Flow Category

        addFlowCategories(state, categories) {
            state.flowcategories = categories;
        },
        changeFlowCategory(state, category) {
            Vue.set(state.flowcategories, category.id, category);
        },
        addFlowCategory(state, category) {
            state.commit('changeFlowCategory', category);
        },
        editFlowCategory(state, category) {
            state.commit('changeFlowCategory', category);
        },
        deleteFlowCategory(state, id) {
            Vue.delete(state.flowcategories, id);
        },

        // Flow

        addFlows(state, flows) {
            state.flows = flows;
        },
        changeFlow(state, flow) {
            Vue.set(state.flows, flow.id, flow);
        },
        addFlow(state, flow) {
            state.commit('changeFlow', flow);
        },
        editFlow(state, flow) {
            state.commit('changeFlow', flow);
        },
        deleteFlow(state, id) {
            Vue.delete(state.flows, id);
        },

    },

    actions: {

        fetchNames(context) {
            Vue.http.get('/api/names').then(res => {
                if (res.ok) {
                    context.commit("setNames", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        // Commands

        fetchCommands(context) {
            Vue.http.get('/api/stock/commands').then(res => {
                if (res.ok) {
                    context.commit("addCommands", res.body.reduce((acc, val) => {
                        acc[val.id] = val;
                        return acc;
                    }, {}));
                    context.commit("loadCheck");
                } else {
                    // manage small quirks uath, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        createCommand(context, command) {
            Vue.http.post('/api/stock/commands', command).then(res => {
                if (res.ok) {
                    context.commit("changeCommand", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        updateCommand(context, command) {
            Vue.http.put(`/api/stock/commands/${command.id}`, command).then(res => {
                if (res.ok) {
                    context.commit("changeCommand", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        destroyCommand(context, id) {
            Vue.http.delete(`/api/stock/commands/${id}`).then(res => {
                if (res.ok) {
                    context.commit("deleteCommand", id);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        // Products

        fetchProducts(context) {
            Vue.http.get('/api/stock/products').then(res => {
                if (res.ok) {
                    context.commit("addProducts", res.body.reduce((acc, val) => {
                        acc[val.id] = val;
                        return acc;
                    }, {}));
                    context.commit("loadCheck");
                } else {
                    // manage small quirks uath, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        createProduct(context, product) {
            Vue.http.post('/api/stock/products', {
                ...product,
                image: product.image ? product.image.replace(
                    /data:.*?base64,/,
                    ""
                ) : null
            }).then(res => {
                if (res.ok) {
                    context.commit("changeProduct", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        updateProduct(context, product) {
            Vue.http.put(`/api/stock/products/${product.id}`, {
                ...product,
                image: product.image ? product.image.replace(
                    /data:.*?\/.*?;base64,/,
                    ""
                ) : null
            }).then(res => {
                if (res.ok) {
                    context.commit("changeProduct", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        destroyProduct(context, id) {
            Vue.http.delete(`/api/stock/products/${id}`).then(res => {
                if (res.ok) {
                    context.commit("deleteProduct", id);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        massUpdate(context, products) {
            Vue.http.post(`/api/stock/products/update`, products).then(res => {
                if (res.ok) {
                    context.commit("updateProductsQuantity", products);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        //Category

        fetchCategories(context) {
            Vue.http.get('/api/stock/categories').then(res => {
                if (res.ok) {
                    context.commit("addCategories", res.body.reduce((acc, val) => {
                        acc[val.id] = val;
                        return acc;
                    }, {}));
                    context.commit("loadCheck");
                } else {
                    // manage small quirks uath, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        createCategory(context, category) {
            Vue.http.post('/api/stock/categories', category).then(res => {
                if (res.ok) {
                    context.commit("changeCategory", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        updateCategory(context, category) {
            Vue.http.put(`/api/stock/categories/${category.id}`, category).then(res => {
                if (res.ok) {
                    context.commit("changeCategory", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        destroyCategory(context, id) {
            Vue.http.delete(`/api/stock/categories/${id}`).then(res => {
                if (res.ok) {
                    context.commit("deleteCategory", id);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        // Flow Category

        fetchFlowCategories(context) {
            Vue.http.get('/api/accounting/flowcategories').then(res => {
                if (res.ok) {
                    context.commit("addFlowCategories", res.body.reduce((acc, val) => {
                        acc[val.id] = val;
                        return acc;
                    }, {}));
                    context.commit("loadCheck");
                } else {
                    // manage small quirks uath, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        createFlowCategory(context, category) {
            Vue.http.post('/api/accounting/flowcategories', category).then(res => {
                if (res.ok) {
                    context.commit("changeFlowCategory", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        updateFlowCategory(context, category) {
            Vue.http.put(`/api/accounting/flowcategories/${category.id}`, category).then(res => {
                if (res.ok) {
                    context.commit("changeFlowCategory", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        destroyFlowCategory(context, id) {
            Vue.http.delete(`/api/accounting/flowcategories/${id}`).then(res => {
                if (res.ok) {
                    context.commit("deleteFlowCategory", id);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        // Flow

        fetchFlows(context) {
            Vue.http.get('/api/accounting/flows').then(res => {
                if (res.ok) {
                    context.commit("addFlows", res.body.reduce((acc, val) => {
                        acc[val.id] = val;
                        return acc;
                    }, {}));
                    context.commit("loadCheck");
                } else {
                    // manage small quirks uath, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        createFlow(context, flow) {
            Vue.http.post('/api/accounting/flows', flow).then(res => {
                if (res.ok) {
                    context.commit("changeFlow", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        updateFlow(context, flow) {
            Vue.http.put(`/api/accounting/flows/${flow.id}`, flow).then(res => {
                if (res.ok) {
                    context.commit("changeFlow", res.body);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },
        destroyFlow(context, id) {
            Vue.http.delete(`/api/accounting/flows/${id}`).then(res => {
                if (res.ok) {
                    context.commit("deleteFlow", id);
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },

        getDues(context) {
            Vue.http.get('/api/accounting/dues').then(res => {
                if (res.ok) {
                    context.commit("setDues", res.body);
                } else {
                    // manage small quirks uath, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        },


        logout(context) {
            Vue.http.post('/api/logout').then(res => {
                if (res.ok) {
                    context.commit("setLogged", false);
                    window.location = "/";
                } else {
                    // manage small quirks auth, validation, etc
                }
            }).catch(error => {
                // catch fatal errors
            });
        }
    }
};

const stateMap = {
    ...mapState([
        "lang",
        "dues",
        "loaded",
        "logged",
        "currency",
        "names",
        "searchResult",
        "expiryInterval",
        "FRSTATUS",
        "ENSTATUS",
        /**
                "commands",
                "categories",
                "products",
         */
    ]),

    ...mapGetters([

        "STATUS",
        "manufacturers",

        // Commands

        "commandList",
        "getCommand",
        "getCommandByStatus",
        "deliveredCommands",
        "ongoingCommands",
        "abortedCommands",

        // Products

        "productList",
        "availableProductsList",
        "getProduct",
        "expiredProducts",
        "nearlyExpiredProducts",
        "finishedProducts",
        "goodProducts",

        // Categories

        "categoryList",
        "getCategory",

        // Flow Categories

        "flowcategoryList",
        "getFlowCategory",

        // Flows

        "getFlow",
        "flowList",
        "inFlowsList",
        "outFlowsList"
    ]),

}

const actions = mapActions([
    "fetchNames",
    "logout",
    "getDues",

    // Commands

    "fetchCommands",
    "createCommand",
    "updateCommand",
    "destroyCommand",

    // Products

    "fetchProducts",
    "createProduct",
    "updateProduct",
    "destroyProduct",
    "massUpdate",

    // Categories

    "fetchCategories",
    "createCategory",
    "updateCategory",
    "destroyCategory",

    // Flow Categories

    "fetchFlowCategories",
    "createFlowCategory",
    "updateFlowCategory",
    "destroyFlowCategory",

    // Flow Categories

    "fetchFlows",
    "createFlow",
    "updateFlow",
    "destroyFlow"
]);



// setup global data and methods
Vue.mixin({
    computed: {
        ...stateMap,
    },

    methods: {
        ...actions,
    },
});


const vuexLocalStorage = new VuexPersist({
    key: 'vuex',
    storage: window.localStorage,
})
const store = new Vuex.Store({
    ...state,
    plugins: [vuexLocalStorage.plugin],
});



export default store;
