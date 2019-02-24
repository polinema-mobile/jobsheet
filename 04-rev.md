# Intent

## Kemampuan akhir yang diharapkan

Setelah melakukan praktikum ini mahasiswa mampu :

1. Membuat Aplikasi Android untuk Mengirim Data antar Activity
2. Membuat Aplikasi Android dengan Memanfaatkan Defined Action

## Praktikum 1 - Mengirim Data antar Activity

#### Membuat Activity Pertama
1. Buka aplikasi Android Studio dan buat sebuah project baru. Nama aplikasi bisa diisikan sesuai dengan keinginan

!['intent'](img/04.1.jpg)

2. Pilihlah minimum sdk sesuai kebutuhan, misalnya pada praktikum ini kita gunakan API 15: Android 4.0.3

!['intent'](img/04.1.jpg)

3. Pilih Empty Activity untuk template project

4. Terima nama aktivitas default (MainActivity). Pastikan kotak Generate Layout file dicentang, kemudian klik Finish

5. Buka `res/layout/activity_main.xml`. Pada Layout Editor, klik tab Design di bagian bawah layar. Ubah layout yang digunakan menjadi **RelativeLayout**

6. Hapus TextView yang berbunyi "*Hello World*"

7. Tambahkan sebuah Plain Text. Beralih ke XML Editor (klik tab Text) dan modifikasi atribut Plain Text sebagai berikut:

Atribut |Nilai
---|---
android:id |"@+id/editText_main"
android:layout_width |"match_parent"
android:layout_height |"wrap_content"
android:layout_toLeftOf |"@+id/button_main"
android:layout_toStartOf |"@+id/button_main"
android:layout_alignParentBottom |"true"
android:hint |"Masukkan pesan"

Jika terdapat kesalahan, abaikan sementara kesalahan yang muncul tersebut. Masalah ini akan kita atasi di langkah selanjutnya.

8. Letakkan kursor pada kata `"Ketikkan pesan"`. Tekan **Alt+Enter** (**Option+Enter** di Mac), dan pilih **Extract string resources**.

!['intent'](img/04.3.jpg)

9. Ubah nama Sumber Daya menjadi `editText_main` dan klik OK.

!['intent'](img/04.4.jpg)

Proses ini membuat sumber daya string dalam file `values/res/string.xml`, dan string dalam kode Anda digantikan
dengan referensi ke sumber daya string tersebut.

10. Tambahkan sebuah Button ke layout dalam posisi apa pun. Beralih ke XML Editor (klik tab Text) dan modifikasi atribut Button sebagai berikut:

Atribut| Nilai
---|---
android:id |"@+id/button_main"
android:layout_width |"wrap_content"
android:layout_height |"wrap_content"
android:layout_alignParentRight |"true"
android:layout_alignParentBottom |"true"
android:layout_alignParentEnd |"true"
android:text |"Send"
android:onClick |"launchSecondActivity"

11. Letakkan kursor pada kata `"Send"`. Tekan **Alt+Enter** (**Option+Enter** di Mac), dan pilih **Extract string resources**.

!['intent'](img/04.5.jpg)

12. Ubah nama Sumber Daya menjadi `button_main` dan klik OK.

!['intent'](img/04.6.jpg)

Kode Program secara keseluruhan untuk activity_main.xml seperti gambar di bawah ini.

!['intent'](img/04.7.jpg)

13. Dalam Editor XML, letakkan kursor pada kata `"launchSecondActivity"`. Tekan **Alt+Enter** (**Option+Enter** di Mac) dan pilih **Create 'launchSecondActivity(View)' in 'MainActivity**.

!['intent'](img/04.8.jpg)

File MainActivity.java terbuka, dan Android Studio membuat metode kerangka untuk handler `onClick`.

14. Dalam `launchSecondActivity`, tambahkan pernyataan log yang bernama "*Button diklik!*"

```java
Log.d(LOG_TAG, "Button clicked!");
```

Log dan LOG_TAG akan terlihat berwarna merah. Definisi untuk variabel tersebut akan ditambahkan dalam langkah
selanjutnya.

15. Tempatkan kursor pada kata "Log" dan tekan **Alt+Enter** (**Option+Enter** di Mac). Android Studio menambahkan
pernyataan impor untuk `android.util.Log`.

!['intent'](img/04.9.jpg)

16. Pada bagian atas kelas, tambahkan konstanta untuk variabel LOG_TAG:

```java
private static final String LOG_TAG = MainActivity.class.getSimpleName();
```

Konstanta ini menggunakan nama kelas itu sendiri sebagai tag-nya.

Kode Program secara keseluruhan untuk MainActivity.java seperti gambar di bawah ini.

!['intent'](img/04.10.jpg)


#### Membuat Activity Kedua

1. Klik folder app untuk proyek Anda dan pilih **File > New > Activity > Empty Activity**.

2. Namakan aktivitas baru "SecondActivity." Pastikan Generate Layout File dicentang, dan nama layout akan diisi
dengan activity_second.

!['intent'](img/04.11.jpg)

3. Klik Finish. Android Studio menambahkan layout aktivitas baru (activity_second) dan file Java baru (SecondActivity)
ke proyek Anda untuk aktivitas baru tersebut. Ini juga akan memperbarui manifes Android untuk menyertakan aktivitas
baru.

4. Buka `manifests/AndroidManifest.xml`.

5. Temukan elemen `<activity>` yang dibuat Android Studio untuk aktivitas kedua.

`<activity android:name=".SecondActivity"></activity>`

6. Tambahkan atribut ini ke elemen `<activity>`:

Atribut |Nilai
---|---
android:label |"Second Activity"
android:parentActivityName |".MainActivity"

