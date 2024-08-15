# todo-task-app

Laravel ile geliştirilmiş örnek bir to-do görev uygulamasıdır. Bu uygulamada "admin" ve "kullanıcı" adında 2 rol vardır. Adminlerin ek olarak tek yapabildiği kullanıcıları yönetebilmesidir. Tüm kullanıcılar, ana sayfada ortak bir takvimden etkinlikleri yönetebilirler ve planlayabilirler. Tüm değişiklikleri herkes görür.

### Kullanılan Teknolojiler

* Laravel 11
* Blade
* MySQL
* JavaScript & jQuery (AJAX)
* Vite
* Docker & Laravel Sail
* PHPUnit

### Geliştirme Süreci

Geliştirme süreci ile ilgili detaylara bu reponun "issues" kısmında "closed issues" bölümünde ulaşabilirsiniz.

* Docker/Sail kullanılmıştır. 
* Bazı temel fonksiyon testleri (PHPUnit) yazılmıştır ve denenmiştir. (/test klasöründe)
* Spatie paketi ile yetkilendirme sistemi yapılmıştır.
* Breeze Auth kiti kullanılmıştır.
* Gerekli görülen yerlere Validation, Rate Limiter gibi güvenlik önlemleri uygulanmıştır.
* Test Veri Tabanı konfigüre edilmiştir.
* FullCallendar kütüphanesinden yararlanılmıştır.
* jQuery ve AJAX teknolojileri kullanılmıştır.