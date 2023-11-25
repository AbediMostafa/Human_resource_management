import router from "@/router";
import Swal from "sweetalert2/dist/sweetalert2.js";
import {ElMessageBox} from "element-plus";


const goBackWhenModalClosed = (id, route) => {
    // @ts-ignore
    document.getElementById(id).addEventListener('hide.bs.modal', function () {
        router.push({name: route})
    })
}

const fillUpWithResponse = (response, entity) => {
    entity.value.data = response.data.data;
    entity.value.currentPage = response.data.meta.current_page;
    entity.value.total = response.data.meta.total;
}

const doValidation = (formRef) => {

    return new Promise(resolve => {
        if (!formRef.value) {
            return;
        }

        formRef.value.validate((valid) => {
            if (valid) {
                resolve(valid)
            }
        })
    })
}

const deletePromise = (text, body='') =>
    new Promise(resolve =>
        Swal.fire({
            title: text,
            icon: 'warning',
            text:body,
            showCancelButton: true,
            confirmButtonText: 'yes',
            cancelButtonText: `no`,
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                resolve(result)
            }
        })
    )

const errorElBox = text => ElMessageBox.confirm(
    text,
    'error',
    {
        confirmButtonText: 'yes',
        dangerouslyUseHTMLString: true,
        type: 'error',
        showCancelButton: false,
        center: true
    }
)


export {
    goBackWhenModalClosed,
    fillUpWithResponse,
    deletePromise,
    doValidation,
    errorElBox,
}