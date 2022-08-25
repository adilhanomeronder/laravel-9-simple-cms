# Laravel 9 Basit Yönetim Paneli
-----
## İçindekiler

* [Özellikler](#item1)
* [Kurulum](#item2)
* [Ekran Görüntüleri](#item3)

<a name="item1"></a>
## Özellikler:
* Admin Panel
  * Sayfa Yönetimi
  * Menü Yönetimi & Sub Menü
  * Üyelik Yönetimi
  * Blog Yönetimi
  * Kategori Yönetimi
  * Ürün Yönetimi & Multiple Image
  * Hizmet Yönetimi
  * Galeri Yönetimi
  * SSS Yönetimi
  * Yorum Yönetimi
  * JQUERY UI Draggable
  * CKEditor Image Upload
-----

<a name="item2"></a>
## Kurulum:

Depoyu klonlayın, bağımlılıkları yükleyin.

    $ git clone https://github.com/adilhanomeronder/laravel-9-simple-cms.git && cd laravel-9-simple-cms
    $ composer update

.env.example dosyasını .env olarak değiştirin ve veritabanızı ayarlarınızı ve path ayarlarınızı düzenleyin. Sonrasında aşağıdaki kodları sırasıyla çalıştırın.

    $ php artisan migrate
    $ php artisan db:seed
    $ php artisan key:generate
    $ php artisan serve

Admin panele ulaşmak için [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin) giriş yapınız.

Varsayılan kullanıcı adı: `admin`, şifre: `1` şeklindedir.

-----

<a name="item3"></a>
## Ekran Görüntüleri:

![Login](https://programyukle.net/upload/simple-cms-admin/login.png)
![Dashboard](https://programyukle.net/upload/simple-cms-admin/dashboard.png)
![Add - Edit](https://programyukle.net/upload/simple-cms-admin/add.png)
![Listing](https://programyukle.net/upload/simple-cms-admin/listing.png)





