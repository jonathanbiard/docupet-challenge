import { createApp } from 'vue'
import Home from './controllers/Home.vue'

import './styles/base.scss'
import './styles/Home.scss'

const minimumValue = 1
const maximumValue = 100

createApp(Home, {
    number: Math.floor(Math.random() * (maximumValue - minimumValue + 1) + minimumValue)
}).mount('#app')
