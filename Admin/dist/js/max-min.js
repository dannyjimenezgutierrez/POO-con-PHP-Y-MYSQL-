  if (typeof feather !== "undefined" && feather.replace) {
        feather.replace();
    }

    let isMaximized = false;

    document.getElementById('maximizeToggle').addEventListener('click', function(e) {
        e.preventDefault();
        const docEl = document.documentElement;
        const icon = document.getElementById('iconMaximize');

        if (!isMaximized) {
            if (docEl.requestFullscreen) {
                docEl.requestFullscreen();
            } else if (docEl.webkitRequestFullscreen) {
                docEl.webkitRequestFullscreen();
            } else if (docEl.msRequestFullscreen) {
                docEl.msRequestFullscreen();
            }
            icon.setAttribute('data-feather', 'minimize');
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            icon.setAttribute('data-feather', 'maximize');
        }
        isMaximized = !isMaximized;
        if (typeof feather !== "undefined" && feather.replace) {
            feather.replace();
        }
    });

    // Si el usuario sale del fullscreen con ESC, actualiza el icono
    document.addEventListener('fullscreenchange', function() {
        const icon = document.getElementById('iconMaximize');
        if (!document.fullscreenElement) {
            isMaximized = false;
            icon.setAttribute('data-feather', 'maximize');
            if (typeof feather !== "undefined" && feather.replace) {
                feather.replace();
            }
        }
    });