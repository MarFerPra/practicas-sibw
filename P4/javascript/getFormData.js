// Taken from:
// https://stackoverflow.com/questions/22783108/convert-js-object-to-form-data
function getFormData(object) {
    const formData = new FormData();
    Object.keys(object).forEach(key => formData.append(key, object[key]));
    return formData;
}
