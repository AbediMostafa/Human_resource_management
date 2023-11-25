import {configure} from "vee-validate";
import {globalRules} from "@/core/helpers/validation";

export function initVeeValidate() {
    globalRules()
    // Updating default vee-validate configuration
    configure({
        validateOnBlur: true,
        validateOnChange: true,
        validateOnInput: true,
        validateOnModelUpdate: true,
    });
}
