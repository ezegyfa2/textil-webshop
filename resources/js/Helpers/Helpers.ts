import { useDisplay } from 'vuetify';

export function distinctObjectsByProperty(items: Array<Object>, propertyName: string) {
    const distinctValues = {};
    items.forEach(item => {
        distinctValues[item[propertyName]] = item;
    });
    return Object.values(distinctValues);
}

export function distinct(items: Array<any>) {
    return [...(new Set(items))];
}

export function shortText(text: string) {
    const { smAndDown } = useDisplay();
    if (smAndDown) {
        return text.substring(0, 20) + '...';
    } else {
        return text;
    }
}
