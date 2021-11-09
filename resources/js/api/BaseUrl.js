import axios from 'axios'


const baseUrl = axios.create({
    baseURL: 'http://localhost/'
})

export default baseUrl
