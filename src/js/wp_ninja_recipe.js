import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './router.js'

import locale from 'element-ui/lib/locale';
import lang from 'element-ui/lib/locale/lang/en';
locale.use(lang);

// importing the required components
import {
    Row,
    Col,
    Icon,
    Table,
    Input, 
    Button,
    Dialog,
    Select,
    Option,
    Message,
    Loading,
    Popover,
    TableColumn,
    Notification
} from 'element-ui'

// making the required components global
Vue.use(Row)
Vue.use(Col)
Vue.use(Icon)
Vue.use(Table)
Vue.use(Input)
Vue.use(Button)
Vue.use(Dialog)
Vue.use(Select)
Vue.use(Option)
Vue.use(Popover)
Vue.use(VueRouter)
Vue.use(TableColumn)

Vue.use(Loading.directive);
Vue.prototype.$loading = Loading.service;
Vue.prototype.$notify = Notification;
Vue.prototype.$message = Message;

// importing css of required components
import 'element-ui/lib/theme-chalk/index.css';
import 'element-ui/lib/theme-chalk/col.css';
import 'element-ui/lib/theme-chalk/row.css';
import 'element-ui/lib/theme-chalk/input.css';
import 'element-ui/lib/theme-chalk/table.css';
import 'element-ui/lib/theme-chalk/option.css';
import 'element-ui/lib/theme-chalk/button.css';
import 'element-ui/lib/theme-chalk/dialog.css';
import 'element-ui/lib/theme-chalk/select.css';
import 'element-ui/lib/theme-chalk/loading.css';
import 'element-ui/lib/theme-chalk/popover.css';
import 'element-ui/lib/theme-chalk/notification.css';
import 'element-ui/lib/theme-chalk/table-column.css';


// importing the root component
import App from './AdminApp';

const router = new VueRouter({
    routes
})

new Vue({
    el: "#wp_ninja_recipe",
    router,
	render: h => h(App)
})