// Forditasokhoz lehet hasznalni az xtraerps megoldast ugy h a forditas jsonoket legeneralja a https://github.com/xiCO2k/laravel-vue-i18n package

import { addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';
import { nextTick } from 'vue';

export const emailRules = [
    requiredRule,
    maxFieldLengthRule,
    emailRule,
    lowerCaseRule,
];

export const nameRules = [
    requiredRule,
    maxFieldLengthRule,
];

export const passwordRules = [
    requiredRule,
    value => minLengthRule(value, 8),
    maxFieldLengthRule,
    containLowerCaseRule,
    containUpperCaseRule,
    containNumberRule,
    containSpecialCharacterRule,
];

export const phoneRules = [
    phoneRule,
    value => minLengthRule(value, 6),
    value => maxLengthRule(value, 15),
];

export function handleValidationErrors(errors, goTo) {
    if (errors) {
        console.log(errors);
    }
    addUnexpectedErrorNotification(' în timpul executării operațiunii');
    nextTick(() => {
        goTo(document.querySelector(".v-messages__message:first-of-type"), {
            easing: 'easeInOutCubic',
            offset: -200,
        })
    });
}

export function requiredRule(value) {
    const isEmptyArray = Array.isArray(value) && value.length == 0;
    return (value !== null && value !== undefined && value !== '' && !isEmptyArray) || 'Acest câmp este obligatoriu';
}

export function minLengthRule(value, minLength) {
    return isNullable(value) || value.length >= minLength || `Valoarea trebuie să aibă cel puțin ${minLength} caractere lungime`;
}

export function maxTextareaLengthRule(value) {
    return maxLengthRule(value, 1000);
}

export function maxFieldLengthRule(value) {
    return maxLengthRule(value, 250);
}

export function maxLengthRule(value, maxLength) {
    return isNullable(value) || value.length <= maxLength || `Valoarea trebuie să aibă maximum ${maxLength} caractere lungi`;
}

export function pozitiveRule(value) {
    return minRule(value, 0);
}

export function minRule(value, min) {
    if (isNullable(value)) {
        return true;
    } else {
        const numberValidation = numberRule(value);
        if (numberValidation === true) {
            return parseFloat(value) >= min || `Valoarea trebuie să aibă minimum ${min}`;
        } else {
            return numberValidation;
        }
    }
}

export function maxRule(value, max) {
    if (isNullable(value)) {
        return true;
    } else {
        const numberValidation = numberRule(value);
        if (numberValidation === true) {
            return parseFloat(value) <= max || `Valoarea trebuie să aibă maximum ${max}`;
        } else {
            return numberValidation;
        }
    }
}

export function phoneRule(value) {
    return isNullable(value) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value) || 'Valoarea trebuie să fie un număr de telefon valid'
}

export function emailRule(value) {
    return isNullable(value) || /.+@.+\..+/.test(value) || 'Valoarea trebuie să fie un e-mail valid';
}

export function lowerCaseRule(value) {
    return isNullable(value) || value == value.toLowerCase() || 'Valoarea trebuie să fie minusculă';
}

export function containLowerCaseRule(value) {
    return isNullable(value) || /[a-z]/.test(value) || 'Valoarea trebuie să conțină cel puțin o literă minusculă';
}

export function containUpperCaseRule(value) {
    return isNullable(value) || /[A-Z]/.test(value) || 'Valoarea trebuie să conțină cel puțin o literă majusculă';
}

export function containNumberRule(value) {
    return isNullable(value) || /[0-9]/.test(value) || 'Valoarea trebuie să conțină cel puțin un număr';
}

export function containSpecialCharacterRule(value) {
    return isNullable(value) || /\W|_/.test(value) || 'Valoarea trebuie să conțină cel puțin un caracter special';
}

export function numberRule(value) {
    return isNullable(value) || (!isNaN(value) && !isNaN(parseFloat(value))) || 'Valoarea trebuie să fie un număr';
}

export function integerRule(value) {
    return isNullable(value) || Number.isInteger(value) || 'Valoarea trebuie să fie un număr întreg';
}

export function confirmPasswordRule(value, confirmValue) {
    if (value == confirmValue) {
        return true;
    } else {
        return 'Parola și confirmarea trebuie să coincidă';
    }
}

export function combineRules(...ruleResults) {
    for (const ruleResult of ruleResults) {
        if (ruleResult !== true) {
            return ruleResult;
        }
    }
    return true;
}

function isNullable(value) {
    return value === null || value === '' || value === undefined;
}
