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

4. Selanjutnya, buka file `build.gradle` dan tambahkan semua pustaka yang akan kita gunakan.

```java
dependencies {
    def room_version = "1.1.1"
    def lifecycle_version = "1.1.1"
    implementation fileTree(dir: 'libs', include: ['*.jar'])
    implementation 'com.jakewharton:butterknife:8.8.1'
    annotationProcessor 'com.jakewharton:butterknife-compiler:8.8.1'
    implementation 'com.android.support:appcompat-v7:27.1.1'
    implementation 'com.android.support:design:27.1.1'
    implementation 'com.android.support.constraint:constraint-layout:1.1.1'
    testImplementation 'junit:junit:4.12'
    implementation 'org.apache.directory.studio:org.apache.commons.io:2.4'
    androidTestImplementation 'com.android.support.test:runner:1.0.2'
    androidTestImplementation 'com.android.support.test.espresso:espresso-core:3.0.2'
    implementation 'com.android.support:recyclerview-v7:27.1.1'
    implementation 'com.squareup.picasso:picasso:2.71828'
    implementation 'com.google.code.gson:gson:2.8.5'
    implementation "android.arch.persistence.room:runtime:$room_version"
    annotationProcessor "android.arch.persistence.room:compiler:$room_version"
    implementation "android.arch.lifecycle:extensions:$lifecycle_version"
    annotationProcessor "android.arch.lifecycle:compiler:$lifecycle_version"
}
```

Library Room persistence menyediakan abstraction layer SQLite untuk memungkinkan akses database yang lebih kuat sambil memanfaatkan kemampuan SQLite.

5. Lakukan "Sync Now" dan pastikan koneksi internet dalam keadaan aktif.

6. Pada package databaseSQLite, buat 3 class baru bernama **MovieContract**, **MovieDbHelper**, dan **MoviesProvider**.

7. Tambahkan kode berikut pada **MovieContract.java**

```java
public class MovieContract {

    public static final String CONTENT_AUTHORITY = "com.app.cinema.cinema";
    public static final Uri BASE_CONTENT_URI = Uri.parse("content://" + CONTENT_AUTHORITY);
    public static final String PATH_MOVIE = "movie";

    public static final class MovieEntry implements BaseColumns {

        public static final Uri CONTENT_URI =
                BASE_CONTENT_URI.buildUpon().appendPath(PATH_MOVIE).build();


        public static final String CONTENT_TYPE =
                ContentResolver.CURSOR_DIR_BASE_TYPE + "/" + CONTENT_AUTHORITY + "/" + PATH_MOVIE;

        public static final String TABLE_NAME = "movie";
        public static final String COLUMN_MOVIE_ID = "movie_id";
        public static final String COLUMN_MOVIE_VOTE_AVERAGE = "vote_average";
        public static final String COLUMN_MOVIE_TITLE = "original_title";
        public static final String COLUMN_MOVIE_BACKDROP_PATH = "backdrop_path";
        public static final String COLUMN_MOVIE_OVERVIEW = "overview";
        public static final String COLUMN_MOVIE_RELEASE_DATE = "release_date";
        public static final String COLUMN_MOVIE_POSTER_PATH = "poster_path";


        public static Uri buildMovieUri(long id) {
            return ContentUris.withAppendedId(CONTENT_URI, id);
        }

        public static final String[] MOVIE_COLUMNS = {
                COLUMN_MOVIE_ID,
                COLUMN_MOVIE_VOTE_AVERAGE,
                COLUMN_MOVIE_TITLE,
                COLUMN_MOVIE_BACKDROP_PATH,
                COLUMN_MOVIE_OVERVIEW,
                COLUMN_MOVIE_RELEASE_DATE,
                COLUMN_MOVIE_POSTER_PATH
        };

        public static final int COL_MOVIE_ID = 0;
        public static final int COL_MOVIE_VOTE_AVERAGE = 1;
        public static final int COL_MOVIE_TITLE = 2;
        public static final int COL_MOVIE_BACKDROP_PATH = 3;
        public static final int COL_MOVIE_OVERVIEW = 4;
        public static final int COL_MOVIE_RELEASE_DATE = 5;
        public static final int COL_MOVIE_POSTER_PATH = 6;

    }
}
```

8. Tambahkan kode berikut pada **MoviesProvide.java**

