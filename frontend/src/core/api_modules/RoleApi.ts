import ApiLayer from "@/core/services/ApiLayer";

class RoleApi {

    public static route = 'role';

    public static index(data) {
        return ApiLayer.postApi(RoleApi.route, 'index', data);
    }

    public static roleUsers(data) {
        return ApiLayer.postApi(RoleApi.route, 'roleUsers', data);
    }

    public static rolePermissions(data) {
        return ApiLayer.postApi(RoleApi.route, 'rolePermissions', data);
    }

    public static show(data) {
        return ApiLayer.postApi(RoleApi.route, 'show', data);
    }

    public static update(data, is) {
        is.value.updating = true;
        return ApiLayer.postApi(RoleApi.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(RoleApi.route, 'delete', data);
    }

    public static create(data, is) {
        is.value.creating = true;
        return ApiLayer.postApi(RoleApi.route, 'create', data);
    }
}

export default RoleApi;