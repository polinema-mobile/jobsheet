# Firebase CRUD

## Kemampuan akhir yang diharapkan

Setelah melakukan praktikum ini mahasiswa mampu :

1.	Membuat realtime database dan authentication pada firebase
2.	Melakukan sinkronisasi firebase realtime database dengan aplikasi android
3.	Membuat apikasi CRUD menggunakan firebase realtime database

## Dasar Teori

Firebase adalah suatu layanan dari google untuk mempermudah para pengembang-pengembang aplikasi untuk mengembangkan aplikasinya. **Firebase(BaaS ‘Backend as a Service’)** ini merupakan solusi yang ditawarkan oleh Google untuk mempermudah pekerjaan Developer. Dengan adanya Firebase, apps developer dapat fokus mengembangkan aplikasi tanpa harus memberikan usaha yang besar terkait pengelolaan backend.

### 1. Firebase Realtime Database 
Firebase Realtime Database adalah sebuah cloud based NoSQL database yang tersedia secara realtime dan bisa diakses cross platform baik dari Android, iOS, maupun Web. Data pada Firebase Realtime Database disimpan dalam bentuk JSON tree yang selalu tersinkron secara realtime. Karena sifatnya yang realtime, jika ada perubahan pada database, maka semua klien yang menggunakan Realtime Database ini akan tersinkron secara otomatis. Dan juga jenis database-nya yang bertipe NoSQL, sangat cocok ketika kita ingin menyimpan data bersifat key-value pada aplikasi.
### 2. Firebase Authentication
Firebase authentication memberikan fungsi dalam mengelelola akun pengguna dengan cara yang mudah dan aman. Firebase Auth menawarkan beberapa metode autentikasi, termasuk email/sandi, penyedia pihak ketiga seperti Google atau Facebook, atau langsung menggunakan sistem akun Anda yang sudah ada.

## Praktikum

### A. Menambahkan Firebase pada project aplikasi Android

1. Pada langkah pertama buat project baru dengan empty activity, seperti gambar berikut:

!['firebase'](img/09-1.png)

!['firebase'](img/09-2.png)

2. Pada langkah berikutnya login/masuk pada Firebase dengan menggunakan Alamat Gmail pada link berikut ini https://firebase.google.com/?hl=id kemudian pilih `Buka Konsol`

!['firebase'](img/09-3.png)

3. Selanjutnya tambahkan project baru kita kedalam Firebase Console, dengan mengklik `Tambahkan proyek(+)`

!['firebase'](img/09-4.png)

4. Isi nama proyek, ID project dan Negara/Wilayah kalian, setelah itu klik `Buat Proyek`

!['firebase'](img/09-5.png)

5. Pada halaman Dashboard Firebase, disini pilih platform yang akan digunakan, klik icon berlogo android, untuk menambahkan Firebase ke dalam aplikasi Android.

!['firebase'](img/09-6.png)

6. Isi nama package (wajib), nama pendek aplikasi (jika diperlukan), lalu masukan kode SHA-1 kedalam Firebase.

!['firebase'](img/09-7.png)

 Untuk mendapatkan SHA-1 fingerprint, lakukan langkah-langkah berikut:

 a. Buka kembali project Android Studio

 b. Klik tab **Gradle** yang berada di sebelah kanan jendela Android Studio. Jika tidak ada isi apapun yang ditampilkan, klik **Refresh all Gradle projects** di bagian pojok kiri jendela Gradle

 c. Cari dan klik nama project kalian

 d. Masuk ke `Tasks` - `Android` - `SigningReport`

 !['firebase'](img/09-9.PNG)

 e. Klik dua kali pada **SigningReport** sehingga console terbuka

 f. Tunggu hingga proses selesai dan informasi SHA-1 akan ditampilkan. Salin kode SHA-1 tersebut ke halaman Firebase

 !['firebase'](img/09-10.PNG)

7. Download File Konfigurasi **google-services.json**, setelah selesai, pindahkan file tersebut pada direktori `app/root` yang terdapat pada project aplikasi.

!['firebase'](img/09-8.png)

