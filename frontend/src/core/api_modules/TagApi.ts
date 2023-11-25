import ApiLayer from "@/core/services/ApiLayer";

class TagApi {

    /**
     * Default route for all tag apis
     */
    public static route = 'tag';

    public static index(callB) {
        return ApiLayer.post(TagApi.route, 'index', {}, callB);
    }

    public static indexing(data) {
        return ApiLayer.postApi(TagApi.route, 'indexing', data);
    }

    public static create(data) {
        return ApiLayer.postApi(TagApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(TagApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(TagApi.route, 'delete', data);
    }
}

export default TagApi;