function customAlert() {
    this.render = function (dialog) {
        let winW = window.innerWidth;
        let winH = window.innerHeight;
        $('#dialogoverlay').css('display', 'block');
        $('#dialogoverlay').css('height', winH + 'px');
        $('#dialogbox').css('left', (winW / 4) + 'px');
        $('#dialogbox').css('top', '100px');
        $('#dialogbox').css('display', 'block');
        $('#dialoghead').html('Dėmesio!');
        $('#dialogbody').html(dialog);
        $('#dialogfoot').html('<button class="mygtukasAlerto" onclick="Alert.ok()">GERAI</button>');
    };
    this.ok = function () {
        $('#dialogoverlay').css('display', 'none');
        $('#dialogbox').css('display', 'none');
    }
}

let Alert = new customAlert();