8. Tambahkan Firebase SDK pada file `build.gradle(Project-Level)`, masukan plugin dibawah ini:

```java
dependencies {
    classpath 'com.android.tools.build:gradle:3.3.2'
    classpath 'com.google.gms:google-services:3.2.0'
    

    // NOTE: Do not place your application dependencies here; they belong
    // in the individual module build.gradle files
}
```

9. Buka `bulid.gradle(app-level)` lalu tambahkan library di bawah ini dalam dependencies.

```java
dependencies {
    implementation fileTree(dir: 'libs', include: ['*.jar'])
    implementation 'com.android.support:appcompat-v7:27.0.2'
    implementation 'com.android.support.constraint:constraint-layout:1.1.0'
    implementation 'com.android.support:design:27.0.2'
    implementation 'com.android.support:recyclerview-v7:27.0.2'
    implementation 'com.android.support:support-v4:27.0.2'
    implementation 'com.google.firebase:firebase-core:11.8.0'
    implementation 'com.firebaseui:firebase-ui-auth:3.2.2'
    implementation 'com.google.firebase:firebase-database:11.8.0'
    implementation 'com.google.android.gms:play-services-auth:11.8.0'    
    testImplementation 'junit:junit:4.12'
    androidTestImplementation 'com.android.support.test:runner:1.0.1'
    androidTestImplementation 'com.android.support.test.espresso:espresso-core:3.0.1'
}
```

10. Lalu tambahkan kode **apply plugin: 'com.google.gms.google-services'** di bagian bawah dependencies.

```java
dependencies {
    implementation fileTree(dir: 'libs', include: ['*.jar'])
    implementation 'com.android.support:appcompat-v7:27.0.2'
    implementation 'com.android.support.constraint:constraint-layout:1.1.0'
    implementation 'com.android.support:design:27.0.2'
    implementation 'com.android.support:recyclerview-v7:27.0.2'
    implementation 'com.android.support:support-v4:27.0.2'
    implementation 'com.google.firebase:firebase-core:11.8.0'
    implementation 'com.firebaseui:firebase-ui-auth:3.2.2'
    implementation 'com.google.firebase:firebase-database:11.8.0'
    implementation 'com.google.android.gms:play-services-auth:11.8.0'    
    testImplementation 'junit:junit:4.12'
    androidTestImplementation 'com.android.support.test:runner:1.0.1'
    androidTestImplementation 'com.android.support.test.espresso:espresso-core:3.0.1'
}
apply plugin: 'com.google.gms.google-services'
```

### B. Membuat Fitur Create, Read, Update, dan Delete Data pada Firebase

1. Buka layout `activity_main.xml` untuk membuat halaman menu aplikasinya terlebih dahulu dengan menyalin kode berikut.

```java
<?xml version="1.0" encoding="utf-8"?>
<RelativeLayout xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:app="http://schemas.android.com/apk/res-auto"
    xmlns:tools="http://schemas.android.com/tools"
    android:layout_width="match_parent"
    android:layout_height="match_parent"
    android:layout_margin="12dp"
    tools:context="com.vip.firebasecrud.ui.MainActivity">

    <ProgressBar
        android:id="@+id/progress"
        style="?android:attr/progressBarStyle"
        android:layout_width="wrap_content"
        android:layout_height="wrap_content"
        android:layout_alignParentEnd="false"
        android:layout_alignParentLeft="false"
        android:layout_alignParentRight="false"
        android:layout_alignParentStart="false"
        android:layout_alignParentTop="false"
        android:layout_centerHorizontal="true"
        android:layout_centerVertical="true" />

    <LinearLayout
        android:layout_width="match_parent"
        android:layout_height="match_parent"
        android:gravity="center"
        android:orientation="vertical">

        <EditText
            android:id="@+id/nim"
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:ems="10"
            android:hint="NIM"
            android:inputType="textPersonName" />

        <EditText
            android:id="@+id/nama"
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:ems="10"
            android:hint="Masukan Nama"
            android:inputType="textPersonName" />

        <EditText
            android:id="@+id/jurusan"
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:ems="10"
            android:hint="Jurusan"
            android:inputType="textPersonName" />

        <LinearLayout
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:layout_marginTop="8dp"
            android:orientation="horizontal">

            <Button
                android:id="@+id/login"
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_weight="1"
                android:text="Login" />

            <Button
                android:id="@+id/save"
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_weight="1"
                android:text="Simpan" />

            <Button
                android:id="@+id/logout"
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_weight="1"
                android:text="Logout" />

        </LinearLayout>

        <Button
            android:id="@+id/showdata"
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:text="Lihat Data" />

    </LinearLayout>

</RelativeLayout>
```

