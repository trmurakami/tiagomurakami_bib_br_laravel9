require('./bootstrap')

import { createApp } from 'vue'
import Ficha from './components/shared/ficha/Ficha'

const app = createApp({})

app.component('ficha', Ficha)

app.mount('#ficha')