import axios from 'axios'


const baseUrl = axios.create({
    baseURL: 'http://computo.test:82'
})

export default baseUrl
