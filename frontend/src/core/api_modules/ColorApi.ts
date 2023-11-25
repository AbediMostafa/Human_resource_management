import ApiLayer from "@/core/services/ApiLayer";

class ColorApi {

    /**
     * Default route for all color apis
     */
    public static route = 'color';

    public static index(data) {
        return ApiLayer.postApi(ColorApi.route, 'index', data);
    }

    public static create(data) {
        return ApiLayer.postApi(ColorApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(ColorApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(ColorApi.route, 'delete', data);
    }
}

export default ColorApi;