import axios from 'axios'


const baseUrl = axios.create({
    baseURL: 'http://computo.test/'
})

export default baseUrl
