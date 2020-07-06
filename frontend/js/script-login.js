import Swal from 'sweetalert2/dist/sweetalert2.all'

import {
    getParent,
    fadeOut,
    serialize
} from "./utils";

import axios from 'axios';

(() => {

    const focusInput = (i) => {
        i.closest('.form-group').classList.add('focus');

        const blurInput = () => {
            i.closest('.form-group').classList.remove('focus');
            i.removeEventListener('blur', blurInput);
        };

        i.addEventListener('blur', blurInput);
    };

    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 20000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    const fazerLogin = (form) => {
        const buttonSubmit = form.querySelector("button[type=\"submit\"]");

        buttonSubmit.innerHTML = "Login <i class=\"fas fa-spinner fa-pulse ml-2\"></i>";
        buttonSubmit.disabled = true;

        axios.post(form.action, serialize(form))
            .then(function (response) {
                const retorno = response.data;

                if (retorno.status) {
                    Toast.fire({
                        icon: 'success',
                        title: retorno.mensagem
                    });

                    const extra = JSON.parse(retorno.extra);

                    setTimeout(() => {
                        location.href = extra.url_direcionar;
                    }, 1000);

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: retorno.mensagem
                    });

                    buttonSubmit.innerHTML = "Login";
                    buttonSubmit.disabled = false;
                }

            })
            .catch(function (error) {
                Toast.fire({
                    icon: 'error',
                    title: error
                });

                buttonSubmit.innerHTML = "Login";
                buttonSubmit.disabled = false;
            });

        return false;
    }

    window.addEventListener('DOMContentLoaded', () => {

        setTimeout(() => {

            fadeOut('.load-page', 0.5, () => {
                document.documentElement.classList.add('load');
                document.body.classList.add('load');
            });
        }, 1000);

        Array.prototype.forEach.call(document.querySelectorAll('.form-control'), (i) => {
            i.addEventListener('focus', () => {
                focusInput(i)
            });
        });

        Array.prototype.forEach.call(document.querySelectorAll('.show-password'), (link) => {
            link.addEventListener('click', () => {
                const inputTarget = link.parentElement.querySelector('input[type="text"], input[type="password"]');

                if (link.classList.toggle('active'))
                    inputTarget.setAttribute("type", "text");
                else
                    inputTarget.setAttribute("type", "password");

                inputTarget.focus();
            });
        });

        $(".form-validate").validate({
            language: "pt-BR",
            highlight: function (element) {
                getParent(element, '.form-group').classList.add('has-error');
            },
            unhighlight: function (element) {
                getParent(element, '.form-group').classList.remove('has-error');
            },
            errorElement: 'label',
            errorClass: 'error',
            errorPlacement: function (error, element) {
                getParent(element[0], '.form-group').appendChild(error[0]);
            },
            submitHandler: fazerLogin
        });

    });

})();