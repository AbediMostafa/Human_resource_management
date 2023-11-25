import ApiLayer from "@/core/services/ApiLayer";

class UserApi {

    /**
     * Default route for all user apis
     */
    public static route = 'user';

    public static index(data) {
        return ApiLayer.postApi(UserApi.route, 'index', data);
    }

    public static view(data, is) {
        is.value.loading = true;
        return ApiLayer.postApi(UserApi.route, 'view', data);
    }

    public static getApplicants(data, is) {
        is.value.loading = true;
        return ApiLayer.postApi(UserApi.route, 'getApplicants', data);
    }

    public static toggleActivation(data) {
        return ApiLayer.postApi(UserApi.route, 'toggleActivation', data);
    }

    public static update(data, is) {
        is.value.updating = true
        return ApiLayer.postApi(UserApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(UserApi.route, 'delete', data);
    }

    public static create(data) {
        return ApiLayer.postApi(UserApi.route, 'create', data);
    }

    public static createWithPhone(data) {
        return ApiLayer.postApi(UserApi.route, 'createWithPhone', data);
    }

    public static getRoles() {
        return ApiLayer.postApi(UserApi.route, 'getRoles');
    }

}

export default UserApi;