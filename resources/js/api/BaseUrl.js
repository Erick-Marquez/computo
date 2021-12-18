import axios from 'axios'


const baseUrl = axios.create({
    baseURL: 'https://pchuanuco.mdc-computo.com/'
})

export default baseUrl
