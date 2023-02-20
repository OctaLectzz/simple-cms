let loadFile = function(event) {
    var images = document.getElementById('profile');
    images.src = URL.createObjectURL(event.target.files[0]);
}