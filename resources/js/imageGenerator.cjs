const ProportionalCutterResizer = require('js-helper-methods/imageMethods/ProportionalCutterResizer.js')
const fs = require('fs');
const path = require('path');

const imageCreator = new ProportionalCutterResizer()
const imageSizes = [
    { width: 400, height: 400 },
    { width: 1200, height: 1200 },
]

let imageFolder = 'C:\\Projects\\laragon\\www\\textil-webshop\\storage\\app\\public\\images\\';
let fullSizeImageFolder = imageFolder + 'fullSize\\';

fs.readdirSync(fullSizeImageFolder).forEach(fileName => {
    imageCreator.createResponsiveVersions(
        fullSizeImageFolder + fileName, 
        imageSizes,
        imageFolder + path.parse(fileName).name
    )
});