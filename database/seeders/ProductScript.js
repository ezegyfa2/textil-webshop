function checkedSelector(node, selector) {
    let findedNodes = node.querySelectorAll(selector);
    if (findedNodes.length == 1) {
        return findedNodes[0];
    } else {
        throw new Error('Invalid selector ' + selector);
    }
}

function getSizeValues() {
    let sizeArray = {};
    let table = checkedSelector(document, 'table.syn-table.syn-table-bordered.syn-table-hover.w-full.text-base');
    let rows = Array.from(table.querySelectorAll('tr'));
    rows.splice(0, 1);
    rows.forEach(rowNode => {
        let rowValues = Array.from(rowNode.querySelectorAll('td')).map(columnNode => columnNode.textContent.trim());
        sizeArray[rowValues[0]] = rowValues.slice(1);
    });
    return sizeArray;
}

function getName() {
    let nameNode = checkedSelector(document, '.text-lg.text-center.items-center');
    return nameNode.textContent.trim();
}

function getProductData() {
    let technicSection = document.querySelectorAll('section.leading-relaxed')[1];
    let leftSection = technicSection.querySelectorAll('ul')[0];
    let rightSection = technicSection.querySelectorAll('ul')[1];
    let materialItems = rightSection.querySelectorAll('li')[0].querySelectorAll('span.border-gray-200');
    let cutItems = rightSection.querySelectorAll('li')[1].querySelectorAll('span.border-gray-200');
    let sizeSelector = 'div.font-bold.text-center.text-lg.flex.flex-col.justify-center.border-l.border-gray-200.py-2';

    return JSON.stringify([
        getName(),
        parseFloat(leftSection.querySelectorAll('li')[0].querySelectorAll('span')[1].textContent.trim()),
        leftSection.querySelectorAll('li')[1].querySelectorAll('span')[1].textContent.trim(),
        leftSection.querySelectorAll('li')[2].querySelectorAll('span')[1].textContent.trim(),
        Array.from(materialItems)?.map(tag => tag.textContent.trim()),
        Array.from(cutItems)?.map(tag => tag.textContent.trim()),
        [],
        getSizeValues(),
        Array.from(document.querySelector('#grid-content').querySelectorAll(sizeSelector))
            .map(node => node.textContent.trim()).filter(size => size != ''),
    ], null, 4).replaceAll(':', ' =>').replace('{', '[').replace('}', ']') + ',';
}

getProductData();



kp510?
WR9105?
SO046602?
SO046802?
