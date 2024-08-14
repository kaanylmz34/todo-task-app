<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Görevlerim
        </h2>
    </x-slot>
        
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('task.list')
                    <div id="calendar"></div>
                    @endcan
                    @cannot('task.list')
                    <span>Görevleri görüntülemek için yetkiniz yok.</span>
                    @endcannot
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- FullCalendar jQuery CDN -->
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<link href='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.css' rel='stylesheet' />
<script>
   $(function() {
       // #calendar elementine Türkçe FullCalendar uygula ve "Görev Ekle" düğmesi ekle diğer düğmelerin yanına
         $('#calendar').fullCalendar({
              header: {
                left: 'addTaskButton,prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
              },
              customButtons: {
                addTaskButton: {
                  text: 'Görev Ekle',
                  click: function() {
                    alert('Görev ekleme formunu buraya ekleyebilirsiniz.');
                  }
                }
              },
              buttonText: {
                today: 'Bugün',
                month: 'Ay',
                week: 'Hafta',
                day: 'Gün'
              },
              // Etkinlikleri çekmek için AJAX isteği gönder
              events: {
                // @TODO ...
                url: '',
                type: 'GET',
                data: {
                     _token: '{{ csrf_token() }}'
                }
              },
              // Etkinliklerin üzerine tıklandığında etkinlik detaylarını gösterir
              eventClick: function(event) {
                alert('Etkinlik: ' + event.title + '\nBaşlangıç: ' + event.start.format('DD.MM.YYYY HH:mm') + '\nBitiş: ' + event.end.format('DD.MM.YYYY HH:mm'));
              }
         });

            $('#calendar').fullCalendar('option', {
                monthNames: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                monthNamesShort: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'],
                dayNames: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                dayNamesShort: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt'],
                buttonText: {
                    today: 'Bugün',
                    month: 'Ay',
                    week: 'Hafta',
                    day: 'Gün'
                }
            });

            $('#calendar').fullCalendar('option', {
                eventRender: function(event, element) {
                    element.find('.fc-title').html(event.title);
                    element.find('.fc-time').html(event.start.format('HH:mm') + ' - ' + event.end.format('HH:mm'));
                }
            });
   });
</script>