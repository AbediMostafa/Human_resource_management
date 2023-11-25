import ApiLayer from "@/core/services/ApiLayer";

class AuthApi {

    /**
     * Default route for all auth apis
     */
    public static route = 'auth';

    public static login(data) {
        return ApiLayer.postApi(AuthApi.route, 'login', data);
    }

    public static getMobileNumber(data) {
        return ApiLayer.postApi(AuthApi.route, 'getMobileNumber', data);
    }

    public static checkLogin() {
        return ApiLayer.postApi(AuthApi.route, 'checkLogin');
    }

    public static verifyOtp(data) {
        return ApiLayer.postApi(AuthApi.route, 'verifyOtp', data);
    }

    public static resendCode() {
        return ApiLayer.postApi(AuthApi.route, 'resendCode');
    }

    public static testLogin() {
        return ApiLayer.postApi(AuthApi.route, 'testLogin');
    }

    public static verifyPassword(data) {
        return ApiLayer.postApi(AuthApi.route, 'verifyPassword', data);
    }

    public static changePassword(data) {
        return ApiLayer.postApi(AuthApi.route, 'changePassword', data);
    }

    public static signup(data) {
        return ApiLayer.postApi(AuthApi.route, 'signup', data);
    }

    public static checkPassword(data) {
        return ApiLayer.postApi(AuthApi.route, 'checkPassword', data);
    }

}

export default AuthApi;