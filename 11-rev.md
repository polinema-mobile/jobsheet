# Retrofit - Recycler View

## Kemampuan akhir yang diharapkan

Setelah melakukan praktikum ini mahasiswa mampu :

1.	Membuat aplikasi yang memiliki request REST API berupa POST, GET, UPDATE dan DELETE
2.	Mengkonsumsi REST API sederhana menggunakan Retrofit serta menyambungkannya dengan RecyclerView

## Dasar Teori

Retrofit digunakan untuk mempermudah aplikasi android kita mengambil data dari API server. Dengan menggunakan Retrofit kita lebih mudah untuk melakukan request melalui HTTP. Request yang disediakan Retrofit ada lima yaitu GET, POST, PUT, DELETE, dan HEAD.

## Praktikum

1. Buat project baru dengan empty activity

2. Buat 4 package baru dengan nama **databaseSQLITE**, **MovieComponents**, **MovieDetails** dan **utilities** dengan cara klik kanan pada package *Cinema* pilih New, klik Package.

3. Buka `AndroidManifest.xml`. Sebelum baris kode ```<aplication ...></aplication>``` tambahkan kode berikut:

```java
<uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />
<uses-permission android:name="android.permission.INTERNET" />
```

4. 
