import {defineStore} from "pinia";
import * as Yup from "yup";
import AuthApi from "@/core/api_modules/AuthApi";
import router from "@/router";
import {useDebounceFn} from "@vueuse/core";
import {ref} from "vue";

export const useAuthStore = defineStore('AuthStore', {

    state() {
        return {
            user: null,
            user_id: 2,
            submitButton: '',

            otp: {
                code: '',
                state: ref(''),
            },
            is: {
                loading: false,
                inOptPage: false,
                optLoading: false,
                codeResended: false,
            },
            authMessage: {
                hasError: false,
                errorMsg: '',
            },
        }
    },

    actions: {

        /**
         * Handle after login process
         */
        handleSuccessLogin(data) {
            this.user = data.user;
            localStorage.setItem('user', JSON.stringify(data.user));
            localStorage.setItem('token', data.user.token);
            router.push({name: 'dashboard'})
            this.otp.state = 'phone-page'
        },

        getMobileNumber: useDebounceFn((data, that) => {
                that.is.loading = true;
                AuthApi.getMobileNumber(data)
                    .then(response =>
                        that.otp.state = !!response?.data?.status ? 'otp-page' : 'phone-page'
                    )
                    .finally(() => that.is.loading = false)
            }
            , 500),

        verifyOtp: useDebounceFn(that => {
            that.is.optLoading = true;

            AuthApi.verifyOtp({code: that.otp.code})
                .then(response => {

                    if (response.data.status) {
                        that.otp.state = response.data.new_user ? 'signup' : 'get-password'
                        return that.user_id = response.data.user_id
                    }

                    if (response.data.change_state) {
                        that.otp.state = response.data.state
                        that.resetData()
                    }

                    that.authMessage = {
                        hasError: true,
                        errorMsg: response.data.msg
                    }
                })
                .finally(() => that.is.optLoading = false)

        }, 300),

        verifyPassword: useDebounceFn((password, that) => {
            that.is.loading = true;

            AuthApi.verifyPassword({...password, userId: that.user_id})
                .then(response =>
                    response.data.status ?
                        that.handleSuccessLogin(response.data) :
                        that.authMessage = {
                            hasError: true,
                            errorMsg: response.data.msg
                        }
                )
                .finally(() => that.is.loading = false)

        }, 300),

        changePassword: useDebounceFn((that) => {
            that.is.loading = true;
            AuthApi.changePassword({userId: that.user_id})
                .then(() => that.stop.status = '')
                .finally(() => that.is.loading = false)

        }, 300),

        signup: useDebounceFn((data, that) => {
            that.is.loading = true;
            AuthApi.signup({...data, userId: that.user_id})
                .then(response => {
                        response.data.status ?
                            that.handleSuccessLogin(response.data) :
                            that.authMessage = {
                                hasError: true,
                                errorMsg: response.data.msg
                            }
                    }
                )
                .finally(() => that.is.loading = false)

        }, 300),

        forgotPassword: useDebounceFn(that => {
            that.otp.state = 'change-password';
        }, 300),

        /**
         * Clear messages if otp clicked
         */
        otpClicked() {
            this.authMessage.hasError = false;
            this.authMessage.errorMsg = '';
        },

        resetData() {
            this.authMessage.hasError = false;
            this.authMessage.errorMsg = '';
            this.otp.code = '';
        },

        resendCode: useDebounceFn(that => {
                that.resetData()

                that.is.codeResended = true;
                AuthApi.resendCode()
                    .finally(() => that.is.codeResended = false)
            }
            , 500),

        /**
         * Go back to get phone number page
         */
        updatePhoneNumber() {
            this.authMessage.hasError = false;
            this.authMessage.errorMsg = '';
            this.otp.code = '';
            this.otp.state = 'phone-page'
        },

        /**
         * User login process
         *
         * @param data
         */
        login(data) {
            this.is.loading = true;

            AuthApi.login(data)
                .then(response =>
                    response.data.status ?
                        this.handleSuccessLogin(response.data) :
                        this.authMessage = {
                            hasError: true,
                            errorMsg: response.data.msg
                        }
                )
                .finally(() => this.is.loading = false)
        },

        /**
         * Logout user
         */
        logout() {
            localStorage.removeItem('user');
            location.reload();
        },

        /**
         * Logged in user
         */
        loginUser() {
            const user = localStorage.getItem('user');
            return user ? JSON.parse(user) : '';
        },

        /**
         * Check if user is not login redirect back to login page
         */
        checkLogin() {
            AuthApi.checkLogin()
                .then(
                    response => {
                        if (!response.data) {
                            localStorage.removeItem('user');
                            router.push("sign-in")
                        }
                    }
                )
        },

        $can(permission) {
            const userObj = this.loginUser();

            const permissions = userObj ? userObj.permissions : [];

            return permissions.indexOf(permission) === -1

        }
    }
})