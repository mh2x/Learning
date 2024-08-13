//(() => {

    function showPrompt(message) {
        return prompt(message, 'Type anything here');
    }

    function SayIt2(txt) {
        window.alert(txt);
        console.log(txt);
    }

    async function startStreamCapture(){
        let captureStream = null;
        try {
            captureStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
        }
        catch (err) {
            console.error('Error: ', err);
        }
        return captureStream;
    }

    async function startShare () {
        const videoElement = document.getElementById('screenVideo');
        const stream = await startStreamCapture();
        videoElement.srcObject = stream;
    }


//})();

