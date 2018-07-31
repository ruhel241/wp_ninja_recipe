import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './router.js'

import locale from 'element-ui/lib/locale';
import lang from 'element-ui/lib/locale/lang/en';
locale.use(lang);

import {
    Row,
    Col,
    Table, 
    Button,
    Dialog,
    Input,
    Select,
    Option,
    Notification,
    Message,
    Loading
} from 'element-ui'

Vue.use(VueRouter)
Vue.use(Row)
Vue.use(Col)
Vue.use(Button)
Vue.use(Table)
Vue.use(Dialog)
Vue.use(Input)
Vue.use(Select)
Vue.use(Option)

Vue.use(Loading.directive);
Vue.prototype.$loading = Loading.service;
Vue.prototype.$notify = Notification;
Vue.prototype.$message = Message;

import 'element-ui/lib/theme-chalk/button.css';
import 'element-ui/lib/theme-chalk/col.css';
import 'element-ui/lib/theme-chalk/row.css';
import 'element-ui/lib/theme-chalk/table.css';
import 'element-ui/lib/theme-chalk/dialog.css';
import 'element-ui/lib/theme-chalk/input.css';
import 'element-ui/lib/theme-chalk/select.css';
import 'element-ui/lib/theme-chalk/option.css';
import 'element-ui/lib/theme-chalk/notification.css';
import 'element-ui/lib/theme-chalk/loading.css';

import App from './AdminApp';

const router = new VueRouter({
    routes
})
new Vue({
    el: "#wp_ninja_recipe",
    router,
	render: h => h(App)
})