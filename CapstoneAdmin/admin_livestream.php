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

        // Generate a Token by calling a method.
        // @param 1: appID
        // @param 2: serverSecret
        // @param 3: Room ID
        // @param 4: User ID
        // @param 5: Username
        const appID = 623901365;
        const serverSecret = "b808c388015d8c574eb8591e6dfe4036";

        const roomID = getUrlParams(window.location.href)['roomID'] || (Math.floor(Math.random() * 10000) + "");
        const userID = Math.floor(Math.random() * 10000) + "";
        const userName = "userName" + userID;

        const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(appID, serverSecret, roomID, userID, userName);

        // You can assign different roles based on url parameters.
        let role = getUrlParams(window.location.href)['role'] || 'Host';
        role = role === 'Host' ? ZegoUIKitPrebuilt.Host : ZegoUIKitPrebuilt.Audience;

        let config = {};
        if (role === 'Host') {
            config = {
                turnOnCameraWhenJoining: true,
                showMyCameraToggleButton: true,
                showAudioVideoSettingsButton: true,
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
            sharedLinks: [{
                name: 'Join as an audience',
                url: 'http://localhost/CapstoneAdmin/livestream.php?roomID=' + roomID + '&role=Audience',
            }],
            ...config
        });

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'url.php?id=<?php echo $_SESSION['dog_id'];?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        console.log(response.message);
                    } else {
                        console.error(response.message);
                    }
                } else {
                    console.error('HTTP request failed with status ' + xhr.status);
                }
            }
        };
        xhr.send('url=' + encodeURIComponent(roomID));

    }
</script>