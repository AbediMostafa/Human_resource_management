import ApiLayer from "@/core/services/ApiLayer";

class StateApi {

    /**
     * Default route for all state apis
     */
    public static route = 'state';

    public static index(data) {
        return ApiLayer.postApi(StateApi.route, 'index', data);
    }

    public static simpleIndex() {
        return ApiLayer.postApi(StateApi.route, 'simpleIndex');
    }

    public static create(data) {
        return ApiLayer.postApi(StateApi.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(StateApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(StateApi.route, 'delete', data);
    }
}

export default StateApi;