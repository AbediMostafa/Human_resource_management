import ApiLayer from "@/core/services/ApiLayer";

class CountryApi {

    /**
     * Default route for all country apis
     */
    public static route = 'country';

    public static index(data) {
        return ApiLayer.postApi(CountryApi.route, 'index', data);
    }

    public static simpleIndex() {
        return ApiLayer.postApi(CountryApi.route, 'simpleIndex');
    }

    public static create(data) {
        return ApiLayer.postApi(CountryApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(CountryApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(CountryApi.route, 'delete', data);
    }
}

export default CountryApi;