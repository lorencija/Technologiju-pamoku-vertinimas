let c_name, c_text, jsonData;

function setData() {
    c_name = $('#addnewclass').val();
    c_text = nameFromEntering(c_name);
}

function createJson() {
    jsonData = {
        name: c_name,
        text: c_text
    };
}

function nameFromEntering(class_name) {
    return class_name.replace(' ', '');
}