```java
public class MoviesProvider extends ContentProvider {

    private static final UriMatcher sUriMatcher = buildUriMatcher();

    private MovieDbHelper mOpenHelper;


    static final int MOVIES = 300;

    private static UriMatcher buildUriMatcher() {
        final UriMatcher matcher = new UriMatcher(UriMatcher.NO_MATCH);
        final String authority = MovieContract.CONTENT_AUTHORITY;
        matcher.addURI(authority, MovieContract.PATH_MOVIE, MOVIES);
        return matcher;
    }


    @Override
    public boolean onCreate() {
        //initiate the object here
        mOpenHelper = new MovieDbHelper(getContext());
        return true;
    }

    @Nullable
    @Override
    public Cursor query(@NonNull Uri uri, String[] projection, String selection, String[] selectionArgs, String sortOrder) {
        Cursor cursor;
        switch (sUriMatcher.match(uri)) {
            case MOVIES: {
                cursor = mOpenHelper.getReadableDatabase().query(
                        MovieContract.MovieEntry.TABLE_NAME,
                        projection,
                        selection,
                        selectionArgs,
                        null,
                        null,
                        sortOrder
                );
                break;
            }
            default:
                throw new UnsupportedOperationException("URI not known: " + uri);
        }
        if (getContext() != null) {
            cursor.setNotificationUri(getContext().getContentResolver(), uri);
        }
        return cursor;
    }

    @Nullable
    @Override
    public String getType(@NonNull Uri uri) {
        final int match = sUriMatcher.match(uri);
        switch (match) {
            case MOVIES:
                return MovieContract.MovieEntry.CONTENT_TYPE;
            default:
                throw new UnsupportedOperationException("Uri Not Known: " + uri);
        }
    }

    @Nullable
    @Override
    public Uri insert(@NonNull Uri uri, @Nullable ContentValues contentValues) {
        final SQLiteDatabase db = mOpenHelper.getWritableDatabase();
        final int match = sUriMatcher.match(uri);
        Uri returnUri;
        switch (match) {
            case MOVIES: {
                long id = db.insert(MovieContract.MovieEntry.TABLE_NAME, null, contentValues);
                if (id > 0) {
                    returnUri = MovieContract.MovieEntry.buildMovieUri(id);
                } else {
                    throw new android.database.SQLException("Failed to insert row : " + uri);
                }
                break;
            }
            default:
                throw new UnsupportedOperationException("Uri Not Known: " + uri);
        }
        if (getContext() != null) {
            getContext().getContentResolver().notifyChange(uri, null);
        }
        return returnUri;
    }

    @Override
    public int delete(@NonNull Uri uri, String selection, String[] selectionArgs) {
        final SQLiteDatabase db = mOpenHelper.getWritableDatabase();
        final int match = sUriMatcher.match(uri);
        int rowsDeleted;

        if (null == selection) {
            selection = "1";
        }
        switch (match) {
            case MOVIES:
                rowsDeleted = db.delete(
                        MovieContract.MovieEntry.TABLE_NAME, selection, selectionArgs);
                break;
            default:
                throw new UnsupportedOperationException("Uri Not Known: " + uri);
        }

        if (rowsDeleted != 0 && getContext() != null) {
            getContext().getContentResolver().notifyChange(uri, null);
        }
        return rowsDeleted;
    }

    @Override
    public int update(@NonNull Uri uri, ContentValues values, String selection, String[] selectionArgs) {
        final SQLiteDatabase db = mOpenHelper.getWritableDatabase();
        final int match = sUriMatcher.match(uri);
        int rowsUpdated;

        switch (match) {
            case MOVIES:
                rowsUpdated = db.update(MovieContract.MovieEntry.TABLE_NAME, values, selection,
                        selectionArgs);
                break;
            default:
                throw new UnsupportedOperationException("Uri Not Knwon: " + uri);
        }
        if (rowsUpdated != 0 && getContext() != null) {
            getContext().getContentResolver().notifyChange(uri, null);
        }
        return rowsUpdated;
    }
}
```

9. Tambahkan kode berikut pada **MovieDbHelper.java**

