# Intent

## Kemampuan akhir yang diharapkan

Setelah melakukan praktikum ini mahasiswa mampu :

1. Membuat Aplikasi Android untuk Mengirim Data antar Activity
2. Membuat Aplikasi Android dengan Memanfaatkan Defined Action

## Praktikum 1 - Mengirim Data antar Activity

1. Buka aplikasi Android Studio dan buat sebuah project baru. Nama aplikasi bisa diisikan sesuai dengan keinginan
2. Pilihlah minimum sdk sesuai kebutuhan, misalnya pada praktikum ini kita gunakan API 15: Android 4.0.3
3. Pilih Empty Activity untuk template project
4. Terima nama aktivitas default (MainActivity). Pastikan kotak Generate Layout file dicentang, kemudian klik Finish
5. Buka `res/layout/activity_main.xml`. Pada Layout Editor, klik tab Design di bagian bawah layar. Ubah layout yang digunakan menjadi **RelativeLayout**
6. Hapus TextView yang berbunyi "*Hello World*"
7. Tambahkan sebuah Button ke layout dalam posisi apa pun.
8. Beralih ke XML Editor (klik tab Text) dan modifikasi atribut Button sebagai berikut:

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

Jika terdapat kesalahan, abaikan sementara kesalahan yang muncul tersebut. Masalah ini akan kita atasi di langkah selanjutnya.

9. Letakkan kursor pada kata `"Send"`.
10. Tekan **Alt+Enter** (**Option+Enter** di Mac), dan pilih **Extract string resources**.
11. Setel nama Sumber Daya ke `button_main` dan klik OK.
Proses ini membuat sumber daya string dalam file `values/res/string.xml`, dan string dalam kode Anda digantikan
dengan referensi ke sumber daya string tersebut.
