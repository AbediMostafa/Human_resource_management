import ApiLayer from "@/core/services/ApiLayer";

class UniversityApi {

    /**
     * Default route for all university apis
     */
    public static route = 'university';

    public static index(data) {
        return ApiLayer.postApi(UniversityApi.route, 'index', data);
    }

    public static create(data) {
        return ApiLayer.postApi(UniversityApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(UniversityApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(UniversityApi.route, 'delete', data);
    }
}

export default UniversityApi;