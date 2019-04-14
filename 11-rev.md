# Retrofit - RecyclerView

## Kemampuan akhir yang diharapkan

Setelah melakukan praktikum ini mahasiswa mampu :

1.	Membuat aplikasi yang memiliki request REST API berupa GET
2.	Mengkonsumsi REST API sederhana menggunakan Retrofit serta menyambungkannya dengan RecyclerView

## Dasar Teori

Retrofit digunakan untuk mempermudah aplikasi android kita mengambil data dari API server. Dengan menggunakan Retrofit kita lebih mudah untuk melakukan request melalui HTTP. Request yang disediakan Retrofit ada lima yaitu GET, POST, PUT, DELETE, dan HEAD.

Untuk menggunakan Retrofit pada aplikasi Android, kita membutuhkan 3 class utama.

**1. Interface yang mendefinisikan operasi HTTP (fungsi atau method)**

Retrofit mengubah HTTP API menjadi Java interface. Berikut ini contoh kode interface dan metode yang dideklarasikan di dalamnya:
```java
public interface GitHubService {
@GET("users/{user}/repos")
Call<List<Repo>> listRepos(@Path("user") String user);
@GET("group/{id}/users")
Call<List<User>> groupList(@Path("id") int groupId);
}
```
Setiap method di dalam interface mewakili sebuah kemungkinan API call, yang harus mempunyai anotasi HTTP (GET, POST, dll) untuk menentukan jenis request dan URL relatif.

Parameter query juga dapat ditambahkan ke dalam method.

```java
@GET(“group/{id}/users”)
Call<List<User>> groupList(@Path(“id”) int groupId, @Query(“sort”) String sort);
```

**2. Class Retrofit yang menghasilkan implementasi interface GitHubService**

Berikut ini contoh kode program di dalam class Retrofit:

```java
Retrofit retrofit = new Retrofit.Builder()
.baseUrl(“https://api.github.com/")
.build();
GitHubService service = retrofit.create(GitHubService.class);
Call<List<Repo>> repos = service.listRepos(“Mahasiswa”);
```

**3. POJO sederhana yang sesuai dengan setiap field dalam objek response JSON yang didapatkan dari permintaan API**

Ini adalah sebuah class sederhana dengan method setter dan getter untuk setiap field.

## Praktikum

Kita akan membuat aplikasi Android yang menggunakan Library Retrofit untuk mengunduh objek JSON yang berisi detail film dari The Movie DB API, yang kemudian detail film akan ditampilkan dalam RecyclerView pada aplikasi Android.

1. Buka website TMDB (www.themoviedb.org) untuk mendapatkan API key. TMDB merupakan website populer untuk mendapatkan informasi tentang film. Situs ini juga menyediakan API REST yang didokumentasikan dengan baik.

2. Lakukan registrasi dan login. Buka www.themoviedb.org/settings/api untuk mendapatkan API key baru.

3. Buat project baru dengan empty activity.

4. Buka file `build.gradle` dan tambahkan semua pustaka yang akan kita gunakan.

```java
implementation 'com.squareup.picasso:picasso:2.71828'
implementation 'com.squareup.retrofit2:retrofit:2.3.0'
implementation 'com.squareup.retrofit2:converter-gson:2.3.0'
implementation 'com.android.support:recyclerview-v7:27.1.1'
```

Kita menggunakan Picasso untuk memuat URL gambar ke imageView dan menampilkan detail film dalam RecyclerView

5. Karena kita akan melakukan query ke API TMDB sehingga kita perlu menambahkan izin akses internet di dalam file `AndroidManifest.xml`. Sebelum baris kode <aplication ...></aplication> tambahkan kode berikut:

```java
<uses-permission android:name="android.permission.INTERNET" />
```

6. 
