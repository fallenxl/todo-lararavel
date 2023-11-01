import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './vue/App.vue';

const app = createApp({
    components: {
        App
    }
});


app.mount('#app');
