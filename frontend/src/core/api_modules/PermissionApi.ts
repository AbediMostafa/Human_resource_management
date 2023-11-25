import ApiLayer from "@/core/services/ApiLayer";

class PermissionApi {

    /**
     * Default route for all permission apis
     */
    public static route = 'permission';

    public static index(data, is) {
        is.loading = true;
        return ApiLayer.postApi(PermissionApi.route, 'index', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(PermissionApi.route, 'delete', data);
    }

    public static view(data, is) {
        is.value.loading = true;
        return ApiLayer.postApi(PermissionApi.route, 'view', data);
    }

    public static update(data, is) {
        is.value.updating = true;
        return ApiLayer.postApi(PermissionApi.route, 'update', data);
    }

    public static create(data, is) {
        is.value.creating = true;
        return ApiLayer.postApi(PermissionApi.route, 'create', data);
    }
}

export default PermissionApi;