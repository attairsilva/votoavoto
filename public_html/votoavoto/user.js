var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

function start() {
    Instascan.Camera.getCameras()
        .then((cameras) => {
            scanner.start(cameras[0]);
        })
}