2. Tambahkan kode berikut ini pada `MainActivity.java`

```java
package com.vip.firebasecrud.ui;

import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.firebase.ui.auth.AuthUI;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.vip.firebasecrud.R;
import com.vip.firebasecrud.models.data_mahasiswa;

import java.util.Collections;

public class MainActivity extends AppCompatActivity implements View.OnClickListener{

    //Deklarasi Variable
    private ProgressBar progressBar;
    private EditText NIM, Nama, Jurusan;
    private FirebaseAuth auth;
    private Button Logout, Simpan, Login, ShowData;

    //Membuat Kode Permintaan
    private int RC_SIGN_IN = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        progressBar = findViewById(R.id.progress);
        progressBar.setVisibility(View.GONE);

        //Inisialisasi ID (Button)
        Logout = findViewById(R.id.logout);
        Logout.setOnClickListener(this);
        Simpan = findViewById(R.id.save);
        Simpan.setOnClickListener(this);
        Login = findViewById(R.id.login);
        Login.setOnClickListener(this);
        ShowData = findViewById(R.id.showdata);
        ShowData.setOnClickListener(this);

        auth = FirebaseAuth.getInstance(); //Mendapakan Instance Firebase Autentifikasi

        //Inisialisasi ID (EditText)
        NIM = findViewById(R.id.nim);
        Nama = findViewById(R.id.nama);
        Jurusan = findViewById(R.id.jurusan);

        /*
         * Mendeteksi apakah ada user yang masuk, Jika tidak, maka setiap komponen UI akan dinonaktifkan
         * Kecuali Tombol Login. Dan jika ada user yang terautentikasi, semua fungsi/komponen
         * didalam User Interface dapat digunakan, kecuali tombol Logout
         */
        if(auth.getCurrentUser() == null){
            defaultUI();
        }else {
            updateUI();
        }
    }

    //Tampilan Default pada Activity jika user belum terautentikasi
    private void defaultUI(){
        Logout.setEnabled(false);
        Simpan.setEnabled(false);
        ShowData.setEnabled(false);
        Login.setEnabled(true);
        NIM.setEnabled(false);
        Nama.setEnabled(false);
        Jurusan.setEnabled(false);
    }

    //Tampilan User Interface pada Activity setelah user Terautentikasi
    private void updateUI(){
        Logout.setEnabled(true);
        Simpan.setEnabled(true);
        Login.setEnabled(false);
        ShowData.setEnabled(true);
        NIM.setEnabled(true);
        Nama.setEnabled(true);
        Jurusan.setEnabled(true);
        progressBar.setVisibility(View.GONE);
    }

    // Mengecek apakah ada data yang kosong
    private boolean isEmpty(String s){
        return TextUtils.isEmpty(s);
    }

    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        // RC_SIGN_IN adalah kode permintaan yang Anda berikan ke startActivityForResult, saat memulai masuknya arus.
        if (requestCode == RC_SIGN_IN) {

            //Berhasil masuk
            if (resultCode == RESULT_OK) {
                Toast.makeText(MainActivity.this, "Login Berhasil", Toast.LENGTH_SHORT).show();
                updateUI();
            }else {
                progressBar.setVisibility(View.GONE);
                Toast.makeText(MainActivity.this, "Login Dibatalkan", Toast.LENGTH_SHORT).show();
            }
        }
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.login:
                // Statement program untuk login/masuk
                startActivityForResult(AuthUI.getInstance()
                                .createSignInIntentBuilder()

                                //Memilih Provider atau Method masuk yang akan kita gunakan
                                .setAvailableProviders(Collections.singletonList(new AuthUI.IdpConfig.GoogleBuilder().build()))
                                .setIsSmartLockEnabled(false)
                                .build(),
                        RC_SIGN_IN);
                progressBar.setVisibility(View.VISIBLE);
                break;

            case R.id.save:
                //Mendapatkan UserID dari pengguna yang Terautentikasi
                String getUserID = auth.getCurrentUser().getUid();

                //Mendapatkan Instance dari Database
                FirebaseDatabase database = FirebaseDatabase.getInstance();
                DatabaseReference getReference;

                //Menyimpan Data yang diinputkan User kedalam Variable
                String getNIM = NIM.getText().toString();
                String getNama = Nama.getText().toString();
                String getJurusan = Jurusan.getText().toString();

                getReference = database.getReference(); // Mendapatkan Referensi dari Database

                // Mengecek apakah ada data yang kosong
                if(isEmpty(getNIM) || isEmpty(getNama) || isEmpty(getJurusan)){
                    //Jika Ada, maka akan menampilkan pesan singkan seperti berikut ini.
                    Toast.makeText(MainActivity.this, "Data tidak boleh ada yang kosong", Toast.LENGTH_SHORT).show();
                }else {
                    /*
                    Jika Tidak, maka data dapat diproses dan meyimpannya pada Database
                    Menyimpan data referensi pada Database berdasarkan User ID dari masing-masing Akun
                    */
                    getReference.child("Admin").child(getUserID).child("Mahasiswa").push()
                            .setValue(new data_mahasiswa(getNIM, getNama, getJurusan))
                            .addOnSuccessListener(this, new OnSuccessListener() {
                                @Override
                                public void onSuccess(Object o) {
                                    //Peristiwa ini terjadi saat user berhasil menyimpan datanya kedalam Database
                                    NIM.setText("");
                                    Nama.setText("");
                                    Jurusan.setText("");
                                    Toast.makeText(MainActivity.this, "Data Tersimpan", Toast.LENGTH_SHORT).show();
                                }
                            });
                }
                break;

            case R.id.logout:
                // Statement program untuk logout/keluar
                AuthUI.getInstance()
                        .signOut(this)
                        .addOnCompleteListener(new OnCompleteListener() {
                            @Override
                            public void onComplete(@NonNull Task task) {
                                Toast.makeText(MainActivity.this, "Logout Berhasil", Toast.LENGTH_SHORT).show();
                                finish();
                            }
                        });
                break;
            case R.id.showdata:
                startActivity(new Intent(MainActivity.this, MyListData.class));
                break;
        }
    }
}
```

