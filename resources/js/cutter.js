import { createApp } from 'vue'
import Cutter from './components/shared/cutter/Cutter.vue'
const app = createApp({})

app.component('cutter', Cutter)

app.mount('#cutter')