```java
public class MovieDbHelper extends SQLiteOpenHelper{

    private static final int DATABASE_VERSION = 1;
    private static final String DATABASE_NAME = "movies.db";

    public MovieDbHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {
        final String CREATE_MOVIES_TABLE = "CREATE TABLE " + MovieContract.MovieEntry.TABLE_NAME
                + " (" +
                MovieContract.MovieEntry._ID + " INTEGER PRIMARY KEY," +
                MovieContract.MovieEntry.COLUMN_MOVIE_ID + " INTEGER NOT NULL, " +
                MovieContract.MovieEntry.COLUMN_MOVIE_VOTE_AVERAGE + " TEXT NOT NULL, " +
                MovieContract.MovieEntry.COLUMN_MOVIE_TITLE + " TEXT NOT NULL, " +
                MovieContract.MovieEntry.COLUMN_MOVIE_BACKDROP_PATH + " TEXT NOT NULL," +
                MovieContract.MovieEntry.COLUMN_MOVIE_OVERVIEW + " TEXT NOT NULL, " +
                MovieContract.MovieEntry.COLUMN_MOVIE_RELEASE_DATE + " TEXT NOT NULL, " +
                MovieContract.MovieEntry.COLUMN_MOVIE_POSTER_PATH + " TEXT NOT NULL " +
                " );";
        sqLiteDatabase.execSQL(CREATE_MOVIES_TABLE);
    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int oldVersion, int newVersion) {
        sqLiteDatabase.execSQL("DROP TABLE IF EXISTS " + MovieContract.MovieEntry.TABLE_NAME);
        onCreate(sqLiteDatabase);
    }
}
```

10. Selanjutnya pada package MovieComponent, buat 2 class baru bernama **Reviews** dan **Trailers**. Class-class ini berisi constructor dari atribut-atribut yang diperlukan pada REST server, serta setter dan getter untuk masing-masing atribut tersebut.

11. Tambahkan kode berikut pada **Reviews.java**

```java
public class Reviews implements Parcelable {

    @SerializedName("id")
    private String mId;
    @SerializedName("author")
    private String mAuthor;
    @SerializedName("content")
    private String mContent;
    @SerializedName("url")
    private String mUrl;

    public Reviews() {

    }

    protected Reviews(Parcel in) {
        mId = in.readString();
        mAuthor = in.readString();
        mContent = in.readString();
        mUrl = in.readString();
    }

    public static final Creator<Reviews> CREATOR = new Creator<Reviews>() {
        @Override
        public Reviews createFromParcel(Parcel in) {
            return new Reviews(in);
        }

        @Override
        public Reviews[] newArray(int size) {
            return new Reviews[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeString(mId);
        parcel.writeString(mAuthor);
        parcel.writeString(mContent);
        parcel.writeString(mUrl);
    }

    public String getmId() {
        return mId;
    }

    public void setmId(String mId) {
        this.mId = mId;
    }

    public String getmAuthor() {
        return mAuthor;
    }

    public void setmAuthor(String mAuthor) {
        this.mAuthor = mAuthor;
    }

    public String getmContent() {
        return mContent;
    }

    public void setmContent(String mContent) {
        this.mContent = mContent;
    }

    public String getmUrl() {
        return mUrl;
    }

    public void setmUrl(String mUrl) {
        this.mUrl = mUrl;
    }
}
```

12. Tambahkan kode berikut pada **Trailers.java**

```java
public class Trailers implements Parcelable {

    @SerializedName("id")
    private String mId;
    @SerializedName("key")
    private String mKey;
    @SerializedName("name")
    private String mName;
    @SerializedName("site")
    private String mSite;
    @SerializedName("size")
    private String mSize;

    // Only for createFromParcel
    public Trailers() {
    }



    public String getmId() {
        return mId;
    }

    public String getmSite() {
        return mSite;
    }

    public String getName() {
        return mName;
    }

    public String getKey() {
        return mKey;
    }
    public String getmSize() {
        return mSize;
    }

    public String getTrailerUrl() {
        return "http://www.youtube.com/watch?v=" + mKey;
    }
    public void setmId(String mId) {
        this.mId = mId;
    }

    public void setmKey(String mKey) {
        this.mKey = mKey;
    }

    public void setmName(String mName) {
        this.mName = mName;
    }

    public void setmSite(String mSite) {
        this.mSite = mSite;
    }

    public void setmSize(String mSize) {
        this.mSize = mSize;
    }

    public static final Parcelable.Creator<Trailers> CREATOR = new Creator<Trailers>() {
        public Trailers createFromParcel(Parcel source) {
            Trailers trailer = new Trailers();
            trailer.mId = source.readString();
            trailer.mKey = source.readString();
            trailer.mName = source.readString();
            trailer.mSite = source.readString();
            trailer.mSize = source.readString();
            return trailer;
        }

        public Trailers[] newArray(int size) {
            return new Trailers[size];
        }
    };

    public int describeContents() {
        return 0;
    }

    public void writeToParcel(Parcel parcel, int flags) {
        parcel.writeString(mId);
        parcel.writeString(mKey);
        parcel.writeString(mName);
        parcel.writeString(mSite);
        parcel.writeString(mSize);
    }
}
```

13. 
