import { createApp } from 'vue'
import App from './controllers/App.vue'

import './styles/app.scss'

const minimumValue = 1
const maximumValue = 100

createApp(App, {
    number: Math.floor(Math.random() * (maximumValue - minimumValue + 1) + minimumValue)
}).mount('#app')
