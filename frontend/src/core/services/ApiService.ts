import {App} from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import {AxiosResponse, AxiosRequestConfig} from "axios";
import {ElMessage, ElMessageBox} from "element-plus";

/**
 * @description service to call HTTP request via Axios
 */
class ApiService {
    /**
     * @description property to share vue instance
     */
    public static vueInstance: App;
    public static baseUrl = location.protocol + '//' + location.hostname + ':85'

    public static check422Status(error) {

        //status code
        const status = error.response?.status;

        const msg = error.response.data.errors ?
            //Laravel validation
            Object.values(error.response.data.errors).flat().join('<br>') :
            //Custom error sent with `abort` method
            error.response.data.message

        if (status === 422) {

            ElMessageBox.confirm(
                msg,
                'error',
                {
                    confirmButtonText: 'confirm',
                    dangerouslyUseHTMLString: true,
                    type: 'error',
                    showCancelButton: false,
                    center: true,
                }
            )
        }
    }

    /**
     * @description initialize vue axios
     */
    public static init(app: App<Element>) {
        ApiService.vueInstance = app;
        ApiService.vueInstance.use(VueAxios, axios);
        ApiService.vueInstance.axios.defaults.baseURL = ApiService.baseUrl;
        ApiService.vueInstance.axios.defaults.withCredentials = true;
        ApiService.vueInstance.axios.defaults.headers.common["Accept"] = "application/json";
        ApiService.vueInstance.axios.interceptors.response.use(response => {

                // if we want to send a notification to front, we send withResponse key
                // to identify this type of responses
                if (response.data.hasOwnProperty('withResponse')) {
                    response.data.status ?
                        ElMessage.success(response.data.msg) :
                        ElMessage.error(response.data.msg)
                }

                return response;

            }, error =>
                //laravel validation status code
                ApiService.check422Status(error)
        );
    }

    /**
     * @description set the default HTTP request headers
     */
    public static setHeader(): void {
        ApiService.vueInstance.axios.defaults.headers.common["Accept"] = "application/json";
    }

    /**
     * @description send the GET HTTP request
     * @param resource: string
     * @param params: AxiosRequestConfig
     * @returns Promise<AxiosResponse>
     */
    public static query(
        resource: string,
        params: AxiosRequestConfig
    ): Promise<AxiosResponse> {
        return ApiService.vueInstance.axios.get(resource, params);
    }

    /**
     * @description send the GET HTTP request
     * @param resource: string
     * @param slug: string
     * @returns Promise<AxiosResponse>
     */
    public static get(
        resource: string,
        slug = "" as string
    ): Promise<AxiosResponse> {
        return ApiService.vueInstance.axios.get(`${resource}/${slug}`);
    }

    /**
     * @description set the POST HTTP request
     * @param resource: string
     * @param params: AxiosRequestConfig
     * @returns Promise<AxiosResponse>
     */
    public static post(
        resource: string,
        params: AxiosRequestConfig
    ): Promise<AxiosResponse> {
        return ApiService.vueInstance.axios.post(`${resource}`, params);
    }

    /**
     * @description send the UPDATE HTTP request
     * @param resource: string
     * @param slug: string
     * @param params: AxiosRequestConfig
     * @returns Promise<AxiosResponse>
     */
    public static update(
        resource: string,
        slug: string,
        params: AxiosRequestConfig
    ): Promise<AxiosResponse> {
        return ApiService.vueInstance.axios.put(`${resource}/${slug}`, params);
    }

    /**
     * @description Send the PUT HTTP request
     * @param resource: string
     * @param params: AxiosRequestConfig
     * @returns Promise<AxiosResponse>
     */
    public static put(
        resource: string,
        params: AxiosRequestConfig
    ): Promise<AxiosResponse> {
        return ApiService.vueInstance.axios.put(`${resource}`, params);
    }

    /**
     * @description Send the DELETE HTTP request
     * @param resource: string
     * @returns Promise<AxiosResponse>
     */
    public static delete(resource: string): Promise<AxiosResponse> {
        return ApiService.vueInstance.axios.delete(resource);
    }
}

export default ApiService;
