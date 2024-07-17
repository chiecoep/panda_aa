<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
    <script src="index.global.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>
</head>
<body>

    <div id="calendar"></div>
    <div id='details'></div>


    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyAiT79gE5s9X28UQszXEEqCx9wNcB_SY00",
            authDomain: "sample-ee6e1.firebaseapp.com",
            databaseURL: "https://sample-ee6e1-default-rtdb.firebaseio.com",
            projectId: "sample-ee6e1",
            storageBucket: "sample-ee6e1.appspot.com",
            messagingSenderId: "734929865290",
            appId: "1:734929865290:web:4fcc246156ae7a9c7ff4b3"
        };
        firebase.initializeApp(firebaseConfig);

        var currentEventId;

        // カレンダー・日時フォーマット
        function formatDateTime(date) {
            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' };
            return date.toLocaleDateString('ja-JP', options);
        }

        // カレンダー・詳細表示
        function displayEventDetails(event, detailsEl) {
            var start = formatDateTime(event.start);
            var end = event.end ? formatDateTime(event.end) : '';
            var details = '<strong>' + event.title + '</strong> <small>' + start + (end ? ' - ' + end : '') + '</small><br>';
            details += '<a href="https://meet.google.com/ies-znhr-fve" target="_blank">Meetに参加</a><BR>';
            details += event.extendedProps.description + '<br><br>';
            if (event.extendedProps.location) {
                details += 'address: ' + event.extendedProps.location + ' <a href="https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(event.extendedProps.location) + '" target="_blank">MAP🔗</a><br>';
            }
            detailsEl.innerHTML = details;
        }





        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var detailsEl = document.getElementById('details');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                googleCalendarApiKey: 'AIzaSyAiT79gE5s9X28UQszXEEqCx9wNcB_SY00',
                events:'9afbdeaa2683ae8311b0d35314aaad55b48c0b93c7d26467f2668e360895dfb8@group.calendar.google.com',

                // カレンダー・クリックイベント
                eventClick: function(info) {
                    try {
                        info.jsEvent.preventDefault(); //イベントURLに遷移しない
                        displayEventDetails(info.event, detailsEl);
                    } catch (error) {
                        console.error('An error occurred:', error);
                        detailsEl.innerHTML = 'イベントの詳細を表示する際にエラーが発生しました。';
                    }
                },

                // カレンダー・表示定義
                eventTimeFormat: { hour: 'numeric', minute: '2-digit' }, //イベントの日時表示形式
                eventDidMount: (e)=>{ //カレンダーにイベントを表示
                    tippy(e.el, {
                    content: e.event.title,
                    });
                },
            });
            calendar.render(); //カレンダー表示
        });
    </script>

</body>
</html>
