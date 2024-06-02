if (!!window.EventSource) {
    const source = new EventSource('/notifications/sse');

    source.onmessage = function (event) {

        if(event.data !== ""){
            var notifications = JSON.parse(event.data)
        }

        const notificationcircles = document.getElementById('notificationcircles')
        const notificationbadge = document.getElementById('notification-icon-badge')

        if(event.data === ""){
            // console.log("no notifications")
            notificationbadge.style.display = "none"
            notificationcircles.style.display = "none"

        }else{
            let count = notifications.length

            notificationbadge.style.display = "block"
            notificationcircles.style.display = "block"
            notificationbadge.innerHTML = count

        }

    };

}
