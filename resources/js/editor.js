import { createApp } from 'vue'
import Editor from './components/shared/editor/Editor.vue'
const app = createApp({})

app.component('editor', Editor)

app.mount('#editor')