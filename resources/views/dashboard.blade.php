<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Görevlerim

          @can('task.create')
              <a href="#" class="text-indigo-600 hover:text-indigo-900 float-right add-task">Yeni Ekle</a>
          @endcan
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

    @can('task.create')
      <!-- Soldan açılan Görev oluşturma modalı -->
      <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addTaskModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75 modal-background"></div>
          </div>
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                    Görev Oluştur
                    <button type="button" class="inline-flex justify-center rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 float-right" onclick="$('#addTaskModal').toggleClass('hidden')">
                      <span class="sr-only">Close</span>
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </h3>
                  <div class="mt-2">
                    <form action="{{ route('task.store') }}" method="POST">
                      @csrf
                      <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Başlık</label>
                        <input type="text" name="title" id="title" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>
                      <div class="mt-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Açıklama</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                      </div>
                      <div class="mt-2">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Başlangıç Tarihi</label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>
                      <div class="mt-2">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Bitiş Tarihi</label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>
                      <div class="mt-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">Durum</label>
                        <select id="status" name="status" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          <option value="0">Yapılacak</option>
                          <option value="1">Devam Ediyor</option>
                          <option value="2">Tamamlandı</option>
                        </select>
                      </div>
                      <div class="mt-2">
                        <label for="assigned_to" class="block text-sm font-medium text-gray-700">Kullanıcı</label>
                        <select id="assigned_to" name="assigned_to" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mt-2">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Öncelik</label>
                        <select id="priority" name="priority" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          <option value="0">Düşük</option>
                          <option value="1">Normal</option>
                          <option value="2">Yüksek</option>
                        </select>
                      </div>
                      <div class="mt-2 pb-[35px]">
                        <button type="submit" class="inline-flex float-right justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Oluştur
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endcan
</x-app-layout>
<!-- FullCalendar jQuery CDN -->
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<link href='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.css' rel='stylesheet' />
<script>
   $(function() {
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

        @can('task.create')
        // .add-task
        $('.add-task').click(function() {
          $('#addTaskModal').toggleClass('hidden');
        });

        // modal backgrounda tıklanınca modalı kapat
        $('.modal-background').click(function() {
          $('#addTaskModal').toggleClass('hidden');
        });
        @endcan
  });
</script>