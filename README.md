# Module Pemrograman Perangkat Mobile Rev 2019

Modul ini dibuat menggunakan Gitbook, silahkan baca dokumentasi tentang gitbook
untuk membaca atau menambahkan materi pada modul ini.Selain itu juga digunakan
sintaks markdown untuk memudahkan formatting tulisan silahkan belajar markdown
ya guys contoh2 markdown ta copas nang isor.

# Contribute

Please run `npm install`, `npm start` then start to contribute!

# Text

It's very easy to make some words **bold** and other words _italic_ with Markdown. You can even [link to Google!](http://google.com)

# List

Sometimes you want numbered lists:

1. One
2. Two
3. Three

Sometimes you want bullet points:

- Start a line with a star
- Profit!

Alternatively,

- Dashes work just as well
- And if you have sub points, put two spaces before the dash or star:

  - Like this
  - And this

  #Images
  If you want to embed images, this is how you do it:

![Image of Yaktocat](https://octodex.github.com/images/yaktocat.png)

# Structured documents

Sometimes it's useful to have different levels of headings to structure your documents. Start lines with a `#` to create headings. Multiple `##` in a row denote smaller heading sizes.

### This is a third-tier heading

You can use one `#` all the way up to `######` six for different heading sizes.

If you'd like to quote someone, use the > character before the line:

> Coffee. The finest organic suspension ever devised... I beat the Borg with it.
>
> - Captain Janeway

#Code
There are many different ways to style code with GitHub's markdown. If you have inline code blocks, wrap them in backticks: `var example = true`. If you've got a longer block of code, you can indent with four spaces:

    if (isAwesome){
      return true
    }

GitHub also supports something called code fencing, which allows for multiple lines without indentation:

```
if (isAwesome){
  return true
}
```

And if you'd like to use syntax highlighting, include the language:

```javascript
if (isAwesome) {
  return true;
}
```

#Extras

# This is an <h1> tag

## This is an <h2> tag

###### This is an <h6> tag

_This text will be italic_
_This will also be italic_

**This text will be bold**
**This will also be bold**

_You **can** combine them_

#unorderedlist

- Item 1
- Item 2
  - Item 2a
  - Item 2b

#OrderedList

1. Item 1
1. Item 2
1. Item 3
   1. Item 3a
   1. Item 3b

#Tables

| First Header                | Second Header                |
| --------------------------- | ---------------------------- |
| Content from cell 1         | Content from cell 2          |
| Content in the first column | Content in the second column |

#Horizontal Rule

Three or more...

---

Hyphens

---

Asterisks

....

# Pengantar dan Pengenalan Web Framework

## Persiapan

### Perangkat Lunak

- [Xampp](https://apachefriends.org) / [Wamp](http://www.wampserver.com/en/) / (PHP + Apache + MySql)
- Text Editor/IDE
- Git (Referensi: [Try Github](http://try.github.com))

### Editor

> Your editor is your Katana

Perkuliahan ini tidak mewajibkan anda untuk menggunakan suatu text editor/IDE
tertentu (gunakan sesuai preferensi anda).

Beberapa text editor/IDE yang umum digunakan antara lain:

- [Sublime Text 3](https://sublimetext.com/3)
- [Visual Studio Code](https://code.visualstudio.com)
- [Atom](https://atom.io)
- [Notepad++](https://notepad-plus-plus.org)
- [Webstorm](https://jetbrains.com/webstorm)
- [Emacs](https://gnu.org/emacs)
- [Vim](https://vim.org)

Recommended Settings & Plugins

- Linter
  - [Sublime Text 3](https://github.com/SublimeLinter/SublimeLinter-php)
  - [VS Code](https://code.visualstudio.com/docs/languages/php#_linting)
- [Emmet](https://emmet.io/download/)
- CodeIgniter 3 Snippet
- Bootstrap 3 Snippet
- Bootstrap 3 Autocomplete

## Instalasi CodeIgniter

{{'https://www.youtube.com/watch?v=4gIm35pDNSo'|video}}
Unduh paket CodeIgniter 3 pada halaman [CodeIgniter
Download](https://codeigniter.com/download). Pastikan versi yang diunduh adalah
versi 3.x (versi saat modul ini ditulis adalah 3.1.7). Jika instalasi sukses,
anda akan mendapatkan tampilan seperti berikut.

![CodeIgniter](./images/01/codeigniter_welcome.png)

Panduan lebih lengkap dapat dilihat di [Docs CodeIgniter
3](https://www.codeigniter.com/userguide3/installation/index.html)

## Konfigurasi CodeIgniter

File-file yang berkaitan dengan konfigurasi CodeIgniter, antara lain:

- `application/config/config.php`
  File ini menyimpan konfigurasi utama CodeIgniter serta untuk mendefinisikan
  helpers. Contohnya: `url helper` yang berisi fungsi bantuan yang umum
  digunakan `base_url()` serta `site_url`
- `application/config/database.php`
  File ini menyimpan konfigurasi yang berkaitan koneksi ke database.
- `application/config/routes.php`
  File ini menyimpan konfigurasi route url yang ada dalam aplikasi web.

## Instalasi Twitter Bootstrap

Untuk menginstall Twitter Bootstrap, unduh pada halaman [Download Twitter
Bootstrap](http://getbootstrap.com/getting-started/#download). Kemudian ekstrak
file yang telah didownload, sehingga didapatkan struktur direktori seperti
berikut:

```
bootstrap-3.3.7-dist
├── css
│   ├── bootstrap-theme.css
│   ├── bootstrap-theme.css.map
│   ├── bootstrap-theme.min.css
│   ├── bootstrap-theme.min.css.map
│   ├── bootstrap.css
│   ├── bootstrap.css.map
│   ├── bootstrap.min.css
│   └── bootstrap.min.css.map
├── fonts
│   ├── glyphicons-halflings-regular.eot
│   ├── glyphicons-halflings-regular.svg
│   ├── glyphicons-halflings-regular.ttf
│   ├── glyphicons-halflings-regular.woff
│   └── glyphicons-halflings-regular.woff2
└── js
    ├── bootstrap.js
    ├── bootstrap.min.js
    └── npm.js
```

### Percobaan Twitter Bootstrap

- Buatlah direktori dengan nama `hello-bootstrap` pada direktori `htdocs` web server.
- Tambahkan file `index.php` pada direktori tersebut.
- Copy file `css`, `js` serta `font` ke dalam direktori, sehingga terbentuk struktur seperti berikut.

```
hello-bootstrap
├── css
├── font
├── index.php
└── js
```

- Buatlah struktur dasar html seperti di bawah ini

```html
<!DOCTYPE html>
<html>
<head>
<title>Hello Bootstrap</title>
</head>
<body>

</body>
</html>
```

- Tambahkan css bootstrap pada bagian `head`.

```html
<link href="css/bootstrap.min.css" rel="stylesheet">
```

- Tambahkan js bootstrap dan jquery pada bagian akhir `body`.

```html
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
```

> Twitter Bootstrap membutuhkan jquery, download jquery pada link berikut:
> [Download jquery](https://jquery.com/download/)

- Tuliskan kode berikut untuk menampilkan isi halaman.

```html
<h1 class="text-center">Hello Bootstrap</h1>
```

## Integrasi Twitter Bootstrap dengan CodeIgniter

- Ekstrak file Twitter Bootstrap yang telah diunduh (`css`, `js`, `font`).
- Buatlah folder `assets`
- Copykan ketiga folder `css`, `js` dan `font` ke dalam folder assets dari
  framework CodeIgniter 3, sehingga struktur direktori kurang lebih seperti
  berikut.

```
codeigniter
├── application
│   ├── ...
├── assets
│   ├── css
│   ├── fonts
│   └── js
├── composer.json
├── contributing.md
├── index.php
├── license.txt
├── readme.rst
├── system
│   ├── ...
└── user_guide
   ├── ...
```

- Buka file `application/config/config.php` untuk mengkonfigurasi url helper.
  Cari bagian `base_url` dan isikan nilai sesuai dengan path anda atau vhost, jika anda
  menggunakan virtual host.

```php
// Pada sistem penulis menggunakan alamat localhost dengan port 8080
$config['base_url'] = 'http://localhost:8080/';
```

- Modifikasi file `view/welcome_message.php`

![Welcome CodeIgniter](./images/01/codeigniter_welcome.png)

- Sehingga menjadi tampilan seperti berikut dengan menggunakan komponen dari
  Twitter Bootstrap

![Welcome CodeIgniter + Bootstrap](./images/01/codeigniter_bootstrap_welcome.png)

- Buka file `application/views/welcome_message.php` ubah isi file menjadi
  seperti berikut.

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

</body>
</html>
```

- Tambahkan baris berikut ke dalam bagian `head`

```php
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pemrograman Web Berbasis Framework</title>

<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
```

- Kemudian tambahkan baris berikut pada bagian sebelum akhir tag `body`

```php
<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
```

- Untuk membuat menu pada bagian atas, digunakan komponen `navbar`.

```html
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Web Framework</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Beranda</a></li>
        <li><a href="#about">Tentang Saya</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Submenu 1</a></li>
            <li><a href="#">Submenu 2</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
```

- Sedangkan untuk tampilan halaman digunakan struktur html berikut.

```html
<div class="container">
  <div class="jumbotron">
    <h1>Hello CodeIgniter + Bootstrap</h1>
    <p>
      Consectetur unde eius ducimus esse obcaecati perferendis, ad
      veritatis quo, nostrum! Dolor consequuntur assumenda quisquam eos
      repellat Magni voluptates sed neque odio officiis? Laborum aliquid
      obcaecati eaque sint error Nam.
    </p>
    <p>
      <a class="btn btn-lg btn-primary"
        href="http://getbootstrap.com/docs/3.3/" role="button">
        Lihat Dokumentasi Bootstrap 3 &raquo;
      </a>
    </p>
  </div>
</div>
```

## Percobaan Halaman Statis 1

- Update menu navbar dengan url helper, ubah menu beranda dengan `base_url` dan
  halaman **Tentang Saya** dengan `site_url('welcome/about')`.

- Tambahkan fungsi `about()` pada file `/application/controllers/Welcome.php`

```php
function about() {

}
```

- Pada fungsi `about()` sisipkan fungsi untuk menampilkan halaman statis yang
  akan dibuat pada step berikutnya.

```php
$this->load->view('about');
```

- Buat file baru dengan nama `about.php` pada direktori `/application/views/`.
- Salin isi halaman pada view `welcome_message.php` ke dalam `about.php`
  sehingga menghasilkan halaman tampilan berikut.

![About](./images/01/about.png)

## Percobaan Halaman Statis 2

- Update halaman statis view `about.php` dengan isi biodata anda mengenai
  informasi berikut dengan menggunakan komponen Bootstrap:
  - NIM
  - Nama
  - Gender
  - Hobi

> Kreasikan komponen Twitter Bootstrap sesuai dengan kreatifitas anda!