Atribut `label` menambahkan judul aktivitas ke bilah tindakan.
Atribut `parentActivityName` menandakan bahwa aktivitas utama adalah induk aktivitas kedua.

7. Tempatkan kursor di "Second Activity" dan tekan **Alt+Enter** (**Option+Enter** di Mac).

8. Pilih **Extract string resource**, namakan sumber daya "activity2_name", dan klik OK. Android Studio menambahkan
sumber daya string untuk label aktivitas.

!['intent'](img/04.12.jpg)

9. Tambahkan elemen `<meta-data>` element inside the `<activity>` di dalam elemen untuk aktivitas kedua. Gunakan
atribut berikut ini:

Atribut |Nilai
---|---
android:name |"android.support.PARENT_ACTIVITY"
android:value |"com.example.asus.intent.MainActivity" (disesuaikan dengan nama aplikasi yang dibuat)

Kode Program secara keseluruhan untuk AndroidManifest.xml seperti gambar di bawah ini.

!['intent'](img/04.13.jpg)

10. `Buka res/layout/activity_second.xml`. Ubah layout yang digunakan menjadi **RelativeLayout**

11. Tambahkan TextView ("Plain Textview" dalam Layout Editor). Berikan atribut berikut pada TextView:

Atribut |Nilai
---|---
android:id |"@+id/text_header"
android:layout_width |"wrap_content"
android:layout_height |"wrap_content"
android:text |"Pesan Diterima"
android:textAppearance |"?android:attr/textAppearanceMedium"
android:textStyle |"bold"

Nilai textAppearance adalah atribut bertema Android yang mendefinisikan gaya font dasar font kecil, medium, dan
besar. Anda akan mempelajari selengkapnya tentang tema pada pelajaran berikutnya.

12. Ekstrak string "Pesan Diterima" ke sumber daya bernama text_header.

!['intent'](img/04.14.jpg)

13. Tambahkan TextView yang kedua (Plain Textview dalam Layout Editor). Berikan atribut berikut pada TextView:

Atribut |Nilai
---|---
android:id |"@+id/text_message"
android:layout_width |"wrap_content"
android:layout_height |"wrap_content"
android:layout_below "@+id/text_header"
android:textSize "?android:attr/textAppearanceMedium"

Kode Program secara keseluruhan untuk activity_second.xml seperti gambar di bawah ini.

!['intent'](img/04.15.jpg)


#### Menambahkan Intent

Dalam aktivitas ini, kita akan menambahkan intent eksplisit ke aktivitas utama. Intent ini digunakan untuk mengaktifkan
aktivitas kedua saat tombol Send diklik.

1. Buka file MainActivity.java

2. Buat intent baru dalam metode `launchSecondActivity()`.

Konstruktor intent memerlukan dua argumen untuk intent eksplisit: konteks Aplikasi dan komponen spesifik yang akan
menerima intent tersebut. Di sini kita harus menggunakan `this` sebagai konteksmya, dan `SecondActivity.class`
sebagai kelas spesifiknya.

```java
Intent intent = new Intent(this, SecondActivity.class);
```

3. Tempatkan kursor di intent dan tekan **Alt+Enter** (**Option+Enter** di Mac) untuk menambahkan impor ke kelas intent.

!['intent'](img/04.16.jpg)

4. Panggil metode `startActivity()` dengan intent baru sebagai argumennya.

```java
startActivity(intent);
```

5. Tambahkan konstanta publik di bagian atas kelas untuk mendefinisikan kunci untuk ekstra intent:

```java
public static final String EXTRA_MESSAGE = "com.exmple.asus.intent.extra.MESSAGE";
```

6. Tambahkan variabel privat di bagian atas kelas untuk menampung objek EditText. Mengimpor kelas EditText.

```java
private EditText mMessageEditText;
```

7. Dalam metode `onCreate()`, gunakan **findViewByID** untuk mendapatkan referensi tentang contoh EditText dan
menetapkannya ke variabel privat tersebut:

```java
mMessageEditText = (EditText) findViewById(R.id.editText_main);
```

5. Dalam metode `launchSecondActivity()`, di bawah intent baru, dapatkan teks dari EditText sebagai string:

```java
String message = mMessageEditText.getText().toString();
```

6. Tambahkan string tersebut ke intent sebagai sebuah ekstra dengan konstanta EXTRA_MESSAGE sebagai kunci dan
string-nya sebagai nilai:

```java
intent.putExtra(EXTRA_MESSAGE, message);
```

Kode Program secara keseluruhan untuk MainActivity.java seperti gambar di bawah ini.

!['intent'](img/04.17.jpg)

7. Buka file SecondActivity.java

8. Dalam metode `onCreate()`, dapatkan intent yang mengaktifkan aktivitas berikut ini:

```java
Intent intent = getIntent();
```

9. Dapatkan string berisi pesan dari ekstra intent menggunakan variabel statis `MainActivity.EXTRA_MESSAGE` sebagai
kuncinya:

```java
String message = intent.getStringExtra(MainActivity.EXTRA_MESSAGE);
```

10. Gunakan findViewByID untuk mendapatkan referensi ke TextView untuk pesan dari layout (Anda mungkin perlu
mengimpor kelas TextView):

```java
TextView textView = (TextView) findViewById(R.id.text_message);
```

11. Atur teks TextView tersebut ke string dari ekstra intent:

```java
textView.setText(message);
```

Kode Program secara keseluruhan untuk SecondActivity.java seperti gambar di bawah ini.

!['intent'](img/04.18.jpg)

12. Lakukan kompilasi program ke device android anda kemudian perhatikan apa yang terjadi di aplikasi tersebut.

#### Percobaan
