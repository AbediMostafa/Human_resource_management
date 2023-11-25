import {Modal} from "bootstrap";

const hideModal = (modalEl: HTMLElement | null | string): void => {
    if (!modalEl) {
        return;
    }

    const myModal = typeof modalEl === 'string' ?
        Modal.getInstance(document.getElementById(modalEl)) :
        Modal.getInstance(modalEl);

    myModal.hide();
};

const showModal = (modalEl: HTMLElement | null|string): void => {
    if (!modalEl) {
        return;
    }

    const myModal = Modal.getInstance(modalEl);
    myModal.show();
};

const displayModal = (id) => {
    const elem = document.getElementById(id);
    const modalObj = new Modal(elem);
    modalObj.show();
}

const removeModalBackdrop = (): void => {
    if (document.querySelectorAll(".modal-backdrop.fade.show").length) {
        document.querySelectorAll(".modal-backdrop.fade.show").forEach((item) => {
            item.remove();
        });
    }
};

const onModalOpen = (id, callB) => {

    const elem = document.getElementById(id);

    elem?.addEventListener('show.bs.modal', function (e) {
        callB(e);
    })
}

export {removeModalBackdrop, hideModal, showModal, displayModal, onModalOpen};
