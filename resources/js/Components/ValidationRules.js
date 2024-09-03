export function passwordRule(value) {
    return combineRules(
        requiredRule(value),
        minLengthRule(value, 8),
        maxLengthRule(value, 255),
        containLowerCaseRule(value),
        containUpperCaseRule(value),
        containNumberRule(value),
        containSpecialCharacterRule(value)
    );
}

export function requiredRule(value) {
    return value ? true : 'This field is required';
}

export function minLengthRule(value, minLength) {
    return value?.length >= minLength || `Value must at least ${minLength} character long`;
}

export function maxLengthRule(value, maxLength) {
    return value?.length <= maxLength || `Value must maximum ${maxLength} character long`;
}

export function emailRule(value) {
    return /.+@.+\..+/.test(value) || 'Value must be a valid email';
}

export function lowerCaseRule(value) {
    return value == value.toLowerCase() || 'Value must be lowecase';
}

export function containLowerCaseRule(value) {
    return /[a-z]/.test(value) || 'Value must contain at least one lowercase letter';
}

export function containUpperCaseRule(value) {
    return /[A-Z]/.test(value) || 'Value must contain at least one uppercase letter';
}

export function containNumberRule(value) {
    return /[0-9]/.test(value) || 'Value must contain at least one number';
}

export function containSpecialCharacterRule(value) {
    return /\W|_/.test(value) || 'Value must contain at least one special character';
}

export function combineRules(...ruleResults) {
    for (const ruleResult of ruleResults) {
        if (ruleResult !== true) {
            return ruleResult;
        }
    }
    return true;
}