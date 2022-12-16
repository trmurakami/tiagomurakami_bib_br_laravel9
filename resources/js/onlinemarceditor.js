require('./bootstrap')

import { createApp } from 'vue'
import OnlineMARCEditor from './components/shared/onlinemarceditor/OnlineMARCEditor'

const app = createApp({})

app.component('onlinemarceditor', OnlineMARCEditor)

app.mount('#onlinemarceditor')