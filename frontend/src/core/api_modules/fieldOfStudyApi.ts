import ApiLayer from "@/core/services/ApiLayer";

class FieldOfStudy {

    /**
     * Default route for all field of study apis
     */
    public static route = 'field-of-study';

    public static index(data) {
        return ApiLayer.postApi(FieldOfStudy.route, 'index', data);
    }

    public static create(data) {
        return ApiLayer.postApi(FieldOfStudy.route, 'create', data);
    }

    public static update(data) {
        return ApiLayer.postApi(FieldOfStudy.route, 'update', data);
    }

    public static delete(data) {
        return ApiLayer.postApi(FieldOfStudy.route, 'delete', data);
    }
}

export default FieldOfStudy;