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
</head>
<body>

    <div id="calendar"></div>
    <div id='details'></div>


    <script>

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
                googleCalendarApiKey: '',
                events:'',

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
