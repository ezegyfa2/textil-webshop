function getSizeValues() {
    let sizeArray = {};
    let rows = Array.from(document.querySelector('table').querySelectorAll('tr'));
    rows.splice(0, 1);
    rows.forEach(rowNode => {
        let rowValues = Array.from(rowNode.querySelectorAll('td')).map(columnNode => columnNode.textContent.trim());
        sizeArray[rowValues[0]] = rowValues.slice(1);
    })
    return sizeArray;
}

function getName() {
    let nameNode = document.querySelector('.product-name h1');
    badgeNodes = nameNode.querySelectorAll('.badge');
    badgeNodes.forEach(badgeNode => nameNode.removeChild(badgeNode))
    return nameNode.textContent.trim();
}

function getProductData() {
    let tagroups = document.querySelectorAll('#product-taggrouping li.taggrouping');
    return JSON.stringify([
        getName(),
        parseFloat(document.querySelectorAll('.content section')[1].querySelectorAll('li span')[1].textContent.trim()),
        document.querySelectorAll('.content section')[1].querySelectorAll('li span')[3].textContent.trim(),
        document.querySelectorAll('.content section')[1].querySelectorAll('li span')[5].textContent.trim(),
        Array.from(tagroups[0]?.querySelectorAll('.badge'))?.map(tag => tag.textContent.trim()),
        Array.from(tagroups.length == 1 ? [] : tagroups[1]?.querySelectorAll('.badge'))?.map(tag => tag.textContent.trim()),
        [],
        getSizeValues(),
        Array.from(document.querySelector('tr').querySelectorAll('th')).map(node => node.textContent.trim()).filter(size => size != ''),
    ], null, 4).replaceAll(':', ' =>').replace('{', '[').replace('}', ']') + ',';
}

getProductData();



kp510?
WR9105?
SO046602?
SO046802?
