import ApiLayer from "@/core/services/ApiLayer";

class OriginalityApi {

    /**
     * Default route for all originality apis
     */
    public static route = 'originality';

    public static index(data) {
        return ApiLayer.postApi(OriginalityApi.route, 'index', data);
    }

    public static create(data) {
        return ApiLayer.postApi(OriginalityApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(OriginalityApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(OriginalityApi.route, 'delete', data);
    }
}

export default OriginalityApi;