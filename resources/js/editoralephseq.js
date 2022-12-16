require('./bootstrap')

import { createApp } from 'vue'
import EditorAlephseq from './components/shared/editoralephseq/EditorAlephseq'

const app = createApp({})

app.component('editoralephseq', EditorAlephseq)

app.mount('#editoralephseq')