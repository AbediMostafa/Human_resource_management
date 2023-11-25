import ApiLayer from "@/core/services/ApiLayer";

class CityApi {

    /**
     * Default route for all city apis
     */
    public static route = 'city';

    public static index(data) {
        return ApiLayer.postApi(CityApi.route, 'index', data);
    }

    public static create(data) {
        return ApiLayer.postApi(CityApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(CityApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(CityApi.route, 'delete', data);
    }
}

export default CityApi;