Pada aplikasi ini terdapat empat Button, yaitu **Login, Simpan, Logout, dan Lihat Data**. Penyimpanan data dilakukan pada layout `activity_main.xml` yang terdiri dari tiga EditText sebagai tempat masukan informasi yaitu *NIM, Nama, dan Jurusan*, serta sebuah Button Simpan Data.

3. Selanjutnya, buat model Mahasiswa terlebih dahulu bernama **data_mahasiswa.java** pada `models/data_mahasiswa.java`. Fungsi class ini adalah untuk menyimpan atribut-atribut dari data mahasiswa yang dimasukkan, serta beberapa method *getter* dan *setter*.

```java
package com.vip.firebasecrud.models;

public class data_mahasiswa {

    //Deklarasi Variable
    private String nim;
    private String nama;
    private String jurusan;
    private String key;

    public String getKey() {
        return key;
    }

    public void setKey(String key) {
        this.key = key;
    }

    public String getNim() {
        return nim;
    }

    public void setNim(String nim) {
        this.nim = nim;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getJurusan() {
        return jurusan;
    }

    public void setJurusan(String jurusan) {
        this.jurusan = jurusan;
    }

    //Membuat Konstuktor kosong untuk membaca data snapshot
    public data_mahasiswa(){
    }

    //Konstruktor dengan beberapa parameter, untuk mendapatkan Input Data dari User
    public data_mahasiswa(String nim, String nama, String jurusan) {
        this.nim = nim;
        this.nama = nama;
        this.jurusan = jurusan;
    }
}
```

4. 
