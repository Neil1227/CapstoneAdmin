<div id="root"></div>

<script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>
<script>
    window.onload = function () {
        function getUrlParams(url) {
            let urlStr = url.split('?')[1];
            const urlSearchParams = new URLSearchParams(urlStr);
            const result = Object.fromEntries(urlSearchParams.entries());
            return result;
        }

        // Function to join the room
        function joinRoom(roomID, role) {
            const appID = 623901365;
            const serverSecret = "b808c388015d8c574eb8591e6dfe4036";
            const userID = Math.floor(Math.random() * 10000) + "";
            const userName = "userName" + userID;

            const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(appID, serverSecret, roomID, userID, userName);

            let config = {};
            if (role === 'Host') {
                config = {
                    turnOnCameraWhenJoining: false,
                    showMyCameraToggleButton: false,
                    showAudioVideoSettingsButton: false,
                    showScreenSharingButton: true,
                    showTextChat: false,
                    showUserList: false,
                };
            }

            const zp = ZegoUIKitPrebuilt.create(kitToken);
            zp.joinRoom({
                container: document.querySelector("#root"),
                scenario: {
                    mode: ZegoUIKitPrebuilt.LiveStreaming,
                    config: {
                        role,
                    },
                },
                ...config
            });
        }

        // Check for roomID and role parameters in the URL
        const params = getUrlParams(window.location.href);
        const roomIDParam = params['roomID'];
        const roleParam = params['role'];

        // If roomID and role are present, join the room
        if (roomIDParam && roleParam) {
            joinRoom(roomIDParam, roleParam);
        }
    }
</script>
